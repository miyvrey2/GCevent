@extends('layouts.master')

@section('content')
    <div class="enzow_slider slider-fullwidth" id="enzow_slider_1">

        <!-- Slide 1 -->
        <figure class='enzow_slide'>
            <img src="img/gamescom_17_030_003.jpg" alt="Traveling with escalators" title="The entrance hall" />
            <figcaption>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Only {{\Carbon\Carbon::parse("2018-08-22")->diffInDays()}} days left!</h2>
                            <p>On the 22th of August will Gamescom open it's doors for the 10th anniversary</p>
                        </div>
                    </div>
                </div>
                <button>Go to the Terminal</button>
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
                            <p>velit dolor eget nunc. Mauris est sem, efficitur et libero at, tempus hendrerit ipsum. Suspendisse placerat velit quis dui venenatis posuere. Pellentesque sagittis ornare venenatis. Praesent tempus ligula eget orci laoreet, non tempus mauris elementum. Cras nec nulla vel ipsum cursus aliquet. Morbi commodo consequat massa, ut mattis ligula laoreet luctus. Quisque dictum accumsan fermentum. Curabitur nibh justo, imperdiet id felis at, efficitur scelerisque libero. Etiam velit purus, blandit quis justo non, malesuada maximus augue.</p>
                        </div>
                    </div>
                </div>
                <button>Travel to the green oase</button>
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
                <button>Read more</button>
            </figcaption>
        </figure>

        <div class="enzow_slider_navigation">
            <button class="enzow_previous" onclick="previous()">{{__('pagination.previous')}}</button>
            <button class="enzow_next"  onclick="next()">{{__('pagination.next')}}</button>
        </div>
    </div>

    {{--<link rel='stylesheet' id='enzow_css-css'  href='https://enzow.org/tomocon/wp-content/plugins/enzow-slider/css/slider.css' type='text/css' media='all' />--}}
    <script type='text/javascript' src='https://enzow.org/tomocon/wp-content/plugins/enzow-slider/js/slider.js'></script>
    <script>
        window.addEventListener("load", initEnzowSlider(1, 4, 'cover', '400px'));
    </script>
    <!--</section>-->

    <div class="container publisher-show">
        <div class="row">
            <div class="col-md-12">
                <h1>Gamescom {{env('GAMESCOM_YEAR')}} is coming!</h1>
                    Thanks for ariving on this page on the website. This is a fanpage for all the happenings on Gamescom. If you are a first-timer, be sure to read the <a href="{{url('gamescom-2018')}}">What is gamescom</a> page. If you are interested in all sorts of news and announcements made, please make your way to the "news" section.
                <br>
                <br>
                <h3>What's there to find?</h3>
                <p>
                    <strong>No like, for real, whats happening there?</strong> <br>Well, if you are new to this concept, it is quite hard to understand what is going to happen, now isn't it?! Gamescom will offer you an amazing amount of games, hardware, software, information and whatsoever about everything you want to know of the latest stuff from the game industry. Enjoy the fullest of all the goods that you can see, feel, play and get in these days!<br><br>

                    <strong>Got it, Enjoy the most of each day.. but where to start?</strong> <br>That's kind of a hard question yet. There has been anounced that big names as Nintendo, Microsoft, Ubisoft and EA and many others will be present again on these days. So which names suites you and do you play the most? When you explore their stands you will sure find your intersteing new title. If you are not sure about that, just keep a close eye on this site, and we will try to give a list of all the confirmed games so far! <br> <br>

                    <strong>Undoubtly, I will "see" games, but to "play" them without hours waiting...</strong> <br>It's not like your gameroom at home, where you can play every single game that you obtain. But it is a great oppertunity to play the game you want most, or you doubt most, to see in real what it offers so far. So yeah, waiting is part of it, but playing the game you love the most makes it worth it. Try to entertain yourself with a Gameboy color (oldschool) or 3DS, tablet, mobile or other people around you that have to wait (like, why not). <br> <br>

                    <strong>My mum said to me "don't talk to strangers"</strong> <br>And a wise mum she is! All though most of the men and women come here for the same goal, talking to the die-hard-fans as (maybe) a nooby can be a little tricky. You might get a better day if you take a friend or 2 with you to your favorite games (be sure you both like the games of course!) <br> <br>

                    <strong>Well.. so much for convince me..</strong> <br>Complaining can be easy, but enjoying is where they aim for. Try to read more if you go along the site, maybe we still get you warm for it!
                </p>
            </div>
        </div>
    </div>

@endsection