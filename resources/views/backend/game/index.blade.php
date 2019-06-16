@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", ["title" => "Games overview", "url" => url('admin/games'), "description" => "Overview of all the games on Enzow.org"] )
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
                <h1>Games</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/games' => 'Games']])
                @endcomponent

                <a class="button button-primary" href="{{ url('admin/games/create')}}">Add a game</a>
                <a class="button button-primary" href="{{ url('admin/games/recently-in-rss')}}">Recently in RSS</a><br><br>

                <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
                <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.js')}}"></script>
                <script type="text/javascript" language="javascript" class="init">
                    $(document).ready(function() {
                        // $('#example').DataTable({
                        //
                        //     "paging":       true,
                        //     "pagingType":   "numbers",
                        //     "lengthMenu":   [[100, 250, -1], [100, 250, "All"]],
                        //     "ordering":     true,
                        //     "info":         false,
                        //     "searching":    true
                        // });

                        $("body").on('click', ".game-attributes-tab .a", function () {

                            if($(this).find(".display-on-click").css("display") == "block") {
                                $('.display-on-click').css('display','none');
                                $('.display-on-click a').css('display','none');
                            } else {
                                $('.display-on-click').css('display','none');
                                $(this).find(".display-on-click").css('display','block');
                                $(this).find(".display-on-click a").css('display','block');
                            }
                        });
                    } );
                </script>

                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="align-center-center">
                            <input type="checkbox" title="selectAll">
                        </th>
                        <th>Title</th>
                        <th class="align-right not-on-mobile"></th>
                        <th class="align-right">Tools</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($games as $game)
                        <tr>
                            <td class="align-center-center">
                                <input type="checkbox" title="id" value="{{$game->id}}"/>
                            </td>
                            <td>
                                <a href="{{url('games/' . $game->slug)}}">{{$game->title}}</a><br><span class="tags"></span>
                                <div class="game-attributes game-attributes-tab show-on-mobile">
                                    <a @if($game->released != "") class="filled-attribute" @endif title="{{$game->released}}"><i class="fa fa-calendar"></i></a>&nbsp;
                                    <a @if(!$game->genres->isEmpty()) class="filled-attribute" @endif title="Genres: @foreach($game->genres as $genreA) {{$genreA->title}}, @endforeach"><i class="fa fa-book"></i></a>&nbsp;
                                    <a @if(!$game->platforms->isEmpty()) class="filled-attribute" @endif title="Platforms: @foreach($game->platforms as $platformA) {{$platformA->title}}, @endforeach"><i class="fa fa-microchip"></i></a>&nbsp;
                                    <span @if(!$game->developers->isEmpty()) class="a filled-attribute" @else class="a" @endif title="Developed by: @foreach($game->developers as $developerA) {{$developerA->title}}, @endforeach"><i class="fa fa-flask"></i>
                                    <span class="display-on-click">
                                            @if(!$game->developers->isEmpty())
                                            {{ $game->santiziseListToString($game->developers) }}
                                        @else
                                            <a href="{{ url('/admin/games/find-developer/' . urlencode($game->slug) ) }}">Fetch developers</a>
                                        @endif
                                        </span>
                                    </span>
                                    <span @if(!$game->publishers->isEmpty()) class="a filled-attribute" @else class="a" @endif title="Published by: @foreach($game->publishers as $publisherA) {{$publisherA->title}}, @endforeach"><i class="fa fa-upload"></i>
                                        <span class="display-on-click">
                                            @if(!$game->publishers->isEmpty())
                                                {{ $game->santiziseListToString($game->publishers) }}
                                            @else
                                                <a href="{{ url('/admin/games/find-publisher/' . urlencode($game->slug) ) }}">Fetch publisher</a>
                                            @endif
                                        </span>
                                    </span>
                                </div>
                            </td>
                            <td class="align-right game-attributes not-on-mobile">
                                <a @if($game->released != "") class="filled-attribute" @endif title="{{$game->released}}"><i class="fa fa-calendar"></i></a>&nbsp;
                                <a @if(!$game->genres->isEmpty()) class="filled-attribute" @endif title="Genres: @foreach($game->genres as $genreA) {{$genreA->title}}, @endforeach"><i class="fa fa-book"></i></a>&nbsp;
                                <a @if(!$game->platforms->isEmpty()) class="filled-attribute" @endif title="Platforms: @foreach($game->platforms as $platformA) {{$platformA->title}}, @endforeach"><i class="fa fa-microchip"></i></a>&nbsp;
                                <a @if(!$game->developers->isEmpty()) class="filled-attribute" @endif title="Developed by: @foreach($game->developers as $developerA) {{$developerA->title}}, @endforeach"><i class="fa fa-flask"></i></a>
                                <a @if(!$game->publishers->isEmpty()) class="filled-attribute" @endif title="Published by: @foreach($game->publishers as $publisherA) {{$publisherA->title}}, @endforeach"><i class="fa fa-upload"></i></a>
                            </td>
                            <td class="align-right">
                                <a href="{{url('/games/' . $game->slug)}}"><i class="fa fa-window-maximize"></i></a> &nbsp;
                                <a href="{{url('/admin/games/' . $game->slug . '/edit')}}"><i class="fa fa-pencil"></i></a> &nbsp;
                                {{ Form::open(array('url' => url('/admin/games/' . $game->slug), "class" => 'delete-row' )) }}
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