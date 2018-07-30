<?php
	require_once('../components/squice.php');
	require_once('../components/header.php'); 
	
	$meta_object = array(
	'url' => 'https://www.gamescomevent.com/about/',
	'title' => 'What is Gamescom?! The pro\'s and con\'s || gamescomevent',
	'description' => 'Gamescom events shows the Gamescom species. Gamescom is a convention that is being held at Cologne(K&ouml;hn). Last year there was around a 340,000 visitors to come and watch all the works that are being showed here by popular game-developers.',
	'keywords' => 'gamescom, games, koln, convention, germany, august, event, 2017, line-up, hall 9, playable games, release',

	);
	
	echo set_header($meta_object);
?>
	<style>
		#page_slider .page_image:before{
			content:' ';
			width:100%;
			background-color:rgba(230,180,100,0.7);
			background-color:rgba(48,157,216,0.7);
			height:300px;
			position:absolute;
			display:block;
		}
		
		h2 {
		    font-family: 'Open Sans', sans-serif;
		    font-weight: bold;
		    font-size: 20px;
		    color: rgba(48,157,216,0.7);
		}
		
	</style>
	<main>
		<section id="page_slider">
			<div class="sliderimg page_image grayscale" style="background-image:url('/gfx/slider_image_01_mini.jpg')"></div>
		</section>
		<section class="content-text">
			<div class="container">
				
				<!-- Breadcrumbs -->
				<div class="breadcrumbs">
		            <a href="https://www.gamescomevent.com/" title="Home">Home</a> >
		            <a href="https://www.gamescomevent.com/about/" title="What is Gamescom?">What is Gamescom?</a>
				</div>
				<!-- Breadcrumbs JSON -->
				<script type="application/ld+json">
				{
				  "@context": "http://schema.org",
				  "@type": "BreadcrumbList",
				  "itemListElement": [{
				    "@type": "ListItem",
				    "position": 1,
				    "item": {
				      "@id": "https://www.gamescomevent.com/",
				      "name": "Home",
				      "image": "https://www.gamescomevent.com/images/icon-home.png"
				    }
				  },{
				    "@type": "ListItem",
				    "position": 2,
				    "item": {
				      "@id": "https://www.gamescomevent.com/about/",
				      "name": "What is Gamescom?",
				      "image": "https://www.gamescomevent.com/images/icon-game.png"
				    }
				  }
				</script>
				
				<h1>What is gamescom?</h1>
				<div class="content-text">
					<h2>So, you talk about gamescom.. but what exactly is it?</h2>
					<p>Gamescom is a convention where the gamers among us feel completely at home. Once a year the Koelnmesse exhibition halls are filled with the latest ( and retro ! ) games , consoles and all what not to play is dedicated . Companies ( both large and small ) in the game industry here show their latest work and offer the chance to see some games even play , for they are in the store.</p>
					<br />
					<p>The stock market has a total of 201,000 m2 where to find everything. This space is spread over a number of halls . So there are halls for the latest games and consoles . This is the biggest part . There is also a ( part of) a hall reserved for merchandise . There are also areas classified for promotion of hardware , studies, retro games , sports and dining. There are also two separate halls for the so-called "trade visitors" and the press. These halls are also called the " business area " called . Here are separate tickets for , and the stock market is also a day earlier open to this kind of visitors .</p>
					<br />
					<p>Along with 345,000 other visitors , is the 9th anniversary celebration of gamescom last year. The highlights of this party were the One Xbox and Playstation 4 that were playable . There were also events such as League of Legends tournaments.</p>
					<br />
					<p style="font-size:10px;">this part of the site has been translated by google translate. Don't worry, we will "re"-translate this in a few days.</p>
				</div> 
				<div class="clear"></div>
			</div>
		</section>
	</main>
<?php require_once("footer.php"); ?>
