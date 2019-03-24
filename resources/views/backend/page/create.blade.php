@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Create an page</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/pages' => 'Page', 'admin/pages/create' => 'Create a page']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/pages')}}">

                {{--Load the form--}}
                @component('backend.page.form', compact('page'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection