@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => __('breadcrumbs.publishers'), "url" => url("publishers"), "description" => 'A great number of contributors, exhibitors and publishers are represented at Gamescom. For as far is there each year an increasement in their numbers. '] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image pinkpurple" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show exhibition-show">
        <div class="row">

            <div class="col-md-12">

                {{-- Title --}}
                <h1>Exhibitors for {{$exhibition->title}}</h1>

                {{-- Breadcrumbs --}}
                @component('components.breadcrumbs', ['breadcrumbs' => [$exhibition->slug => $exhibition->title,  url($exhibition->slug . '/lineup') => "Exhibitors for " . $exhibition->title]])
                @endcomponent

                <p><strong>A great number of contributors, exhibitors and publishers are represented at Gamescom. For as far is there each year an increasement in their numbers.</strong></p>
                <br />
            </div>
            <div class="col-md-9">

                @foreach($exhibition->publishers as $publisher)
                    <a href="{{url('publishers/' . $publisher->slug)}}">{{$publisher->title}}</a> <br />
                @endforeach

            </div>
            <div class="col-md-3 sidebar">
                @component('exhibition.sidebar', compact('exhibition'))
                @endcomponent

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

                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({
                        google_ad_client: "ca-pub-5113287686102695",
                        enable_page_level_ads: true
                    });
                </script>
            </div>
        </div>
    </div>

@endsection