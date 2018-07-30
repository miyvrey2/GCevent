@foreach($pages as $page)
    <a href="{{url($page->slug)}}">{{$page->title}}</a> <br />
@endforeach