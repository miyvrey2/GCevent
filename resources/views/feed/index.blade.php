<a href="{{url('crawler/crawl')}}">Crawl</a>
<a href="{{url('crawler/gametitles')}}">Find game titles</a>
<br />
@foreach($feed_items as $item)
    {{$item['published_at']}} - {{htmlspecialchars_decode($item['title'])}} <a target="_blank" href="{{$item['url']}}">link</a> - <em>@if(isset($item->game->title)){{$item->game->title}}@endif</em><br>
@endforeach