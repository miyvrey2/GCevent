@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Add a developer</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/developers' => 'developers', 'admin/developers/create' => 'Add a developer']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/developers')}}">

                {{--Load the form--}}
                @component('backend.developer.form', compact('developer'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection