@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => 'Gamescom 2019 is drawing near!', "url" => url(""), "description" => "the 10th annivesary of gamescom celebrates the annually convention for games and all gaming-related goods! Gamescom is being held at Cologne(K&ouml;hn). Last year there was around a 355,000 visitors to come and watch all the works that are being showed here by popular game-developers."] )
    @endcomponent
@endsection

@section('content')
    <div class="enzow_slider slider-fullwidth" id="enzow_slider_1">

        <!-- Slide 1 -->
        <figure class='enzow_slide'>
            <img src="img/gamescom_17_030_003.jpg" alt="Traveling with escalators" title="The entrance hall" />
            <figcaption>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Only {{\Carbon\Carbon::parse("2019-08-21")->diffInDays()}} days left!</h2>
                            <p>On the 21th of August will Gamescom open it's doors!</p>
                        </div>
                    </div>
                </div>
                {{--<a class="button" target="_blank" href="https://tickets.koelnmesse.de/gamescom2018_0301_en">Get your tickets now!</a>--}}
            </figcaption>
        </figure>

        <!-- Slide 2 -->
        <figure class='enzow_slide'>
            <img src="img/gamescom_17_030_008.jpg" alt="Green leaves in the wood" title="Green leaves in the wood" />
            <figcaption>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Upcoming events</h2>
                            <p>During gamescom there is also a variety of events that take place! Devcom, the gamescom congress and even the city festival will be held this week!</p>
                        </div>
                    </div>
                </div>
                <a class="button" target="_blank" href="{{url('events-2019')}}">Learn more about the events</a>
            </figcaption>
        </figure>

        <!-- Slide 3 -->
        <figure class='enzow_slide'>
            <img style="object-position: 50% 20%;" src="img/gamescom_17_020_050.jpg" alt="Green leaves in the wood" title="Green leaves in the wood" />
            <figcaption>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Show your cosplay!</h2>
                            <p>Take your handheld with you and play along with all the other gamers around</p>
                        </div>
                    </div>
                </div>
                <a class="button" href="{{url('cosplay')}}">Read more</a>
            </figcaption>
        </figure>

        <div class="enzow_slider_navigation">
            <button class="enzow_previous" onclick="previous()">{{__('pagination.previous')}}</button>
            <button class="enzow_next"  onclick="next()">{{__('pagination.next')}}</button>
        </div>
    </div>

{{--    <script type='text/javascript' src='{{asset('js/slider.js')}}'></script>--}}
    <!--</section>-->

    <div class="container show">
        <div class="row">
            <div class="col-md-12">
                <h1>Gamescom {{env('GAMESCOM_YEAR')}} is coming!</h1>
                    Thanks for ariving on this page on the website. This is a fanpage for all the happenings on Gamescom. If you are a first-timer, be sure to read the <a href="{{url('gamescom-2019')}}">What is gamescom</a> page. If you are interested in all sorts of news and announcements made, please make your way to the "news" section.
                <br>
                <br>
                <h3>What's there to find?</h3>
                <p>
                    <strong>No like, for real, whats happening there?</strong> <br>Well, if you are new to this concept, it is quite hard to understand what is going to happen, now isn't it?! Gamescom will offer you an amazing amount of games, hardware, software, information and whatsoever about everything you want to know of the latest stuff from the game industry. Enjoy the fullest of all the goods that you can see, feel, play and get in these days!<br><br>

                    <strong>Got it, Enjoy the most of each day.. but where to start?</strong> <br>That's kind of a hard question yet. There has been anounced that big names as Nintendo, Microsoft, Ubisoft and EA and many others will be present again on these days. So which names suites you and do you play the most? When you explore their stands you will sure find your intersteing new title. If you are not sure about that, just keep a close eye on this site, and we will try to give a list of all the confirmed games so far! <br> <br>

                    <strong>Undoubtly, I will "see" games, but to "play" them without hours waiting...</strong> <br>It's not like your gameroom at home, where you can play every single game that you obtain. But it is a great oppertunity to play the game you want most, or you doubt most, to see in real what it offers so far. So yeah, waiting is part of it, but playing the game you love the most makes it worth it. Try to entertain yourself with a Gameboy color (oldschool) or 3DS, tablet, mobile or other people around you that have to wait (like, why not). <br> <br>

                    <strong>My mum said to me "don't talk to strangers"</strong> <br>And a wise mum she is! All though most of the men and women come here for the same goal, talking to the die-hard-fans as (maybe) a nooby can be a little tricky. You might get a better day if you take a friend or 2 with you to your favorite games (be sure you both like the games of course!) <br> <br>

                    <strong>Well.. so much for trying to convince me..</strong> <br>Complaining can be easy, but enjoying is where they aim for. Try to read more if you go along the site, maybe we still get you warm for it!
                </p>
            </div>
        </div>
    </div>

@endsection