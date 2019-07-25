@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => __('breadcrumbs.games'), "url" => url("games"), "description" => 'A lot of games have been appeared the last years. All the games we did note have been put into this overview.'] )
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
                <h1>{{__('breadcrumbs.games')}}</h1>

                {{-- Breadcrumbs --}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['games' => __('breadcrumbs.games')]])
                @endcomponent

                <p><strong>A lot of games have been appeared the last years. All the games we did note have been put into this overview.</strong></p>
                <br />

                @foreach($games as $game)
                    <a href="{{url('games/' . $game->slug)}}">{{$game->title}}</a> <br />
                @endforeach

            </div>
        </div>
    </div>

@endsection