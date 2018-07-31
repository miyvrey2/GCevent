@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $game->title, "url" => url("games/" . $game->slug), "description" => $game->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image yellowpink" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container game-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$game->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['games' => __('breadcrumbs.games'), "games/" . $game->slug => $game->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $game->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $game->body_html !!}
                </p>
            </div>

            <div class="col-md-3">
                <h2>Overview</h2>
                <ul class="game-meta">
                    @if($game->released < Carbon\Carbon::now())
                        <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$game->released}}">{{$game->released}}</a></li>
                    @else
                        <li><i class="fa fa-calendar" title="Release date"></i>Released on <a href="#" title="{{$game->released}}">{{$game->released}}</a></li>
                    @endif
                    <li>
                        <i class="fa fa-gamepad" title="Playable on"></i>Made for
                        @php($i = 1)
                        @foreach($game->consoles as $console)
                            <a href="{{url('console/' . $console->slug)}}" title="Playable on {{$console->title}}">{{$console->title}}</a>@if($i < count($game->consoles)), @endif

                            @php($i++)
                        @endforeach

                    </li>
                    <li>
                        <i class="fa fa-upload" title="{{__('breadcrumbs.publisher')}}"></i><a title="{{__('breadcrumbs.publishedBy')}} {{$game->publisher->title}}" href="{{url('publishers/'.$game->publisher->slug)}}">{{$game->publisher->title}}</a>
                    </li>
                </ul>

                <div class="horizontal-line"></div>

                <h2>Recent news</h2>
                <ul>
                    @foreach($game->rssFeeds as $rssfeed)
                        <li><a target="_blank" href="{{ $rssfeed->url }}">{{ $rssfeed->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection