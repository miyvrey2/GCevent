@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$console->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/consoles' => 'Consoles', 'admin/consoles/' . $console->slug . '/edit' => 'Edit "' . $console->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/consoles/' . $console->slug)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.console.form', compact('developers', 'console'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection