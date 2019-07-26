@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $game->title, "url" => url("games/" . $game->slug), "description" => $game->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image yellowpink" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show game-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$game->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['games' => __('breadcrumbs.games'), "games/" . $game->slug => $game->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $game->introduction() !!}{!! $game->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $game->body_html !!}
                </p>
                @guest
                @else
                    <br><a href="{{ url("admin/games/" . $game->slug . "/edit") }}">Edit</a><br><br>
                @endguest
            </div>

            <div class="col-md-3 sidebar">
                <h2>Overview</h2>
                <ul class="meta">
                    @if($game->released == "T.B.A.")
                        <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$game->released}}">{{$game->released}}</a></li>
                    @else
                        @if(Carbon\Carbon::now()->lt(Carbon\Carbon::parse($game->released)))
                            <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$game->released}}">{{$game->released}}</a></li>
                        @else
                            <li><i class="fa fa-calendar" title="Release date"></i>Released on <a href="#" title="{{$game->released}}">{{$game->released}}</a></li>
                        @endif
                    @endif

                    @if(!$game->platforms->isEmpty())
                    <li>
                        <i class="fa fa-gamepad" title="Playable on"></i>Made for
                        @php($i = 1)
                        @foreach($game->platforms as $platform)
                            <a href="{{url('platforms/' . $platform->slug)}}" title="Playable on {{$platform->title}}">{{$platform->title}}</a>@if(count($game->platforms) - 1 == $i) & @elseif($i < count($game->platforms)), @endif

                            @php($i++)
                        @endforeach
                    </li>
                    @endif

                    @if(!$game->genres->isEmpty())
                        <li>
                            <i class="fa fa-book" title="Genres"></i>Genre:
                            @php($i = 1)
                            @foreach($game->genres as $genre)
                                <a href="#" title="{{$genre->title}}">{{$genre->title}}</a>@if($i < count($game->genres)), @endif

                                @php($i++)
                            @endforeach
                        </li>
                    @endif

                        @if(!$game->developers->isEmpty())
                            <li><i class="fa fa-flask" title="{{__('breadcrumbs.developer')}}"></i>@php($i = 1)@foreach($game->developers as $developer)<a title="{{__('breadcrumbs.developedBy')}}{{$developer->title}}" href="{{url('developers/'.$developer->slug)}}">{{$developer->title}}</a>@if(count($game->developers) - 1 == $i) & @elseif($i + 1 < count($game->developers)), @endif
                                    @php($i++)
                                @endforeach
                            </li>
                        @endif

                    @if(!$game->publishers->isEmpty())
                        <li><i class="fa fa-upload" title="{{__('breadcrumbs.publisher')}}"></i>@php($i = 1)@foreach($game->publishers as $publisher)<a title="{{__('breadcrumbs.publishedBy')}} {{$publisher->title}}" href="{{url('publishers/'.$publisher->slug)}}">{{$publisher->title}}</a>@if(count($game->publishers) - 1 == $i) & @elseif($i + 1 < count($game->publishers)), @endif
                                @php($i++)
                            @endforeach
                        </li>
                    @endif
                </ul>

                <div class="horizontal-line"></div>

                <h2>Recent news</h2>
                <ul>
                    @foreach($game->articles as $article)
                        <li><a target="_blank" href="{{ url('article/' . $article->slug) }}">{{ $article->title }}</a></li>
                    @endforeach
                </ul>

                @if(Auth::check())
                <h2>Recent RSS Items</h2>
                <ul>
                    @foreach($game->rssFeeds as $rssfeed)
                        <li><a target="_blank" href="{{ $rssfeed->url }}">{{ $rssfeed->title }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>

            <script type="application/ld+json">
              {
                "@context": "http://schema.org",
                "@type": "VideoGame",
                "applicationCategory":"Game",
                "name": "{{ $game->title }}",
                "url": "{{ url("games/" . $game->slug) }}",
                {{--"image": "{{ url($game->image) }}",--}}
                "description": "{!! $game->excerpt !!}",
                "inLanguage":["English"],
                @if(!$game->publishers->isEmpty())

                "publisher":[@foreach($game->publishers as $key => $publisher)

                   {
                        "@type": "Organization",
                        "name": "{{ $publisher->title }}",
                        "url": "{{ url("publishers/" . $publisher->slug) }}",
                        "logo": {
                            "@type": "ImageObject",
                            "name": "{{ $publisher->title }} logo",
                            "url": "{{ $publisher->image }}"
                        }
                    } @if( $key < (count($game->publishers) - 1)),@endif
                @endforeach

                ],
                @endif @if(!$game->genres->isEmpty())@php($i = 1)

                "genre":[@foreach($game->genres as $genre)"{{$genre->title}}"@if($i < count($game->genres)),@php($i++)@endif @endforeach],
                @endif @if(!$game->platforms->isEmpty())@php($i = 1)

                "gamePlatform":[@foreach($game->platforms as $platform)"{{$platform->title}}"@if($i < count($game->platforms)),@php($i++)@endif @endforeach],
                @endif
                {{--"operatingSystem":["Sonic", "Duo"],--}}
                "aggregateRating":{
                    "@type":"AggregateRating",
                    "ratingValue":"5",
                    "ratingCount":"1"
                }
                @if($game->developer != null)

                ,"author":{
                    "@type":"Organization",
                    "name":"{{ $game->developer->title }}",
                    "url":"{{ $game->developer->url }}"
                }
                @endif

              }
            </script>
        </div>
    </div>

@endsection