@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Add a platform</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/platforms' => 'platforms', 'admin/platforms/create' => 'Add a platform']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/platforms')}}">

                {{--Load the form--}}
                @component('backend.platform.form', compact('platform'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection