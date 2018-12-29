@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => __('breadcrumbs.platforms'), "url" => url("platforms"), "description" => 'A great number of contributors, exhibitors and platforms are represented at Gamescom. For as far is there each year an increasement in their numbers. '] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image pinkpurple" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container platform-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{__('breadcrumbs.platforms')}}</h1>

                {{-- Breadcrumbs --}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['platforms' => __('breadcrumbs.platforms')]])
                @endcomponent
                @foreach($platforms as $platform)
                    <a href="{{url('platforms/' . $platform->slug)}}">{{$platform->title}}</a> <br />
                @endforeach

            </div>
        </div>
    </div>

@endsection