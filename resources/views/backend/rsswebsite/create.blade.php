@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Create an RSS Website</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/rsswebsites' => 'RSS Websites', 'admin/rsswebsites/create' => 'Create an RSS Website']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/rsswebsites')}}">

                {{--Load the form--}}
                @component('backend.rsswebsite.form', compact('rss_website'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection