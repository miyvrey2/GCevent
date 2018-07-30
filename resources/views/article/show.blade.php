@extends('layouts.master')

@section('content')
    @if($page->image_url)
        <section id="page_slider">
            <div class="sliderimg page_image grayscale" style="background-image:url('{{asset($page->image_url)}}')"></div>
        </section>
    @endif
    <section class="content-text">
        <div class="container">

            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                <a href="https://www.gamescomevent.com/" title="Home">Home</a> >
                <a href="https://www.gamescomevent.com/about/" title="What is Gamescom?">What is Gamescom?</a>
            </div>
            <!-- Breadcrumbs JSON -->
            <script type="application/ld+json">
				{
				  "@context": "http://schema.org",
				  "@type": "BreadcrumbList",
				  "itemListElement": [{
				    "@type": "ListItem",
				    "position": 1,
				    "item": {
				      "@id": "https://www.gamescomevent.com/",
				      "name": "Home",
				      "image": "https://www.gamescomevent.com/images/icon-home.png"
				    }
				  },{
				    "@type": "ListItem",
				    "position": 2,
				    "item": {
				      "@id": "https://www.gamescomevent.com/about/",
				      "name": "What is Gamescom?",
				      "image": "https://www.gamescomevent.com/images/icon-game.png"
				    }
				  }
				</script>

            <h1>{{$page->title}}</h1>
            <div class="post-meta no-border">
                <ul class="post-meta-group">
                    <li><i class="fa fa-user"></i><a href="#"> {{$page->author->name}} </a></li>
                    <li><i class="fa fa-clock-o"></i><time> {{$page->date}} </time></li>
                    {{--<li><i class="fa fa-folder"></i><a href="#"> {{$page->category->title }}</a></li>--}}
                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                </ul>
            </div>
            <div class="content-text">
                {!! $page->body_html !!}
            </div>
            <div class="clear"></div>
        </div>
    </section>

    ###################

    <article class="post-author padding-10">
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img alt="Author 1" src="{{asset('img/author.jpg')}}" class="media-object">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><a href="#"> {{$page->author->name}} </a></h4>
                <div class="post-author-count">
                    <a href="#">
                        <i class="fa fa-clone"></i>
                        90 posts
                    </a>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad aut sunt cum, mollitia excepturi neque sint magnam minus aliquam, voluptatem, labore quis praesentium eum quae dolorum temporibus consequuntur! Non.</p>
            </div>
        </div>
    </article>
@endsection