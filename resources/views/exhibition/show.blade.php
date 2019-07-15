@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $exhibition->title, "url" => url($exhibition->slug), "description" => $exhibition->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image greenblue" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container exhibition-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$exhibition->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => [$exhibition->slug => $exhibition->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $exhibition->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $exhibition->body !!}
                </p>
            </div>

            <div class="col-md-3">

                @component('exhibition.sidebar', compact('exhibition'))
                @endcomponent

                <div class="horizontal-line"></div>

                <h2>Advertisement</h2>
            </div>
        </div>
    </div>
@endsection