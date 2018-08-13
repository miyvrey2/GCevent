@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container publisher-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Dashboard</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['admin/dashboard' => 'Dashboard']])
                @endcomponent

            </div>

        </div>
    </div>
@endsection