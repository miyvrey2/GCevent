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

@yield('seo')

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Chrome, Firefox OS, Opera and Vivaldi -->
    <meta name="theme-color" content="#309dd8">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#309dd8">
    <meta name="msapplication-TileColor" content="#309dd8">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#309dd8">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{mix('css/backend-app.css')}}">

    <!-- Font awesome -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

    <!-- Javascripts -->

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body id="admin-panel">
<header>
    <strong>
        <a href="{{url('/')}}">{{config('app.name')}}</a>
    </strong>
    @component("backend.components.nav")
    @endcomponent
</header>

<main>
    @yield('content')
</main>

@component("backend.components.footer")
@endcomponent
</body>
<script src="{{mix('js/app.js')}}"></script>
</html>
