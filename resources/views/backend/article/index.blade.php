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

                <style>
                    #example_filter input[type="search"] {
                        height: 30px;
                        width: 100%;
                        margin: 5px 0 10px;
                    }

                    #example thead{
                        text-align: left;
                        background-color: #EEEEEE;
                    }

                    #example thead th,
                    #example tr td {
                        padding: 6px 0;
                        vertical-align: top;
                        border-bottom: 1px solid #CCCCCC;
                    }

                    #example thead th {
                        border-top: 1px solid #CCCCCC;
                    }

                    #example tr td span.tags {
                        font-style: italic;
                        font-size: 12px;
                    }

                    #example tr td span.status {
                        color: #888888;
                    }

                    #example tr th input[type="checkbox"],
                    #example tr td input[type="checkbox"] {
                        margin: 0;
                    }

                    #example tr td:last-of-type,
                    #example tr th:last-of-type {
                        padding-right: 10px;
                    }
                </style>

                <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
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
                            &nbsp;<input type="checkbox" title="selectAll">&nbsp;
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
                                &nbsp;<input type="checkbox" title="id" value="{{$article->id}}"/>&nbsp;
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
                                {{--<a @if(isset($game->available_developer)) class="filled-attribute" title="Developed by: {{$game->available_developer->title}}" @endif><i class="fa fa-flask"></i></a>--}}
                                {{--<a @if(isset($game->available_publisher)) class="filled-attribute" title="Published by: {{$game->available_publisher->title}}" @endif><i class="fa fa-upload"></i></a>--}}
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