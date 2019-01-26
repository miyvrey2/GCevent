@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Add a publisher</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/publishers' => 'publishers', 'admin/publishers/create' => 'Add a publisher']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/publishers')}}">

                {{--Load the form--}}
                @component('backend.publisher.form', compact('publisher'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection