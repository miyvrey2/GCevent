@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $platform->title, "url" => url("platforms/" . $platform->slug), "description" => $platform->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image greenblue" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container platform-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$platform->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['platforms' => __('breadcrumbs.platforms'), url("platforms/" . $platform->slug) => $platform->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $platform->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $platform->body_html !!}
                </p>
                @guest
                @else
                    <br><a href="{{ url("admin/platforms/" . $platform->slug . "/edit") }}">Edit</a><br><br>
                @endguest
            </div>

            <div class="col-md-3">
                <h2>Overview</h2>
                <ul class="platform-meta">
                    @if($platform->released == "T.B.A.")
                        <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$platform->released}}">{{$platform->released}}</a></li>
                    @else
                        @if(Carbon\Carbon::now()->lt(Carbon\Carbon::parse($platform->released)))
                            <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$platform->released}}">{{$platform->released}}</a></li>
                        @else
                            <li><i class="fa fa-calendar" title="Release date"></i>First released on <a href="#" title="{{$platform->released}}">{{$platform->released}}</a></li>
                        @endif
                    @endif
                </ul>
                @if(!$platform->games->isEmpty())

                <div class="horizontal-line"></div>

                <h2>All playable games</h2>
                <ul>
                    @foreach($platform->games as $game)
                        <li><a href="{{ url("games/" . $game->slug) }}">{{ $game->title }}</a></li>
                    @endforeach
                </ul>
                @endif


                {{--<h2>Recent news</h2>--}}
                {{--<ul>--}}
                    {{--@foreach($platform->articles as $article)--}}
                        {{--<li><a target="_blank" href="{{ url('article/' . $article->slug) }}">{{ $article->title }}</a></li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            </div>
        </div>
    </div>
@endsection