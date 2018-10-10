@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $game->title, "url" => url("games/" . $game->slug), "description" => $game->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image yellowpink" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container game-show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$game->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['games' => __('breadcrumbs.games'), "games/" . $game->slug => $game->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $game->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $game->body_html !!}
                </p>
            </div>

            <div class="col-md-3">
                <h2>Overview</h2>
                <ul class="game-meta">
                    @if($game->released == "TBA")
                        <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$game->released}}">{{$game->released}}</a></li>
                    @else
                        @if(Carbon\Carbon::now()->lt(Carbon\Carbon::parse($game->released)))
                            <li><i class="fa fa-calendar" title="Release date"></i>Planned for <a href="#" title="{{$game->released}}">{{$game->released}}</a></li>
                        @else
                            <li><i class="fa fa-calendar" title="Release date"></i>Released on <a href="#" title="{{$game->released}}">{{$game->released}}</a></li>
                        @endif
                    @endif

                    @if(!$game->consoles->isEmpty())
                    <li>
                        <i class="fa fa-gamepad" title="Playable on"></i>Made for
                        @php($i = 1)
                        @foreach($game->consoles as $console)
                            <a href="{{url('consoles/' . $console->slug)}}" title="Playable on {{$console->title}}">{{$console->title}}</a>@if($i < count($game->consoles)), @endif

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

                    @if($game->developer != null)
                        <li>
                            <i class="fa fa-flask" title="{{__('breadcrumbs.developer')}}"></i><a title="{{__('breadcrumbs.developedBy')}} {{$game->developer->title}}" href="{{url('developers/'.$game->developer->slug)}}">{{$game->developer->title}}</a>
                        </li>
                    @endif

                    @if($game->available_publisher != null)
                        <li>
                            <i class="fa fa-upload" title="{{__('breadcrumbs.publisher')}}"></i><a title="{{__('breadcrumbs.publishedBy')}} {{$game->available_publisher->title}}" href="{{url('publishers/'.$game->available_publisher->slug)}}">{{$game->available_publisher->title}}</a>
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
                <h2>Recent RSS feeds</h2>
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
                @if($game->available_publisher != null)

                "publisher":{
                    "@type": "Organization",
                    "name": "{{ $game->available_publisher->title }}",
                    "url": "{{ url("publishers/" . $game->available_publisher->slug) }}",
                    "logo": {
                        "@type": "ImageObject",
                        "name": "{{ $game->available_publisher->title }} logo",
                        "url": "{{ $game->available_publisher->image }}"
                    }
                },
                @endif

                @if(!$game->genres->isEmpty())
                "genre":[@foreach($game->genres as $genre)"{{$genre->title}}"@endforeach],
                @endif

                @if(!$game->consoles->isEmpty())

                "gamePlatform":[@foreach($game->consoles as $console)"{{$console->title}}"@endforeach],
                @endif
                {{--"operatingSystem":["Sonic", "Duo"],--}}
                {{--"processorRequirements":"4 GHz",--}}
                {{--"memoryRequirements":"8 Gb",--}}
                {{--"storageRequirements":"64 Gb",--}}
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