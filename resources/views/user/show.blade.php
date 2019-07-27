@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $user->username, "url" => url("user/" . $user->id), "description" => "always wanted to know more about our authors? Meet {{ $user->username }}"] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image pinkpurple" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show publisher-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$user->username}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['users' => __('breadcrumbs.users'), "users/" . $user->id => $user->username]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p>
{{--                    {!! $publisher->body_html !!}--}}
                </p>
                @guest
                @else
                    <br><a href="{{ url("admin/users/" . $user->slug . "/edit") }}">Edit</a><br><br>
                @endguest
            </div>

            <div class="col-md-3 sidebar">
                <h2>Recent articles</h2>
                <ul>

                    @foreach($user->articles as $article)
                        <li><a href="{{ url("articles/" . $article->slug) }}">{{ $article->title }}</a></li>
                    @endforeach

                </ul>

            </div>
        </div>
    </div>

@endsection