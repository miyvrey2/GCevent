<?php
	require_once('../../components/squice.php');
	require_once('../../components/header.php'); 
	
	$meta_object = array(
	'url' => 'https://www.gamescomevent.com/exhibitors/nintendo/',
	'title' => 'Nintendo on Gamescom 2017 - Games, Lineup & more || Gamescomevent',
	'description' => 'With the Nintendo Switch\' new game Splatoon 2 just released, many people start to wonder what kind of new Nintendo will have for Gamescom.',
	'keywords' => 'gamescom, 2017, line up, hall 9, nintendo, splatoon, mario, playable games, release',

	);
	
	echo set_header($meta_object);
?>
	<style>
		#page_slider .page_image:before{
			content:' ';
			width:100%;
			background-color:rgba(180,100,120,0.7);
			height:300px;
			position:absolute;
			display:block;
		}
		 
		h2 {
		    font-family: 'Open Sans', sans-serif;
		    font-weight: bold;
		    font-size: 20px;
		    color: rgba(220,50,60,0.6);
		}
		
		h3 {
			color: rgba(220,50,60,0.7);
		}
		
	
	</style>
	<main>
		<section id="page_slider">
			<div class="sliderimg page_image grayscale" style="background-image:url('/gfx/slider_image_01_mini.jpg')"></div>
		</section>
		<section class="content-text">
			<div class="container lineupcontent">
				
				<!-- Breadcrumbs -->
				<div class="breadcrumbs">
		            <a href="https://www.gamescomevent.com/" title="Home">Home</a> >
		            <a href="https://www.gamescomevent.com/exhibitors/" title="Exhibitor">Exhibitors</a> >
		            <a href="https://www.gamescomevent.com/exhibitors/nintendo/" title="Nintendo">Nintendo</a>
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
				      "@id": "https://www.gamescomevent.com/exhibitors/",
				      "name": "Exhibitors",
				      "image": "https://www.gamescomevent.com/images/icon-game.png"
				    }
				  },{
				    "@type": "ListItem",
				    "position": 3,
				    "item": {
				      "@id": "https://www.gamescomevent.com/exhibitors/nintendo",
				      "name": "Nintendo",
				      "image": "https://www.gamescomevent.com/images/icon-game.png"
				    }
				  }]
				}
				</script>
				
				<h1>Nintendo</h1>
					
				<div class="content-text">
					<h2>Summary</h2>
					<p>
						<!-- Dit jaar zal Nintendo in hal 9 staan (stand A021, B020, A011, B010, B021). De stand staat bij de ingang aan de kant van de boulevard. De speelbare games zijn: -->
						This year Nintendo will stand in Hall 9 (stand A021, B020, A011, B010, B021). You will find the stand at the entrance on the side of the boulevard. The playable games are:
					</p>
					<ul>
						<li>ARMS (Switch)</li>
						<li>Fire Emblem Warriors (Switch) </li>
						<li>Mario + Rabbids® Kingdom Battle (Switch) </li>
						<li>Mario & Luigi: Superstar Saga + Bowser’s Minions (3DS) </li>
						<li>Metroid: Samus Returns (3DS) </li>
						<li>Monster Hunter Stories™ (3DS) </li>
						<li>Pokkén Tournament DX (Switch) </li>
						<li>Splatoon 2 (Switch) </li>
						<li>Super Mario Odyssey (Switch) </li>
					</ul>
					<br />
					
					<h2>Introduction</h2>
					<p>
						<!-- Sinds jaar en dag is Nintendo bekend in de game branche. Met als mascotte Mario is het bedrijf al meer dan 30 jaar bekend. De focus voor Nintendo ligt, in plaats zich te richten op hoogwaardige graphics, voornamelijk op de gameplay. Het is ook dan niet verwonderlijk dat er fans zijn van onder andere Mario, Luigi, Link, Samus, Kirby en nog vele anderen. -->
						Nintendo is well known in the game industry. Alongside with the famous mascot Mario is the company known for over 30 years. The focus for Nintendo is, rather than to focus on high-quality graphics, mainly on the gameplay. It is also not surprising that fans are, among other things, Mario, Luigi, Link, Samus, Kirby and many others.
					</p>
					<br />
				    
					<h2>This year</h2>
					<p>
						<!-- Op 3 maart 2017 is de Switch gereleased, tezamen met The legend of Zelda, Breath of the Wild. Omdat Nintendo deze zomer meer spellen wilt presenteren (Splatoon 2, Mario Odyssey) is de hoop ook groot dat deze games zich laten zien op de beursvloer. Daarnaast zijn evenementen niet onbekend voor Nintendo, en kan het zomaar zijn dat er weer een actie loopt voor een speciale titel of een ludieke actie vanwege een jubileum! -->
						On March 3, 2017 is the Switch released, together with The legend of Zelda, Breath of the Wild. This summer more because Nintendo Games want to present (Splatoon 2, Mario Odyssey) is also great hope that these games show itself on the show floor. In addition, events are not unknown for Nintendo, and it may just be that there will be another giveaway ends for a special title or a playful action because of an anniversary!
					</p>
					<br />
					
					<h2>Location</h2>
					<img src="https://gamescomevent.com/lib/images/2017_stand_nintendo.jpg" alt="Stand location Hall 9 for Nintendo" /><br />
					<sub>The Nintendo stand in Hall 9, as found <a rel="nofollow" target="_blank" href="http://www.gamescom-cologne.com/gamescom/exhibitor-search/exhibition-halls/index.php?fw_goto=hallenplan/index&kid=0013057691&halle=9.1&standnr=A011+B010%2C+A021+B020#plan">here</a>.</sub>
					
				</div> 
				<div class="clear"></div>
			</div>
		</section>
	</main>
<?php require_once('../footer.php'); ?>