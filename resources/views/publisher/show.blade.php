@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $publisher->title, "url" => url("publishers/" . $publisher->slug), "description" => $publisher->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image pinkpurple" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show publisher-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$publisher->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['publishers' => __('breadcrumbs.publishers'), "publishers/" . $publisher->slug => $publisher->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $publisher->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $publisher->body_html !!}
                </p>
                @guest
                @else
                    <br><a href="{{ url("admin/publishers/" . $publisher->slug . "/edit") }}">Edit</a><br><br>
                @endguest
            </div>

            <div class="col-md-3 sidebar">
                <h2>Summary</h2>
                <ul class="meta">
                    @if(isset($publisher->founded))
                        @if($publisher->founded == "Unknown.")
                            <li><i class="fa fa-rocket" title="Found"></i>Found: <a href="#" title="{{$publisher->founded}}">{{$publisher->founded}}</a></li>
                        @else
                            <li><i class="fa fa-rocket" title="Found"></i>Founded in <a href="#" title="{{$publisher->founded}}">{!! $publisher->founded !!}</a></li>
                        @endif
                    @endif

                    @if(isset($publisher->url))
                        <li><i class="fa fa-link" title="Homepage publisher"></i><a href="{{$publisher->url}}" target="_blank" title="website of {{$publisher->title}}">Web: {{$publisher->title}}</a></li>
                    @endif

                    @if(count($publisher->games) > 0)
                        @if(count($publisher->games) == 1)<li><i class="fa fa-gamepad"></i><a href="#">{{count($publisher->games)}} Game</a> listed</li>@endif
                        @if(count($publisher->games) > 1)<li><i class="fa fa-gamepad"></i><a href="#">{{count($publisher->games)}} Games</a> listed</li>@endif
                    @endif

                    {{--New halls--}}
                    @if( !$publisher->games_for_gamescom_2019->isEmpty() )

                        @php($booths = [])
                        @foreach($publisher->exhibition_booths->where('exhibition_id', 1) as $booth)
                            @php($booths[$booth->hall][] = $booth->booth)
                        @endforeach

                        @foreach($booths as $key => $booth)<li><i class="fa fa-map-marker"></i>Hall {{ $key }} at stands:
                            <div class="stand-box">
                            @foreach($booth as $item)
                                <span>{{ $item }}</span>
                            @endforeach
                            </div>
                        @endforeach
                        </li>

                    {{--End new halls--}}
                    @endif
                </ul>

                @if( !$publisher->games_for_gamescom_2019->isEmpty() )
                <div class="horizontal-line"></div>

                <h2>GC Lineup 2019</h2>
                <ul>
                    @foreach($publisher->games_for_gamescom_2019 as $lineup)
                        <li><a href="{{ url("games/" . $lineup->slug) }}">{{ $lineup->title }}</a></li>
                    @endforeach
                </ul>
                @endif

                <div class="horizontal-line"></div>

                <h2>All games</h2>
                <ul>
                    @foreach($publisher->games as $game)
                        <li><a href="{{ url("games/" . $game->slug) }}">{{ $game->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection