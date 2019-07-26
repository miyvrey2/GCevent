@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => __('breadcrumbs.news'), "url" => url("news"), "description" => ''] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        {{--<div class="featured_image orangered" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>--}}
        <div class="featured_image greenblue" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show article-index">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{__('breadcrumbs.news')}}</h1>

                {{-- Breadcrumbs --}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['news' => __('breadcrumbs.news')]])
                @endcomponent

                @php($grid_dex = [6, 6, 5, 7, 7, 5])
                @php($i = 0)
                <div class="row">
                    @foreach($articles as $article)
                        @if($i == 0)
                        <div class="col-md-12">
                            <h2>Recent news</h2>
                        </div>
                        @endif
                        @if($i <= 3)
                        <div class="col-sm-{{ $grid_dex[$i] }} article-item">
                            <a href="{{url('article/' . $article->slug)}}">
                                <picture class="img-box greenblue">
                                    <source srcset="{{ asset('img/gamescom_impression_hall_entrance.webp') }}" type="image/webp">
                                    <source srcset="{{ asset('img/gamescom_impression_hall_entrance.jpg') }}" type="image/jpeg">
                                    <img src="{{ asset('img/gamescom_impression_hall_entrance.jpg') }}" alt="{{ $article->title }}">
                                </picture>
                            </a>
                            <div class="article-item-details">
                                <a href="{{url('article/' . $article->slug)}}">{{$article->title}}</a> <br />
                                <span class="more">
                                    <em><i class="fa fa-clock-o"></i> {{$article->date}}</em>
                                </span>
                            </div>
                        </div>
                        @elseif($i == 4)
                        <div class="col-md-12">
                            <h2>Older news</h2>
                            <ul class="older-news">
                            <li><a href="{{url('article/' . $article->slug)}}">{{$article->title}}</a></li>

                        @else
                            <li><a href="{{url('article/' . $article->slug)}}">{{$article->title}}</a></li>
                        @endif

                        @if(($i - 1) == count($articles))
                            </ul>
                        </div>

                        @endif
                        @php($i++)
                    @endforeach
                </div>

            </div>
        </div>
    </div>

@endsection