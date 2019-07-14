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
                <h2>Overview</h2>

                <ul class="exhibition-meta">
                    <li><a href="{{ url($exhibition->slug) }}">{{ $exhibition->title }}</a></li>
                    <li><i class="fa fa-calendar" title="Starts"></i>Opens at <a href="#">{{ $exhibition->starts_at->format('d M @ H:i') }}</a></li>
                    <li><i class="fa fa-calendar" title="Closes"></i>Closes at <a href="#">{{ $exhibition->ends_at->format('d M @ H:i') }}</a></li>
                    <li><i class="fa fa-map-marker" title="Closes"></i>Address <a href="https://www.google.com/maps/place/{{ $exhibition->address }}">{{ $exhibition->address }}, {{ $exhibition->country }}</a></li>
                </ul>

                <div class="horizontal-line"></div>

                <h2>Advertisement</h2>
            </div>
        </div>
    </div>
@endsection