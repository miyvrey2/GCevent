@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => "Search results for: " . $search_query, "url" => url("search/" . $search_query), "description" => "Search results"] )
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
                <h1>{{__('search.resultsfor')}} {{$search_query}}</h1>

                {{-- Breadcrumbs --}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['games' => __('breadcrumbs.games')]])
                @endcomponent


                @foreach($games as $game)
                    <a href="{{url('games/' . $game->slug)}}">{{$game->title}}</a> <br />
                @endforeach

            </div>
        </div>
    </div>

@endsection