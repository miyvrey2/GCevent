@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $developer->title, "url" => url("developers/" . $developer->slug), "description" => $developer->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image pinkpurple" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show developer-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$developer->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['developers' => __('breadcrumbs.developers'), "developers/" . $developer->slug => $developer->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $developer->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $developer->body_html !!}
                </p>
                @guest
                @else
                    <br><a href="{{ url("admin/developers/" . $developer->slug . "/edit") }}">Edit</a><br><br>
                @endguest
            </div>

            <div class="col-md-3 sidebar">
                <h2>Summary</h2>
                <ul class="meta">
                    @if(isset($developer->found))
                    <li><i class="fa fa-rocket"></i>Founded in <a href="#" title="{{$developer->found->format('l jS \\of F Y')}}">{{$developer->found->year}}</a></li>
                    @endif
                    @if(count($developer->games) > 0)
                        @if(count($developer->games) == 1)<li><i class="fa fa-gamepad"></i><a href="#">{{count($developer->games)}} Game</a> listed</li>@endif
                        @if(count($developer->games) > 1)<li><i class="fa fa-gamepad"></i><a href="#">{{count($developer->games)}} Games</a> listed</li>@endif
                    @endif

                </ul>

                <div class="horizontal-line"></div>

                <h2>All games</h2>
                <ul>
                    @foreach($developer->games as $game)
                        <li><a href="{{ url("games/" . $game->slug) }}">{{ $game->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection