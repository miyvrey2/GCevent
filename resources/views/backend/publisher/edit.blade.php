@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$publisher->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/publishers' => 'publishers', 'admin/publishers/' . $publisher->slug . '/edit' => 'Edit "' . $publisher->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/publishers/' . $publisher->slug)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.publisher.form', compact('developers', 'publisher'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection