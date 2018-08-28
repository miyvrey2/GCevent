<!-- Breadcrumbs -->
<ul class="breadcrumbs">
    <li><a href="{{ url("/admin/dashboard") }}" title="{{__('breadcrumbs.dashboard')}}">{{__('breadcrumbs.dashboard')}}</a></li>
    @foreach($breadcrumbs as $key => $value)
        <li><a href="{{ url($key) }}" title="{{$value}}">{{$value}}</a></li>
    @endforeach
</ul>