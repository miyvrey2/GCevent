@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Add a genre</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/genres' => 'genres', 'admin/genres/create' => 'Add a genre']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/genres')}}">

                {{--Load the form--}}
                @component('backend.genre.form', compact('genre'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection