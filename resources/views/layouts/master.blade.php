<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

@yield('seo')

    <!-- Chrome, Firefox OS, Opera and Vivaldi -->
    <meta name="theme-color" content="#309dd8">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#309dd8">
    <meta name="msapplication-TileColor" content="#309dd8">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#309dd8">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{mix('css/app.css')}}">

    <!-- Font awesome -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('/icon/gamescomevent_logo.png') }}"/>
    <!-- Favicon for Apple -->
    <link rel="apple-touch-icon" href="{{ asset('/icon/gamescomevent_logo.png') }}"/>
    <!--[if IE]>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/icon/gamescomevent_logo.ico') }}" />
    <![endif]-->

    <!-- Javascripts -->

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <noscript><div class="message global noscript"><div class="content"><p><strong>JavasScript seems to be turned off (or doesn't support it) in your browser!</strong> <span>for the best user experience, please make sure that JavaScript is enabled for your browser.</span></p></div></div></noscript>
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
@if((App::environment('production')))
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-27613789-6"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-27613789-6');
</script>
@endif
<script src="{{mix('js/app.js')}}"></script>
</html>
