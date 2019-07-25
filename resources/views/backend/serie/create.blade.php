@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Add a serie</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/series' => 'series', 'admin/series/create' => 'Add a serie']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/series')}}">

                {{--Load the form--}}
                @component('backend.serie.form', compact('serie'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection