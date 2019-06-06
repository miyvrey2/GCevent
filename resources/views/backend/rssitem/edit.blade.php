@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$rss_item->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/rssitems' => 'RSS Items', 'admin/rssitems/' . $rss_item->id. '/edit' => 'Edit "' . $rss_item->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/rssitems/' . $rss_item->id)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.rssitem.form', compact('rss_item', 'games'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection