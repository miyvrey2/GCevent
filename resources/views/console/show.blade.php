@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $console->title, "url" => url("console/" . $console->slug), "description" => $console->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image greenblue" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container publisher-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$console->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['consoles' => __('breadcrumbs.consoles'), $console->slug => $console->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $console->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $console->body_html !!}
                </p>
            </div>

            <div class="col-md-3">
                {{--@if($page->sidebar_title != null)--}}
                {{--<h2>{!! $page->sidebar_title !!}</h2>--}}
                {{--<p>--}}
                    {{--{!! $page->sidebar_body !!}--}}
                {{--</p>--}}
                {{--<div class="horizontal-line"></div>--}}
                {{--@endif--}}
                {{--<h2>Advertisement</h2>--}}
            </div>
        </div>
    </div>
@endsection