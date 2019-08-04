@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $developer->title, "url" => url("developers/" . $developer->slug), "description" => $developer->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image pinkpurple" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show developer-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$developer->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['developers' => __('breadcrumbs.developers'), "developers/" . $developer->slug => $developer->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $developer->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $developer->body_html !!}
                </p>
                @guest
                @else
                    <br><a href="{{ url("admin/developers/" . $developer->slug . "/edit") }}">Edit</a><br><br>
                @endguest
            </div>

            <div class="col-md-3 sidebar">
                <h2>Summary</h2>
                <ul class="meta">
                    @if($developer->found != null)
                        @if($developer->founded == "Unknown.")
                            <li><i class="fa fa-rocket" title="Found"></i>Found: <a href="#" title="{{$developer->founded}}">{{$developer->founded}}</a></li>
                        @else
                            <li><i class="fa fa-rocket" title="Found"></i>Founded in <a href="#" title="{{$developer->founded}}">{!! $developer->founded !!}</a></li>
                        @endif
                    @endif

                    @if(isset($developer->url))
                        <li><i class="fa fa-link" title="Homepage developer"></i><a href="{{$developer->url}}" target="_blank" title="website of {{$developer->title}}">Web: {{$developer->title}}</a></li>
                    @endif

                    @if(count($developer->games) > 0)
                        @if(count($developer->games) == 1)<li><i class="fa fa-gamepad"></i><a href="#">{{count($developer->games)}} Game</a> listed</li>@endif
                        @if(count($developer->games) > 1)<li><i class="fa fa-gamepad"></i><a href="#">{{count($developer->games)}} Games</a> listed</li>@endif
                    @endif

                    {{--New halls--}}
                    @if( !$developer->games_for_gamescom_2019->isEmpty() )

                        @php($booths = [])
                        @foreach($developer->exhibition_booths->where('exhibition_id', 1) as $booth)
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

                @if( !$developer->games_for_gamescom_2019->isEmpty() )
                <div class="horizontal-line"></div>

                <h2>GC Lineup 2019</h2>
                <ul>
                    @foreach($developer->games_for_gamescom_2019 as $lineup)
                        <li><a href="{{ url("games/" . $lineup->slug) }}">{{ $lineup->title }}</a></li>
                    @endforeach
                </ul>
                @endif

                <div class="horizontal-line"></div>

                <h2>All games</h2>
                <ul>
                    @foreach($developer->games as $game)
                        <li><a href="{{ url("games/" . $game->slug) }}">{{ $game->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection