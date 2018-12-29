@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Add a console</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/consoles' => 'Consoles', 'admin/consoles/create' => 'Add a console']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/consoles')}}">

                {{--Load the form--}}
                @component('backend.console.form', compact('console'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection