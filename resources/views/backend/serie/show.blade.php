@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Serie: {{ $serie->title }}</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/series' => 'series', 'admin/series/' . $serie->slug => 'Serie: ' . $serie->title]])
                @endcomponent

                <ul style="padding-left: 20px;">
                @foreach($serie->games->sortBy('released_at') as $game)
                    <li><a href="{{ url('/admin/games/' . $game->slug . '/edit') }}">{{ $game->title }}</a></li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection