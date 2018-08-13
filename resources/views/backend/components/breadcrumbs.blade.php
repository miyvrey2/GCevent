<!-- Breadcrumbs -->
<ul class="breadcrumbs">
    <li><a href="{{ url("") }}" title="{{__('breadcrumbs.home')}}">{{__('breadcrumbs.home')}}</a></li>
    @foreach($breadcrumbs as $key => $value)
        <li><a href="{{ url($key) }}" title="{{$value}}">{{$value}}</a></li>
    @endforeach
</ul>
<!-- Breadcrumbs JSON -->
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "item": {
      "@id": "{{url("")}}",
      "name": "{{__('breadcrumbs.home')}}"
    }
  }
  @php($listitem = 2)
  @foreach($breadcrumbs as $key => $value)
   ,{
    "@type": "ListItem",
    "position": {{$listitem}},
    "item": {
      "@id": "{{url($key)}}",
      "name": "{{$value}}"
    }
    @php($listitem++)
    @endforeach
  }
</script>