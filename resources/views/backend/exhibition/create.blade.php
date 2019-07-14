@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Add a exhibition</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/exhibitions' => 'exhibitions', 'admin/exhibitions/create' => 'Add a exhibition']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/exhibitions')}}">

                {{--Load the form--}}
                @component('backend.exhibition.form', compact('exhibition', 'games'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection