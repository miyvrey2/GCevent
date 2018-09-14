@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $publisher->title, "url" => url("publishers/" . $publisher->slug), "description" => $publisher->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image pinkpurple" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container publisher-show">
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
            </div>

            <div class="col-md-3">
                <h2>Summary</h2>
                <ul class="publisher-meta">
                    @if(isset($publisher->found))
                    <li><i class="fa fa-rocket"></i>Founded in <a href="#" title="{{$publisher->found->format('l jS \\of F Y')}}">{{$publisher->found->year}}</a></li>
                    @endif
                    @if(count($publisher->games) > 0)
                        @if(count($publisher->games) == 1)<li><i class="fa fa-gamepad"></i><a href="#">{{count($publisher->games)}} Game</a> listed</li>@endif
                        @if(count($publisher->games) > 1)<li><i class="fa fa-gamepad"></i><a href="#">{{count($publisher->games)}} Games</a> listed</li>@endif
                    @endif
                    {{--halls--}}
                    @if($publisher->halls[0] != "unknown")
                    <li><i class="fa fa-map-marker"></i><a href="#">Hall
                            @foreach($publisher->halls as $hall)
                                {{$hall}}@endforeach</a>

                        {{--stands--}}
                        @if($publisher->stands[0]->stand != null)
                                at stands:
                            <div class="stand-box">
                                @foreach($publisher->stands as $stand)
                                    <span>{{$stand->stand}}</span>
                                @endforeach
                            </div>
                        </li>
                        @endif
                    @endif

                </ul>

                @if(!$publisher->lineup2018->isEmpty() || !$publisher->lineup2019->isEmpty())
                <div class="horizontal-line"></div>
                @endif

                @if(!$publisher->lineup2019->isEmpty())
                <h2>GC Lineup 2019</h2>
                <ul>
                    @foreach($publisher->lineup2019 as $lineup)
                        <li><a href="{{ url("games/" . $lineup->slug) }}">{{ $lineup->title }}</a></li>
                    @endforeach
                </ul>
                @endif

                @if(!$publisher->lineup2018->isEmpty())
                <h2>GC Lineup 2018</h2>
                <ul>
                @foreach($publisher->lineup2018 as $lineup)
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