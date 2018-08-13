@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => __('breadcrumbs.consoles'), "url" => url("consoles"), "description" => 'A great number of contributors, exhibitors and consoles are represented at Gamescom. For as far is there each year an increasement in their numbers. '] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image pinkpurple" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container console-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{__('breadcrumbs.consoles')}}</h1>

                {{-- Breadcrumbs --}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['consoles' => __('breadcrumbs.consoles')]])
                @endcomponent
                @foreach($consoles as $console)
                    <a href="{{url('consoles/' . $console->slug)}}">{{$console->title}}</a> <br />
                @endforeach

            </div>
        </div>
    </div>

@endsection