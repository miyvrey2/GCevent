@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $article->title, "url" => url("article/" . $article->slug), "description" => $article->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image deepblue" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show article-show">
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
                <em class="about-the-article"><i class="fa fa-clock-o"></i> Last updated: {{$article->date}}</em> @if($article->source)&nbsp;&nbsp; <em class="about-the-article"><i class="fa fa-sign-out"></i><a target="_blank" href="{{$article->source}}">Source</a></em> @endif &nbsp;&nbsp; @if($article->author_id)<em class="about-the-article"><i class="fa fa-user"></i> By: <a target="_blank" href="{{ url('members/' . $article->author_id) }}">{{$article->author->username}}</a></em> @endif

                <p><strong>{!! $article->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $article->body_html !!}
                </p>
                @guest
                @else
                    <br><a href="{{ url("admin/articles/" . $article->slug . "/edit") }}">Edit</a><br><br>
                @endguest

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
            </div>

            <div class="col-md-3 sidebar">
                @if($article->game_id)
                    <h2>Game: <a href="{{ url('games/' . $article->game->slug) }}">{{$article->game->title}}</a></h2>
                    <ul class="meta">

                        @if($article->game->released == "T.B.A.")
                            <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$article->game->released}}">{{$article->game->released}}</a></li>
                        @else
                            @if(Carbon\Carbon::now()->lt(Carbon\Carbon::parse($article->game->released)))
                                <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$article->game->released}}">{{$article->game->released}}</a></li>
                            @else
                                <li><i class="fa fa-calendar" title="Release date"></i>Released on <a href="#" title="{{$article->game->released}}">{{$article->game->released}}</a></li>
                            @endif
                        @endif

                        @if(!$article->game->platforms->isEmpty())
                            <li>
                                <i class="fa fa-microchip" title="Playable on"></i>Made for
                                @php($i = 1)
                                @foreach($article->game->platforms as $platform)
                                    <a href="{{url('platforms/' . $platform->slug)}}" title="Playable on {{$platform->title}}">{{$platform->title}}</a>@if($i < count($article->game->platforms)), @endif

                                    @php($i++)
                                @endforeach
                            </li>
                        @endif

                        @if(!$article->game->genres->isEmpty())
                            <li>
                                <i class="fa fa-book" title="Genres"></i>Genre:
                                @php($i = 1)
                                @foreach($article->game->genres as $genre)
                                    <a href="#" title="{{$genre->title}}">{{$genre->title}}</a>@if($i < count($article->game->genres)), @endif

                                    @php($i++)
                                @endforeach
                            </li>
                        @endif

                        @if($article->game->aviable_developer != null)
                            <li>
                                <i class="fa fa-flask" title="{{__('breadcrumbs.developer')}}"></i><a title="{{__('breadcrumbs.developedBy')}} {{$article->game->aviable_developer->title}}" href="{{url('developers/'.$article->game->aviable_developer->slug)}}">{{$article->game->aviable_developer->title}}</a>
                            </li>
                        @endif

                        @if(!$article->game->developers->isEmpty())
                            <li>
                                <i class="fa fa-flask" title="{{__('breadcrumbs.developer')}}"></i>
                                @php($i = 1)
                                @foreach($article->game->developers as $developer)
                                    <a title="{{__('breadcrumbs.developedBy')}} {{$developer->title}}" href="{{url('developers/'.$developer->slug)}}">{{$developer->title}}</a>

                                    @php($i++)
                                @endforeach
                            </li>
                        @endif

                        @if(!$article->game->publishers->isEmpty())
                            <li>
                                <i class="fa fa-upload" title="{{__('breadcrumbs.publisher')}}"></i>
                                @php($i = 1)
                                    @foreach($article->game->publishers as $publisher)
                                    <a title="{{__('breadcrumbs.publishedBy')}} {{$publisher->title}}" href="{{url('publishers/'.$publisher->slug)}}">{{$publisher->title}}</a>

                                    @php($i++)
                                @endforeach
                            </li>
                        @endif
                    </ul>

                    <div class="horizontal-line"></div>
                @endif

                @if($article->sidebar_title != null)
                    <h2>{!! $article->sidebar_title !!}</h2>
                    <p>
                        {!! $article->sidebar_body !!}
                    </p>
                    <div class="horizontal-line"></div>
                @endif

                <h2>Summary</h2>
                <ul class="meta">
                    <li><i class="fa fa-comments"></i> 0 comments</li>
                    <li><i class="fa fa-tags"></i> Tags:
                    @foreach($article->keywords as $tag)

                        <div class="stand-box">
                            <span>{{ $tag }}</span>
                        </div>
                    @endforeach

                    </li>
                </ul>

                <div class="horizontal-line"></div>
                <h2>Advertisement</h2>

                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- gamescomevent_com_exhibition_show -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-5113287686102695"
                     data-ad-slot="7139224508"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
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
                        "name": "Enzow",
                        "url": "https://www.enzow.org",
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

            <div class="col-md-9">
                {{--<div class="horizontal-line"></div>--}}

                <div class="related-items">
                    <h3>Related news</h3>
                    <div class="row">
                        @foreach($article->related as $related)
                        <div class="col-sm-6 article-item">
                            <a href="{{url('article/' . $related->slug)}}">
                                <picture class="img-box greenblue">
                                    <source srcset="{{ asset('img/gamescom_impression_hall_entrance.webp') }}" type="image/webp">
                                    <source srcset="{{ asset('img/gamescom_impression_hall_entrance.jpg') }}" type="image/jpeg">
                                    <img src="{{ asset('img/gamescom_impression_hall_entrance.jpg') }}" alt="{{ $related->title }}">
                                </picture>
                            </a>
                            <div class="article-item-details">
                                <a href="{{ url('article/' . $related->slug) }}">{{ $related->title }}</a> <br />
                                <span class="more">
                                    <em><i class="fa fa-clock-o"></i> {{ $related->date }}</em>
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection