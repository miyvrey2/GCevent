@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", [
    "title" => "Create an article",
    "url" => url('admin/news/create'),
    "description" => "Create a new article as news for " . env('APP_NAME')
    ] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Create an article</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/news' => 'News', 'admin/articles/create' => 'Create an article']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/articles')}}">

                {{--Load the form--}}
                @component('backend.article.form', compact('article', 'games'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection