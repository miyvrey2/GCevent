<h2>Overview</h2>

<ul class="meta">
    <li><a href="{{ url($exhibition->slug) }}">{{ $exhibition->title }}</a></li>
    <li><i class="fa fa-calendar" title="Starts"></i>From <a href="#">{{ $exhibition->starts_at->format('d M @ H:i') }}</a></li>
    <li><i class="fa fa-calendar" title="Closes"></i>Untill <a href="#">{{ $exhibition->ends_at->format('d M @ H:i') }}</a></li>
    <li><i class="fa fa-map-marker" title="Closes"></i>Address <a href="https://www.google.com/maps/place/{{ $exhibition->address }}">{{ $exhibition->address }}, {{ $exhibition->country }}</a></li>
</ul>