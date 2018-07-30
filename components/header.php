<?php 

function set_header($meta_object) {
	if(!$meta_object) {
		$meta_object['title'] = 'title';
		$meta_object['description'] = 'description';
		$meta_object['keywords'] = 'keywords';
		$meta_object['url'] = 'https://www.gamescomevent.com/';
		
	}
	
	return '<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>'. $meta_object['title'] . '</title>
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta http-equiv="language" content="english">
	    <meta name="Content-Language" content="english" />
	    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	    <meta http-equiv="cache-control" content="no-cache" />
	    <meta http-equiv="pragma" content="no-cache" />

		<!-- Viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Meta Tags for SEO -->
		<meta name="keywords" content="'. $meta_object['keywords'] . '" />
	    <meta name="robots" content="index, follow" />
	    <meta name="author" content="Ethan Bron" />
		<meta name="revisit-after" content="1 week" />
		<meta name="description" content="'. $meta_object['description'] . '" />
	    
	    <!-- Chrome, Firefox OS, Opera and Vivaldi -->
	    <meta name="theme-color" content="#309dd8">
	    <!-- Windows Phone -->
	    <meta name="msapplication-navbutton-color" content="#309dd8">
	    <meta name="msapplication-TileColor" content="#309dd8">
	    <!-- iOS Safari -->
	    <meta name="apple-mobile-web-app-status-bar-style" content="#309dd8">
	    
	    <!-- Meta tags (OG - Facebook) -->
	    <meta property="og:locale" content="en_EN" />
	    <meta property="og:type" content="article" />
	    <meta property="og:title" content="'. $meta_object['title'] . '" />
	    <meta property="og:description" content="'. $meta_object['description'] . '" />
	    <meta property="og:url" content="'. $meta_object['url'] . '" />
	    <meta property="og:site_name" content="www.gamescomevent.com" />
	    <meta property="og:image" content="https://www.gamescomevent.com/gfx/slider_image_00_mini.jpg" />

        <!-- Stylesheets -->
        <link href="https://www.gamescomevent.com/lib/css/light-style.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Exo+2:400,200" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://www.gamescomevent.com/lib/css/slider.css"/>

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
            <a href="https://gamescomevent.com/">Gamescomevent.com</a>
        </strong>
        <nav>
            <ul id="navigation_menu" itemscope itemtype="http://www.schema.org/SiteNavigationElement">
                <li itemprop="name"><a itemprop="url" href="https://www.gamescomevent.com/">Home</a> |&nbsp;</li>
                <li itemprop="name"><a itemprop="url" href="https://www.gamescomevent.com/about/">What is Gamescom?</a> |&nbsp;</li>
                <li itemprop="name"><a itemprop="url" href="https://www.gamescomevent.com/lineup/">Line up</a> |&nbsp;</li>
                <li itemprop="name"><a itemprop="url" href="https://www.gamescomevent.com/program/">Program</a> |&nbsp;</li>
                <li itemprop="name">Tips and Hints</li>
            </ul>
            <!-- <div class="social-icons">
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
            </div> -->
        </nav>
    </header>';
}