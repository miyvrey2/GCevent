@extends('layouts.master')

@section('content')

<section id="featured_image_section">
    <div class="featured_image yellowpink" style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
</section>

<div class="container game-show">
    <div class="row">
        <div class="col-md-12">
            <a href="{{url('crawler/crawl')}}">Crawl</a>
            <a href="{{url('crawler/gametitles')}}">Find game titles</a>
            <a href="{{url('crawler/removeDuplicates')}}">removeDuplicates</a>
            <br />

            @foreach($feed_items as $item)
                <form method="post" action="/crawler/delete/{{$item->id}}" class="game-show-delete">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times fa-red"></i></button>
                </form>
                {{$item['published_at']}} - {{htmlspecialchars_decode($item['title'])}} <a target="_blank" href="{{$item['url']}}">link</a> - <em>@if(isset($item->game->title)){{$item->game->title}}@endif</em><br>
            @endforeach

        </div>
    </div>
</div>
@endsection