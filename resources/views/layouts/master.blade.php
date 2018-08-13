<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="language" content="english">
    <meta name="Content-Language" content="english" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    @yield('seo')

    <!-- Chrome, Firefox OS, Opera and Vivaldi -->
    <meta name="theme-color" content="#309dd8">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#309dd8">
    <meta name="msapplication-TileColor" content="#309dd8">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#309dd8">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{asset('css/light-style.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Font awesome -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- Javascripts -->

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <header>
        <strong>
            <a href="{{url('/')}}">{{config('app.name')}}</a>
        </strong>
        @component("components.nav")
        @endcomponent
    </header>
    <main> @yield('content') </main>

    @component("components.footer")
    @endcomponent

</body>
<script>
    // if page is taller than the viewport height, redo the footer
    window.onload = function () {
        setFooterPosition();
    }

    document.body.onresize = function () {
        setFooterPosition();
    }

    function setFooterPosition() {
        var body = document.body,
            html = document.documentElement;

        var pageHeight = Math.max( body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight );

        var vwHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

        if (pageHeight <= vwHeight) {
            document.getElementsByTagName("footer")[0].style.bottom = "0";
        }
    }
</script>
@if((App::environment('production')))
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-27613789-6"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-27613789-6');
</script>
@endif
</html>
