@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$page->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/pages' => 'Pages', 'admin/pages/' . $page->id . '/edit' => 'Edit "' . $page->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/pages/' . $page->id)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.page.form', compact('page', 'games'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection