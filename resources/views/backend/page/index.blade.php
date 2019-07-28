@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", [
    "title" => "Pages",
    "url" => url('admin/pages'),
    "description" => "Overview of all the pages on " . env('APP_NAME')
    ] )
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
                <h1>Pages</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/pages' => 'Pages']])
                @endcomponent

                <a class="button button-primary" href="{{ url('admin/pages/create')}}">Create a page</a><br><br>

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
                        <th>Page titles</th>
                        <th class="align-right not-on-mobile"></th>
                        <th class="align-right">Tools</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($pages as $page)
                        <tr>
                            <td class="align-center-center">
                                <input type="checkbox" title="id" value="{{$page->id}}"/>
                            </td>
                            <td><a href="{{url($page->slug)}}">{{$page->title}}</a></td>
                            <td class="align-right page-attributes not-on-mobile">
                                <span class="status">{{ $page->status }}</span>
                                <a @if($page->published_at != "") class="filled-attribute" @endif title="{{$page->published_at}}"><i class="fa fa-calendar"></i></a>&nbsp;
                                <a @if($page->game_id != "") class="filled-attribute" title="{{$page->game->title}}"@endif><i class="fa fa-gamepad"></i></a>&nbsp;
                                <a @if($page->keywords != "") class="filled-attribute" @endif title="{{$page->keywords}}"><i class="fa fa-tags"></i></a>&nbsp;
                                <a @if($page->author_id != "") class="filled-attribute" title="{{$page->author->username}}"@endif><i class="fa fa-user"></i></a>&nbsp;
                                {{--<a @if(!$game->genres->isEmpty()) class="filled-attribute" @endif title="Genres: @foreach($game->genres as $genreA) {{$genreA->title}}, @endforeach"><i class="fa fa-book"></i></a>&nbsp;--}}
                                {{--<a @if(!$game->consoles->isEmpty()) class="filled-attribute" @endif title="Consoles: @foreach($game->consoles as $consoleA) {{$consoleA->title}}, @endforeach"><i class="fa fa-microchip"></i></a>&nbsp;--}}
                                {{--<a @if(isset($game->available_developer)) class="filled-attribute" title="Developed by: {{$game->available_developer->title}}" @endif><i class="fa fa-flask"></i></a>--}}
                                {{--<a @if(isset($game->available_publisher)) class="filled-attribute" title="Published by: {{$game->available_publisher->title}}" @endif><i class="fa fa-upload"></i></a>--}}
                            </td>
                            <td class="align-right">
                                <a href="{{url('/page/' . $page->id)}}"><i class="fa fa-window-maximize"></i></a> &nbsp;
                                <a href="{{url('/admin/pages/' . $page->id . '/edit')}}"><i class="fa fa-pencil"></i></a> &nbsp;
                                {{ Form::open(array('url' => url('/admin/pages/' . $page->id), "class" => 'delete-row' )) }}
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