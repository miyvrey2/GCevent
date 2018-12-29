@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$platform->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/platforms' => 'platforms', 'admin/platforms/' . $platform->slug . '/edit' => 'Edit "' . $platform->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/platforms/' . $platform->slug)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.platform.form', compact('developers', 'platform'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection