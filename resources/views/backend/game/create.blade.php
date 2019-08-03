@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", [
    "title" => "Create a game",
    "url" => url('admin/games/create'),
    "description" => "Create a new game for " . env('APP_NAME')
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
                <h1>Create a game</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/games' => 'Games', 'admin/games/create' => 'Create a game']])
                @endcomponent

            </div>

            <form method="POST" action="{{url('/admin/games')}}">

                {{--Load the form--}}
                @component('backend.game.form', compact('developers', 'games','publishers', 'game', 'platforms', 'genres', 'series'))
                @endcomponent

            </form>

        </div>
    </div>
@endsection