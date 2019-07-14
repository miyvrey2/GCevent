@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $exhibition->title, "url" => url($exhibition->slug), "description" => $exhibition->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image yellowpink" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container publisher-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Lineup for {{$exhibition->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => [$exhibition->slug => $exhibition->title, url($exhibition->slug . '/lineup') => "Lineup for " . $exhibition->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                @foreach($exhibition->publishers as $publisher)

                    <strong>{{ $publisher->title }}</strong><br>

                    @foreach($publisher->exhibition_game as $game)
                        <a href="{{url('games/' . $game->slug)}}">{{$game->title}}</a><br>
                    @endforeach
                    <br>
                @endforeach
            </div>

            <div class="col-md-3">
                <h2>Advertisement</h2>
            </div>
        </div>
    </div>
@endsection