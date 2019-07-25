@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => __('breadcrumbs.developers'), "url" => url("developers"), "description" => 'A great number of contributors, exhibitors and developers are represented at Gamescom. For as far is there each year an increasement in their numbers. '] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image pinkpurple" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div></section>

    <div class="container show developer-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{__('breadcrumbs.developers')}}</h1>

                {{-- Breadcrumbs --}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['developers' => __('breadcrumbs.developers')]])
                @endcomponent

                <p><strong>A great number of contributors, exhibitors and developers are represented at Gamescom. For as far is there each year an increasement in their numbers.</strong></p>
                <br />

                @foreach($developers as $developer)
                    <a href="{{url('developers/' . $developer->slug)}}">{{$developer->title}}</a> <br />
                @endforeach

            </div>
        </div>
    </div>

@endsection