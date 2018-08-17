    {{--Meta Tags for SEO--}}

    @php($standard_title = " | " . config('app.name', 'Laravel'))
    @php($standard_url = url(""))
    @php($standard_description = "Gamescom events shows the Gamescom species. Gamescom is a convention that is being held at Cologne(K&ouml;hn). Last year there was around a 340,000 visitors to come and watch all the works that are being showed here by popular game-developers.")
    @php($standard_author = "Gamescomevent.com redaction")
    @if(!isset($title)) @php($title = "Gamescom 2018 - Games, tournaments, cosplay & much more") @endif
    @if(!isset($url)) @php($url = $standard_url) @endif
    @if(!isset($author)) @php($author = $standard_author) @endif
    @if(!isset($description) || $description == "") @php($description = 'Learn more about ' . $title ) @endif
    @if(!isset($image)) @php($image = "https://www.gamescomevent.com/gfx/gamescom_17_010_010.jpg") @endif

    @php($description = substr($description, 0, 154))
    @if(strlen($description) >= 154)
    @php($end = strrpos($description, " "))
    @php($description = substr($description, 0, $end) . "...")
    @endif

    <title>{{ $title . $standard_title }}</title>

    <meta name="keywords" content="gamescom, games, koln, convention, germany, august, event, 2018, line-up, playable games, release" />
    <meta name="robots" content="index, follow" />
    <meta name="author" content="{{ $author }}" />
    <meta name="revisit-after" content="1 week" />
    <meta name="description" content="{{ $description }}" />
    <meta name="Content-Language" content="en"/>
    <meta name="robots" content="index,follow"/>

    <!-- Meta tags Dublin Core -->
    <meta name="DC.Title" content="{{ $title . $standard_title }}">
    <meta name="DC.Creator" content="{{ $author }}">
    <meta name="DC.Subject" content="{{ $title . $standard_title }}">
    <meta name="DC.Description" content="{{ $description }}">
    <meta name="DC.Publisher" content="{{ $author }}">
    <meta name="DC.Format" content="text/html">
    <meta name="DC.Language" content="en">

    <!-- Meta tags (OG - Facebook) -->
    <meta property="og:locale" content="en_EN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $title . $standard_title }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:url" content="{{ $url }}" />
    <meta property="og:site_name" content="{{ $standard_url }}" />
    <meta property="og:image" content="{{$image}}" />

    <!-- Meta tags (Twitter) -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@GCERedaction"/>
    <meta name="twitter:domain" content="{{ $standard_url }}"/>
    <meta name="twitter:creator" content="@GCERedaction"/>
    <meta name="twitter:description" content="{{ $description }}"/>

    <!-- Location -->
    <meta name="geo.region" content="DE" />
    <meta name="geo.placename" content="K&ouml;ln" />
    <meta name="geo.position" content="50.946663;6.983276" />
    <meta name="ICBM" content="50.946663, 6.983276" />
