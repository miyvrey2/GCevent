@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $page->title, "url" => url("publishers/" . $page->slug), "description" => $page->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image greenblue" style="background-image:url('https://www.gamescomevent.com/gfx/slider_image_01_mini.jpg')"></div>
    </section>

    <div class="container publisher-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$page->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => [$page->slug => $page->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $page->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $page->body_html !!}
                </p>
            </div>

            <div class="col-md-3">
                @if($page->sidebar_title != null)
                <h2>{!! $page->sidebar_title !!}</h2>
                <p>
                    {!! $page->sidebar_body !!}
                </p>
                <div class="horizontal-line"></div>
                @endif
                <h2>Advertisement</h2>
            </div>
        </div>
    </div>
@endsection