    {{--Meta Tags for SEO--}}

    @php($standard_title = " | " . config('app.name', 'Laravel'))
    @php($standard_url = url(""))
    @php($standard_description = "Gamescom events shows the Gamescom species. Gamescom is a convention that is being held at Cologne(K&ouml;hn). Last year there was around a 340,000 visitors to come and watch all the works that are being showed here by popular game-developers.")
    @if(!isset($title)) @php($title = "Gamescom 2018 - Games, tournaments, cosplay & much more") @endif
    @if(!isset($url)) @php($title = $standard_url) @endif
    @if(!isset($description)) @php($description = $standard_description) @endif
    @if(!isset($image)) @php($image = "https://www.gamescomevent.com/gfx/gamescom_17_010_010.jpg") @endif

    @php($description = substr($description, 0, 220))
    @php($end = strrpos($description, " "))
    @php($description = substr($description, 0, $end) . "...")

    <title>{{ $title . $standard_title }}</title>

    <meta name="keywords" content="gamescom, games, koln, convention, germany, august, event, 2018, line-up, playable games, release" />
    <meta name="robots" content="index, follow" />
    <meta name="author" content="Ethan Bron" />
    <meta name="revisit-after" content="1 week" />
    <meta name="description" content="{{ $description }}" />

    {{--Meta tags (OG - Facebook)--}}
    <meta property="og:locale" content="en_EN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $title . $standard_title }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:url" content="{{ $url }}" />
    <meta property="og:site_name" content="{{ $standard_url }}" />
    <meta property="og:image" content="{{$image}}" />
