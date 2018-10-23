@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$feed->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/news/incoming' => 'Crawled feeds', 'admin/feed/' . $feed->id. '/edit' => 'Edit "' . $feed->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/feed/' . $feed->id)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.feed.form', compact('feed', 'games'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection