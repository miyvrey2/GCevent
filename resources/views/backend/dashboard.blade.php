@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Dashboard</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => []])
                @endcomponent

            </div>
            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="title">
                        <h2>Top 5 RSS websites</h2>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach($rss_websites as $rss_website)
                                <li>{{ $rss_website->title }} <span class="detail">{{ $rss_website->count }} <i class="fa fa-newspaper-o"></i></span></li>
                            @endforeach
                        </ul>
                        <a href="{{ url('admin/rsswebsites') }}" class="read-more">See all RSS websites</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="title">
                        <h2>Games vs. RSS articles ratio</h2>
                    </div>
                    <div class="content">
                        Articles with game: <span class="detail">{{ $count_rss_articles_with_game_id[0]->count }} <i class="fa fa-gamepad"></i></span> <br>
                        Articles without game: <span class="detail">{{ $count_rss_articles_without_game_id[0]->count }} <i class="fa fa-gamepad"></i></span>
                        <a href="{{ url('admin/news/incoming') }}" class="read-more">See all RSS articles</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card">
                    <div class="title">
                        <h2>Top 5 games in RSS</h2>
                    </div>
                    <div class="content">
                        <ul>
                            @foreach($rss_top_5_games as $rss_top_5_game)
                                <li>{{ $rss_top_5_game->title }} <span class="detail">{{ $rss_top_5_game->count }} <i class="fa fa-gamepad"></i></span></li>
                            @endforeach
                        </ul>
                        <a href="{{ url('admin/games') }}" class="read-more">See all games</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection