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
    <script src="lib/js/slider.js"></script>

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <header>
        <strong>
            <a href="{{url('/')}}">Gamescomevent.com</a>
        </strong>
        @component("components.nav")
        @endcomponent
    </header>

    <main>
        @yield('content')
    </main>


    <footer>
        this content belongs all to the original website gamescom.de
    </footer>
</body>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-72183898-1', 'auto');
    ga('send', 'pageview');

</script>
</html>
