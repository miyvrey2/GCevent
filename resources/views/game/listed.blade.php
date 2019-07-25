@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => "All gamescom games for 2018", "url" => url("games/list"), "description" => "Do you know what you can play at gamescom? Take a look at what the exhibitors will take along with them to the floors!"] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image yellowpink" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show game-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>All games for 2018</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['games' => __('breadcrumbs.games'), "games/list" => "All gamescom games for 2018"]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p>
                    @foreach($exhibitors as $exhibitor)
                        @if(count($exhibitor['exhibitor_games']) != 0)
                            <strong>{{$exhibitor->title}}</strong><br>
                            @foreach($exhibitor['exhibitor_games'] as $game)
                                <a href="{{url('games/' . $game->slug)}}">{{$game->title}}</a><br>
                            @endforeach
                            <br>
                        @endif
                    @endforeach
                </p>
            </div>
            <div class="col-md-3">
                {{--<h2>Overview</h2>--}}
                {{--<ul class="game-meta">--}}
                    {{--@if($game->released < Carbon\Carbon::now())--}}
                        {{--<li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$game->released}}">{{$game->released}}</a></li>--}}
                    {{--@else--}}
                        {{--<li><i class="fa fa-calendar" title="Release date"></i>Released on <a href="#" title="{{$game->released}}">{{$game->released}}</a></li>--}}
                    {{--@endif--}}
                    {{--<li>--}}
                        {{--<i class="fa fa-gamepad" title="Playable on"></i>Made for--}}
                        {{--@php($i = 1)--}}
                        {{--@foreach($game->platforms as $platform)--}}
                            {{--<a href="{{url('platforms/' . $platform->slug)}}" title="Playable on {{$platform->title}}">{{$platform->title}}</a>@if($i < count($game->platforms)), @endif--}}

                            {{--@php($i++)--}}
                        {{--@endforeach--}}

                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<i class="fa fa-upload" title="{{__('breadcrumbs.publisher')}}"></i><a title="{{__('breadcrumbs.publishedBy')}} {{$game->publisher->title}}" href="{{url('publishers/'.$game->publisher->slug)}}">{{$game->publisher->title}}</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}

                {{--<div class="horizontal-line"></div>--}}

                {{--<h2>Recent news</h2>--}}
                {{--<ul>--}}
                    {{--@foreach($game->rssFeeds as $rssfeed)--}}
                    {{--<li><a target="_blank" href="{{ $rssfeed->url }}">{{ $rssfeed->title }}</a></li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            </div>
        </div>
    </div>

@endsection

