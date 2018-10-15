@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => __('breadcrumbs.games.upcoming'), "url" => url("games/upcoming"), "description" => 'A lot of games have been appeared the last years. All the games we did note have been put into this overview.'] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image yellowpink" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container game-upcoming">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{__('breadcrumbs.games.upcoming')}}</h1>

                {{-- Breadcrumbs --}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['games' => __('breadcrumbs.games'), 'games/upcoming' => __('breadcrumbs.games.upcoming')]])
                @endcomponent
                    @foreach($games as $game)
                    <div class="row game-item">
                        <div class="col-md-1">
                            <strong>{{$game->released_at_day}}</strong><br>
                            <span>{{$game->released_at_month}}</span>
                        </div>
                        <div class="col-md-11">
                            <a href="{{url('games/' . $game->slug)}}">{{$game->title}}</a> <br />
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>

@endsection