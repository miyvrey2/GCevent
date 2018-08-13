@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $article->title, "url" => url("article/" . $article->slug), "description" => $article->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image deepblue" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container article-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$article->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['news' => __('breadcrumbs.news'), "article/" . $article->slug => $article->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                {{--<img src="{{$article->game->image}}" title="{{$article->game->title}}" />--}}
                <em><i class="fa fa-clock-o"></i><time> Last updated: {{$article->date}}</em>
                <p><strong>{!! $article->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $article->body_html !!}
                </p>
                <em>Source: <a href="{{$article->source}}">{{$article->source}}</a></em>
                <br>
                <br>

                <div class="">
                    Written by: {{$article->author->username}}
                </div>

                {{--<div class="">--}}
                    {{--<h3>1 Comment</h3>--}}
                    {{--<div class="comment">--}}
                        {{--<img src="http://placehold.it/100x100" />--}}
                        {{--<strong>User said:</strong><br >--}}
                        {{--<p>--}}
                            {{--That's wonderfull! Cant wait to see it!--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="horizontal-line"></div>

                <div class="related-content">
                    <h3>Related news</h3>
                    @foreach($article->related as $related)
                        {{$related->updated_at->format('Y m d (H:i)')}} <a href="{{url('article/' . $related->slug)}}" title="{{$related->title}}">{{$related->title}}</a><br>
                    @endforeach
                </div>
            </div>

            <div class="col-md-3">
                <h2>{{$article->game->title}}</h2>
                <ul class="game-meta">
                    @if($article->game->released < Carbon\Carbon::now())
                        <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$article->game->released}}">{{$article->game->released}}</a></li>
                    @else
                        <li><i class="fa fa-calendar" title="Release date"></i>Released on <a href="#" title="{{$article->game->released}}">{{$article->game->released}}</a></li>
                    @endif
                    <li>
                        <i class="fa fa-gamepad" title="Playable on"></i>Made for
                        @php($i = 1)
                        @foreach($article->game->consoles as $console)
                            <a href="{{url('consoles/' . $console->slug)}}" title="Playable on {{$console->title}}">{{$console->title}}</a>@if($i < count($article->game->consoles)), @endif

                            @php($i++)
                        @endforeach

                    </li>
                    <li>
                        <i class="fa fa-upload" title="{{__('breadcrumbs.publisher')}}"></i><a title="{{__('breadcrumbs.publishedBy')}} {{$article->game->publisher->title}}" href="{{url('publishers/'.$article->game->publisher->slug)}}">{{$article->game->publisher->title}}</a>
                    </li>
                </ul>

                <div class="horizontal-line"></div>

                <h2>Summary</h2>
                <ul class="article-meta">
                    <li><i class="fa fa-comments"></i> 1 comment</li>
                </ul>
            </div>

            <script type="application/ld+json">
              {
                "@context": "http://schema.org",
                "@type": "NewsArticle",
                "headline": "{{$article->title}}",
                "datePublished": "{{$article->published_at}}",
                "dateModified": "{{$article->updated_at}}",
                "author": {
                    "@type": "Person",
                    "name": "{{$article->author->username}}"
                },
                "publisher": {
                    "@context": "http://schema.org",
                        "@type": "Organization",
                        "name": "gamescomevent",
                        "url": "https://www.gamescomevent.com",
                    "logo": {
                        "@type": "ImageObject",
                        "name": "{{config('app.name')}} logo",
                        "url": "http://my-organization.org/my-logo.png"
                    }
                },
                "image": [
                  "https://www.ishetalvakantie.nl/images/summer.jpg"
                ],
                "mainEntityOfPage": {
                  "@type": "WebPage",
                  "@id": "{{url("article/" . $article->slug)}}"
                }
              }
            </script>

        </div>
    </div>

@endsection