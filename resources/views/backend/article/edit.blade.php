@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", [
    "title" => "Edit article: " . $article->title,
    "url" => url('admin/articles/' . $article->slug . '/edit'),
    "description" => "Edit article: " . $article->title
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
                <h1>Edit "{{$article->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/news' => 'News', 'admin/articles/' . $article->slug . 'edit' => 'Edit "' . $article->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/articles/' . $article->slug)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.article.form', compact('article', 'games'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection