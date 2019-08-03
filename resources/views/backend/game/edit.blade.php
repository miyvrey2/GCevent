@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", [
    "title" => "Edit game: " . $game->title,
    "url" => url('admin/games'),
     "description" => "Edit game: " . $game->title
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
                <h1>Edit "{{ $game->title }}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/games' => 'Games', 'admin/games/' . $game->slug . '/edit' => 'Edit "' . $game->title . '"']])
                @endcomponent
            </div>

            <form method="POST" action="{{url('/admin/games/' . $game->slug)}}">

                {{--Set the post method to patch--}}
                {{ method_field('PATCH') }}

                {{--Load the form--}}
                @component('backend.game.form', compact('developers', 'games','publishers', 'game', 'platforms', 'genres', 'series'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection