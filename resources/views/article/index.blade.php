@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => __('breadcrumbs.news'), "url" => url("news"), "description" => ''] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image orangered" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container publisher-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{__('breadcrumbs.news')}}</h1>

                {{-- Breadcrumbs --}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['news' => __('breadcrumbs.news')]])
                @endcomponent

                @foreach($articles as $article)
                    <a href="{{url('article/' . $article->slug)}}">{{$article->title}}</a> <br />
                @endforeach

            </div>
        </div>
    </div>

@endsection