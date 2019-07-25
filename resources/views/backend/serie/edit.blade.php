@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$serie->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/series' => 'series', 'admin/series/' . $serie->slug . '/edit' => 'Edit "' . $serie->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/series/' . $serie->slug)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.serie.form', compact('series', 'serie'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection