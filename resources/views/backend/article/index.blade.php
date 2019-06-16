@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", ["title" => "News", "url" => url('admin/news'), "description" => "Overview of all the article items on Enzow.org"] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>News</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/news' => 'News']])
                @endcomponent

                <a class="button button-primary" href="{{ url('admin/articles/create')}}">Create an article</a><br><br>

                <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-3.4.1.slim.min.js"></script>
                <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.js')}}"></script>
                <script type="text/javascript" language="javascript" class="init">
                    $(document).ready(function() {
                        $('#example').DataTable({

                            "paging":   false,
                            "ordering": true,
                            "info":     false,
                            "searching":   true

                        });
                    } );
                </script>

                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="align-center-center">
                            <input type="checkbox" title="selectAll">
                        </th>
                        <th>Article titles</th>
                        <th class="align-right not-on-mobile"></th>
                        <th class="align-right">Tools</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($articles as $article)
                        <tr>
                            <td class="align-center-center">
                                <input type="checkbox" title="id" value="{{$article->id}}"/>
                            </td>
                            <td><a href="{{url('article/' . $article->slug)}}">{{$article->title}}</a></td>
                            <td class="align-right article-attributes not-on-mobile">
                                <span class="status">{{$article->status}}</span>
                                <a @if($article->published_at != "") class="filled-attribute" @endif title="{{$article->published_at}}"><i class="fa fa-calendar"></i></a>&nbsp;
                                <a @if($article->game_id != "") class="filled-attribute" title="{{$article->game->title}}"@endif><i class="fa fa-gamepad"></i></a>&nbsp;
                                <a @if($article->keywords != "") class="filled-attribute" @endif title="{{$article->keywords}}"><i class="fa fa-tags"></i></a>&nbsp;
                                <a @if($article->author_id != "") class="filled-attribute" title="{{$article->author->username}}"@endif><i class="fa fa-user"></i></a>&nbsp;
                                {{--<a @if(!$game->genres->isEmpty()) class="filled-attribute" @endif title="Genres: @foreach($game->genres as $genreA) {{$genreA->title}}, @endforeach"><i class="fa fa-book"></i></a>&nbsp;--}}
                                {{--<a @if(!$game->consoles->isEmpty()) class="filled-attribute" @endif title="Consoles: @foreach($game->consoles as $consoleA) {{$consoleA->title}}, @endforeach"><i class="fa fa-microchip"></i></a>&nbsp;--}}
                            </td>
                            <td class="align-right">
                                <a href="{{url('/article/' . $article->slug)}}"><i class="fa fa-window-maximize"></i></a> &nbsp;
                                <a href="{{url('/admin/articles/' . $article->slug . '/edit')}}"><i class="fa fa-pencil"></i></a> &nbsp;
                                {{ Form::open(array('url' => url('/admin/articles/' . $article->slug), "class" => 'delete-row' )) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <button type='submit' value="delete"><i class="fa fa-trash"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>

        </div>
    </div>
@endsection