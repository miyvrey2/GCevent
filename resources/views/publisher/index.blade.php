@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => __('breadcrumbs.publishers'), "url" => url("publishers"), "description" => 'A great number of contributors, exhibitors and publishers are represented at Gamescom. For as far is there each year an increasement in their numbers. '] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image pinkpurple" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show publisher-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{__('breadcrumbs.publishers')}}</h1>

                {{-- Breadcrumbs --}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['publishers' => __('breadcrumbs.publishers')]])
                @endcomponent

                <p><strong>A great number of contributors, exhibitors and publishers are represented at Gamescom. For as far is there each year an increasement in their numbers.</strong></p>
                <br />

                @foreach($publishers as $publisher)
                    <a href="{{url('publishers/' . $publisher->slug)}}">{{$publisher->title}}</a> <br />
                @endforeach

            </div>
        </div>
    </div>

@endsection