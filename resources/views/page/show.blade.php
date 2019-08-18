@extends('layouts.master')

@section('seo')
    @component("components.seo", ["title" => $page->title, "url" => url("publishers/" . $page->slug), "description" => $page->excerpt] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_image_section">
        <div class="featured_image greenblue" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{$page->title}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => [$page->slug => $page->title]])
                @endcomponent

            </div>
            <div class="col-md-9">
                <p><strong>{!! $page->excerpt !!}</strong></p>
                <br />
                <p>
                    {!! $page->body_html !!}
                </p>@guest
                @else
                    <br><a href="{{ url("admin/pages/" . $page->slug . "/edit") }}">Edit</a><br><br>
                @endguest
            </div>

            <div class="col-md-3 sidebar">
                @if($page->sidebar_title != null)
                <h2>{!! $page->sidebar_title !!}</h2>
                <p>
                    {!! $page->sidebar_body !!}
                </p>
                <div class="horizontal-line"></div>
                @endif
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
        </div>
    </div>
@endsection