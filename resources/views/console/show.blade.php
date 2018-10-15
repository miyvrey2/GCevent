@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $console->title, "url" => url("consoles/" . $console->slug), "description" => $console->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image greenblue" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container console-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$console->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['consoles' => __('breadcrumbs.consoles'), url("consoles/" . $console->slug) => $console->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $console->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $console->body_html !!}
                </p>
            </div>

            <div class="col-md-3">
                <h2>Overview</h2>
                <ul class="console-meta">
                    @if($console->released == "T.B.A.")
                        <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$console->released}}">{{$console->released}}</a></li>
                    @else
                        @if(Carbon\Carbon::now()->lt(Carbon\Carbon::parse($console->released)))
                            <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$console->released}}">{{$console->released}}</a></li>
                        @else
                            <li><i class="fa fa-calendar" title="Release date"></i>Released on <a href="#" title="{{$console->released}}">{{$console->released}}</a></li>
                        @endif
                    @endif
                </ul>
                @if(!$console->games->isEmpty())

                <div class="horizontal-line"></div>

                <h2>All playable games</h2>
                <ul>
                    @foreach($console->games as $game)
                        <li><a href="{{ url("games/" . $game->slug) }}">{{ $game->title }}</a></li>
                    @endforeach
                </ul>
                @endif


                {{--<h2>Recent news</h2>--}}
                {{--<ul>--}}
                    {{--@foreach($console->articles as $article)--}}
                        {{--<li><a target="_blank" href="{{ url('article/' . $article->slug) }}">{{ $article->title }}</a></li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            </div>
        </div>
    </div>
@endsection