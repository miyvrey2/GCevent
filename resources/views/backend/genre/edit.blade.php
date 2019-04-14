@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$genre->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/genres' => 'genres', 'admin/genres/' . $genre->slug . '/edit' => 'Edit "' . $genre->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/genres/' . $genre->slug)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.genre.form', compact('genres', 'genre'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection