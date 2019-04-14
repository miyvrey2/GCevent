@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$developer->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/developers' => 'developers', 'admin/developers/' . $developer->slug . '/edit' => 'Edit "' . $developer->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/developers/' . $developer->slug)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.developer.form', compact('developers', 'developer'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection