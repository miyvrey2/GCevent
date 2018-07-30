<?php
$host     =	"localhost";
$username =	"admin_gamesc";
$password =	"79mUsRsW";
$db_name  =	"admin_gamesc"; 
$tbl_name =	"visitors";

mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$new_query = mysql_query("SELECT `browser`,`id`, COUNT(`browser`) AS nums FROM visitors GROUP BY `browser`");
$land_query = mysql_query("SELECT `country`,`id`, COUNT(`country`) AS nums FROM visitors GROUP BY `country`");
$total_query = mysql_query("SELECT `id`, COUNT(`id`) AS total FROM visitors");
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>
		gamescomevent || Find all the information about Gamescom here!
	</title>
	<meta charset="UTF-8">
	<link href="/lib/css/dark-style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Exo+2:400,200" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	
	<link href="/lib/css/font-awesome.css" rel="stylesheet">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	 <meta name="robots" content="index, follow" />
    <meta name="author" content="Gamescom event" />
    
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<header>
		<h1> 
			<a href="http://gamescomevent.com/">Gamescomevent.com</a> 
		</h1>
		<nav>
			<ul>
				<li><a href="http://gamescomevent.com/" alt="homepage">Home </a>|&nbsp;</li>
				<li><a href="#" alt="What is gamescom">What is Gamescom? </a>|&nbsp;</li>
				<li><a href="#" alt="News">News </a>|&nbsp;</li>
				<li><a href="#" alt="Program">Program </a>|&nbsp;</li>
				<li><a href="#" alt="Tips and Hints">Tips and Hints </a></li>
			</ul>
			<div class="social-icons">
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-google-plus"></i></a>
				<a href="#"><i class="fa fa-youtube"></i></a>
				<!--<a href="#"><i class="fa fa-linkedin"></i></a>-->
			</div>
		</nav>
	</header>
	<main>
		<section id="page_slider">
			<div class="sliderimg page_image" style="background-image:url('/gfx/slider_image_00_mini.jpg')"></div>
		</section>
		<section class="content-text">
			<div class="container">
				<h3 style="margin-left:0px;">Web statistics</h3>
				<div class="content-text">
					<?php 
					while ($rowa = mysql_fetch_array($total_query)) {
						$total_nums = $rowa['total'];
						$sum = 100/$total_nums;

						while ($row = mysql_fetch_array($new_query)) {
							$browser = $row['browser'];
							$nums = $row['nums'];
							if($nums == 1){
								echo $browser .' has viewed this website '. $nums. ' time <div class="full"><div class="part-yellow" style="width:'.round($sum*$nums,2).'%;"></div></div><br />';
							}
							else{
								echo $browser .' has viewed this website '. $nums. ' times <div class="full"><div class="part-yellow" style="width:'.round($sum*$nums,2).'%;"></div></div><br />';
							}
						}?>
						<br /><br />
						<h3 style="margin-left:0px;">Countries</h3>
						<?php
						while ($row = mysql_fetch_array($land_query)) {
							$country = $row['country'];
							if ($country == NULL){$country = 'Davy Jones Locker';}
							$nums = $row['nums'];
							if($nums == 1){
								echo $country .' has '. $nums. ' time visited us<div class="full"><div class="part-blue" style="width:'.round($sum*$nums,2).'%;"></div></div><br />';
							}
							else{
								echo $country .' has '. $nums. ' times visited us<div class="full"><div class="part-blue" style="width:'.round($sum*$nums,2).'%;"></div></div><br />';
							}
						}
						
						
						
						echo '<br /><br /><h3 style="margin-left:0px;"> Total: </h3>';
						echo $rowa['total'] .' visitors so far<br />';
					}
					?> 					
				</div>
			</div>
		</section>
	</main>
</body>