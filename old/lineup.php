<?php
	require_once('../components/squice.php');
	require_once('../components/header.php'); 
	
	$meta_object = array(
	'url' => 'https://www.gamescomevent.com/lineup/',
	'title' => 'The line up for Gamescom 2017 - All exhibitors || Gamescomevent',
	'description' => 'Each year does Gamescom provide a lot of exhibitors to show their new games. But the question raises which one they will show this year. This short overview will tell you where to look out for.',
	'description' => 'Each year does Gamescom provide a lot of exhibitors to show their new games. This short overview will tell you for which games to look out for.',
	'keywords' => 'gamescom, 2017, line-up, line up, hall 9, playable games, release',

	);
	
	echo set_header($meta_object);
?>
	<style>
		#page_slider .page_image:before{
			content:' ';
			width:100%;
			background-color:rgba(100,180,120,0.7);
			height:300px;
			position:absolute;
			display:block;
		}
		
		ul.indieList {
			padding-left: 0;
			list-style-type: none;
		}
		 
		.indieList li {
			padding-bottom: 14px;
		}
		
		.indieList a {
			color: black;
		    font-style: italic;
		    text-decoration: none;
		}
		
		.indieList b {
			 display: block;
    		font-style: normal;
			font-weight: 400;
			color: rgba(100,180,120,0.9);
		}
		
		.lineupcontent h2 {
			font-family: 'Open Sans', sans-serif;
    		font-weight: bold;
    		font-size: 20px;
			color: rgba(100,180,120,0.9);
		}
		
		table, tr, td  {
			vertical-align: top;
			border-collapse: collapse;
			border: 1px solid rgba(100,180,120,0.9);
		}
		
		thead, thead td {
			background-color: rgb(100,180,120);
			color: white;
			font-weight: bold;
			border: 1px solid rgba(80,160,120,0.9);
		}
		
		tr:nth-child(even) {
			background-color: #f2f2f2
		}
		
		td {
			padding: 5px;
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
		            <a href="https://www.gamescomevent.com/lineup/" title="Line up">Line up</a>
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
				      "@id": "https://www.gamescomevent.com/lineup/",
				      "name": "Line up",
				      "image": "https://www.gamescomevent.com/images/icon-game.png"
				    }
				  }
				</script>
				
				<h1 style="margin-left:0px !important;">Line up for 2017</h1>
				<div class="content-text">
					<h2>Halls</h2>
					<table>
						<thead>
							<tr>
								<td>Hall</td>
								<td>Exhibitors</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Hall 5.1<br /></td>
								<td>Alternate, Micro-Star, MIFCOM, Webedia Gaming</td>
							</tr>
							<tr>
								<td>Hall 5.2<br /><i>(Fan shop arena)</i></td>
								<td>Merchandise stands of more than 80 exhibitors</td>
							</tr>
							<tr>
								<td>Hall 6<br /></td>
								<td>Bandai Namco, Electronic Arts, Konami, Ubisoft</td>
							</tr>
							<tr>
								<td>Hall 7<br /></td>
								<td>Activision Blizzard, Blizzard Entertainment SAS, Sony Interactive Entertainment</td>
							</tr>
							<tr>
								<td>Hall 8<br /></td>
								<td>Activision Blizzard, Astragon, CD Projekt, Kalypso Media Group, Techland, Wargaming Europe, Xbox</td>
							</tr>
							<tr>
								<td>Hall 9<br /></td>
								<td>Amazon EU SARL, Deep Silver, ESL/Turtle Entertainment, Nintendo of Europe, Square Enix, Warner Bros</td>
							</tr>
							<tr>
								<td>Hall 10.1<br /></td>
								<td>Advanced Micro Devices, Bigpoint, Expert AG, Gaijin Network, INDIE ARENA BOOTH, Samsung Electronics, Travian Games, YouTube</td>
							</tr>
							<tr>
								<td>Hall 10.2<br /></td>
								<td>
									gamescom campus: Jugendforum NRW, SAE Institute, S4G, SRH<br />
								    gamescom jobs & career: ALDI International, Daimler AG, Freaks 4 U<br />
								    family & friends: Ak Tronic, Astragon, Bandai Namco, Deep Silver, Microsoft<br />
							    </td>
							</tr>
						</tbody>
					</table>
					<sub>please note: All halls contain more than just the currently shown exhibitors</sub><br />
				    <br />
				    
					<h2>Exhibitors</h2>
					<a class="lineupTitleCompany" href="https://www.bandainamcoent.com/" rel="nofollow">Bandai Namco</a><br />
					Project CARS 2 <br />
					Ni no Kuni II: Renevant Kingdom<br />
					Dragon Ball Fighter Z <br />
					Ace Combat 7: Skies Unknown <br />
					Naruto to Boruto Shinobi Striker <br />
					Little Nightmares <br />
					<?php //http://www.gameliner.nl/nieuwsitem/33137/gamescom-bandai-namco-onthult-gamescom-line-up ?>
					
					<!-- <a class="lineupTitleCompany" href="https://bethesda.net/" rel="nofollow">Bethesda</a><br /> -->
					<!-- Dishonored 2 (PS4, Xbox One, PC)<br /> -->
					<br />
					
					<a class="lineupTitleCompany" href="https://www.capcom.com/" rel="nofollow">Capcom</a><br />
					Monster Hunter: World (PS4, Xbox One)<br />
					Marvel vs. Capcom: Infinite (PS4, Xbox One)<br />
					<?php //www.evilgamerz.com/44248_Capcom-houdt-het-rustig-op-de-Gamescom.html ?>
					<br />
					
					<a class="lineupTitleCompany" href="https://www.ea.com/" rel="nofollow">EA</a><br />
					Star Wars Battlefront II<br />
					Need for Speed Payback<br />
					EA Sports FIFA 18<br />
					Battlefield 1: In the Name of the Tsar <br />
					Star Wars Galaxy of Heroes<br />
					FIFA Mobile<br />
					<?php //https://gamenerds.nl/electronic-arts-pakt-groots-uit-tijdens-gamescom-2017/ ?>
					<br />
					
					<!-- <a class="lineupTitleCompany" href="https://www.focus-home.com/" rel="nofollow">Focus Home</a><br /> -->
					<!-- Farming Simulator 17 (PS4, Xbox One, PC)<br />
					Seasons after Fall (PC)<br />
					Shiness: The Lightning Kingdom (TBA)<br />
					Space Hulk: Deathwing (PS4, Xbox One, PC)<br />
					Styx: Shards of Darkness (PS4, Xbox One, PC)<br />
					The Surge (PS4, Xbox One, PC)<br />
					Vampyr (PS4, Xbox One, PC)<br /> -->
					<!-- <br /> -->
					
					<a class="lineupTitleCompany" href="https://www.konami.com/" rel="nofollow">Konami (hal 6.1, stand A011)</a><br />
					Castlevenia: Lords of Shadow<br />
					Def Jam Rapstar<br />
					Metal Gear Survive<br />
					PES 2011<br />
					Pro Evolution Soccer 2018<br />
					<?php 
						//http://www.eurogamer.nl/articles/konami-gamescom-line-up-bekend
						//http://www.psx-sense.nl/287949/pes-2018-en-metal-gear-survive-speelbaar-op-gamescom/
					 ?>
					<br />
					
					<!-- <a class="lineupTitleCompany" href="https://www.nintendo.com/" rel="nofollow">Nintendo</a><br /> -->
					<a class="lineupTitleCompany" href="https://www.gamescomevent.com/exhibitors/nintendo/" rel="nofollow">Nintendo (Hall 9, stand B020)</a><br />
					ARMS (Switch)<br />
					Fire Emblem Warriors (Switch) <br />
					Mario + Rabbids® Kingdom Battle (Switch) <br />
					Mario & Luigi: Superstar Saga + Bowser’s Minions (3DS) <br />
					Metroid: Samus Returns (3DS) <br />
					Monster Hunter Stories™ (3DS) <br />
					Pokkén Tournament DX (Switch) <br />
					Splatoon 2 (Switch) <br />
					Super Mario Odyssey (Switch) <br />
					Xenoblade Chronicles 2 (not playable) <br />
					<?php
					// http://www.4gamers.be/nieuws/60906/1/Nintendo-stelt-Gamescom-line-up-voor?utm_source=headliner.nl&utm_medium=link&utm_term=free&utm_content=textlink&utm_campaign=Headliner.nl
					?>
					<br />
					
					<a class="lineupTitleCompany" href="https://www.square-enix.com/" rel="nofollow">Square Enix</a><br />
					Deus Ex: Mankind Divided (PS4, Xbox One)<br />
					Battalion 1944<br />
					Forgotton Anne (PS4, Xbox One and PC)<br />
					Oh My Godheads<br />
					Tokyo Dark<br />
					Deadbeat Heroes<br />
					<br />
					
					<a class="lineupTitleCompany" href="https://www.microsoft.com/en-us/store/apps/windows" rel="nofollow">Microsoft</a><br />
					Age of Empires Definitive Edition<br />
					Crackdown 3<br />
					Forza Motorsport 7<br />
					Sea of Thieves<br />
					...<i>and 23 others</i><br />
					<?php // https://www.gamereactor.nl/nieuws/523673/Team17+onthult+Gamescom+line-up/ ?>
					<br />
					
					<!-- <a class="lineupTitleCompany" href="https://www.rare.co.uk/" rel="nofollow">Rare</a><br />
					Sea of Thieves (Xbox One, PC)<br />
					<br /> -->
					
					<a class="lineupTitleCompany" href="https://www.sega.com/" rel="nofollow">Sega</a><br />
					Total War: Warhammer II<br />
					Sonic Forces<br /> 
					<br />
					
					
					<a class="lineupTitleCompany" href="https://www.team17.com/" rel="nofollow">Team 17 (Hall 8)</a><br />
					Escapists 2<br />
					Genesis Alpha One<br /> 
					Sword Legacy: Omen<br /> 
					Yoku's Island Express<br />
					<br />
					
	
					<a class="lineupTitleCompany" href="https://www.thq.com/" rel="nofollow">THQ</a><br />
					ELEX<br />
					Battle Chasers: Nightwar<br /> 
					Spellforce 3<br /> 
					Aquanox: Deep Descent<br />
					The Guild 3<br />
					Wreckfest<br />
					<br />
					
					<a class="lineupTitleCompany" href="https://www.ubisoft.com/" rel="nofollow">Ubisoft</a><br />
					Assassin's Creed Origins<br />
					Far Cry 5<br /> 
					For Honor<br />
					Just dance 2018<br />
					Mario + Rabbids Kingdom Battle<br /> 
					South Park: The Fractured But Whole<br />
					The Crew 2<br />
					Tom Clancy's Ranbow Six Siege <br />
					<br />
					
					
					<!-- <strong>Rumors</strong><br /> -->
					<!-- <a class="lineupTitleCompany" href="https://www.google.com/" rel="nofollow">Company X</a><br />
					Game X<br /> -->
					<!-- <br /> -->
					<!-- <h3 style="margin-left:0px !important;">Announcements - rumors only</h3> -->
					
					
					<h2>Indie games</h2>
					<ul class="indieList">
						<li><a href="http://indiearenabooth.de/presskit,view,3,513.html" rel="nofollow" target="_blank"><b>A Hat in Time</b> by Gears for Breakfast</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,405.html" rel="nofollow" target="_blank"><b>A Room Beyond</b> by René Bühling</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,520.html" rel="nofollow" target="_blank"><b>Unannounced project, spiritual successor to A Normal Lost Phone</b> by Accidental Queens</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,536.html" rel="nofollow" target="_blank"><b>Aegis Defenders</b> by GUTS Department</a></li>
						<li><b>AER - Memories of Old</b> by Forgotten Key</li>
						<li><b>All I Have is Time</b> by THREAKS</li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,462.html" rel="nofollow" target="_blank"><b>Ary and the secret of seasons</b> by eXiin</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,518.html" rel="nofollow" target="_blank"><b>Away: Journey to the Unexpected</b> by Aurélien Regard</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,514.html" rel="nofollow" target="_blank"><b>Battle Bolts</b> by Shot Second</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,507.html" rel="nofollow" target="_blank"><b>Behind Stars and Under Hills</b> by Rat King</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,186.html" rel="nofollow" target="_blank"><b>Black The Fall</b> by Sand Sailor Studio</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,537.html" rel="nofollow" target="_blank"><b>Blind</b> by Tiny Bull</a></li>
						<li><b>Chaos auf Deponia</b> by Daedalic Entertainment GmbH</li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,250.html" rel="nofollow" target="_blank"><b>Code 7 – Episode 1: Threading</b> by Goodwolf Studio</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,414.html" rel="nofollow" target="_blank"><b>Dead Cells</b> by Motion Twin</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,523.html" rel="nofollow" target="_blank"><b>Dead In Vinland</b> by CCCP</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,385.html" rel="nofollow" target="_blank"><b>Deru - The Art of Cooperation</b> by Ink Kit GmbH</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,190.html" rel="nofollow" target="_blank"><b>Dimension Drive</b> by 2Awesome Studio</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,437.html" rel="nofollow" target="_blank"><b>Distance</b> by Refract</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,398.html" rel="nofollow" target="_blank"><b>Downward Spiral: Prologue</b> by 3rd Eye Studios Oy Ltd</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,310.html" rel="nofollow" target="_blank"><b>EVERSPACE</b> by ROCKFISH Games</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,226.html" rel="nofollow" target="_blank"><b>FAR: Lone Sails</b> by Okomotive (part of Mr. Whale's Game Service) / Mixtvision</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,472.html" rel="nofollow" target="_blank"><b>Felix The Reaper</b> by Kong Orange</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,369.html" rel="nofollow" target="_blank"><b>FOX n FORESTS</b> by Bonus Level Entertainment</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,524.html" rel="nofollow" target="_blank"><b>Frostpunk</b> by 11 bit studios</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,509.html" rel="nofollow" target="_blank"><b>Fugl</b> by Team Fugl</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,535.html" rel="nofollow" target="_blank"><b>GRIDD: Retroenhanced</b> by Antab Studio</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,347.html" rel="nofollow" target="_blank"><b>Halcyon 6: Starbase Commander</b> by Massive Damage, Inc.</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,530.html" rel="nofollow" target="_blank"><b>Heavy Metal Machines</b> by Hoplon Infotainment</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,515.html" rel="nofollow" target="_blank"><b>I Hate Running Backwards</b> by Binx Interactive</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,519.html" rel="nofollow" target="_blank"><b>Jengo</b> by Robot Wizard</a></li>
						<li><b>Keyboard Sports - The final tribute</b> by Triband</li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,390.html" rel="nofollow" target="_blank"><b>Legrand Legacy</b> by SEMISOFT</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,481.html" rel="nofollow" target="_blank"><b>Light Fall</b> by Bishop Games</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,428.html" rel="nofollow" target="_blank"><b>LIGHTFIELD</b> by Lost in the Garden</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,459.html" rel="nofollow" target="_blank"><b>Lonely Mountains: Downhill</b> by Megagon Industries</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,452.html" rel="nofollow" target="_blank"><b>Megaton Rainfall</b> by Pentadimensional Games</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,527.html" rel="nofollow" target="_blank"><b>Moonlighter</b> by Digital Sun</a></li>
						<li><b>Moons of Madness</b> by Rock Pocket Games</li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,483.html" rel="nofollow" target="_blank"><b>MOTHERGUNSHIP</b> by Grip Digital s.r.o.</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,521.html" rel="nofollow" target="_blank"><b>Necrosphere</b> by Cat Nigiri</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,510.html" rel="nofollow" target="_blank"><b>Nine Parchments</b> by Frozenbyte</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,531.html" rel="nofollow" target="_blank"><b>No Heroes Here</b> by Mad Mimic Interactive</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,516.html" rel="nofollow" target="_blank"><b>No Truce With The Furies</b> by ZA/UM Studio</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,444.html" rel="nofollow" target="_blank"><b>Nova Nukers!</b> by Lemonbomb Entertainment GmbH</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,419.html" rel="nofollow" target="_blank"><b>Oh My Godheads</b> by Titutitech, SL</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,538.html" rel="nofollow" target="_blank"><b>Orwell</b> by Osmotic Studios</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,522.html" rel="nofollow" target="_blank"><b>Pankapu: The Lost Aegis</b> by Too Kind Studio</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,168.html" rel="nofollow" target="_blank"><b>Planetoid Pioneers</b> by Data Realms</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,176.html" rel="nofollow" target="_blank"><b>Pressure Overdrive</b> by Chasing Carrots</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,479.html" rel="nofollow" target="_blank"><b>Reverse: Time Collapse</b> by Meangrip</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,426.html" rel="nofollow" target="_blank"><b>RITE of ILK</b> by Turtleneck Studios</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,487.html" rel="nofollow" target="_blank"><b>Russian Subway Dogs</b> by Spooky Squid Games Inc.</a></li>
						<li><b>Scorn</b> by EBB SOFTWARE D.O.O.</li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,373.html" rel="nofollow" target="_blank"><b>Semblance</b> by Nyamakop</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,184.html" rel="nofollow" target="_blank"><b>Shift Quantum</b> by Fishing Cactus</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,365.html" rel="nofollow" target="_blank"><b>SKARA The Blade Remains</b> by SKARA The Blade Remains Ltd</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,220.html" rel="nofollow" target="_blank"><b>Slime-san</b> by Fabraz</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,361.html" rel="nofollow" target="_blank"><b>Solo</b> by Team Gotham</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,532.html" rel="nofollow" target="_blank"><b>Starlit Archery Club</b> by Rockhead Games</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,511.html" rel="nofollow" target="_blank"><b>Staxel</b> by Plukit</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,372.html" rel="nofollow" target="_blank"><b>Stifled</b> by Gattai Games</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,386.html" rel="nofollow" target="_blank"><b>Stormbound: Kingdom Wars</b> by Paladin Studios</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,316.html" rel="nofollow" target="_blank"><b>Strikers Edge</b> by Fun Punch Games</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,474.html" rel="nofollow" target="_blank"><b>sU and the Quest for meaning</b> by Guillaume Bouckaert</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,543.html" rel="nofollow" target="_blank"><b>Super Fancy Pants Adventure</b> by Borne Games</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,280.html" rel="nofollow" target="_blank"><b>The Inner World - The Last Windmonk</b> by Studio Fizbin</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,440.html" rel="nofollow" target="_blank"><b>The InnerFriend</b> by PLAYMIND</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,539.html" rel="nofollow" target="_blank"><b>Think of the Children</b> by Jammed Up Studios</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,344.html" rel="nofollow" target="_blank"><b>Tiny Tanks</b> by LeadFollow Games</a></li>
						<li><a href="http://indiearenabooth.de/presskit,view,3,468.html" rel="nofollow" target="_blank"><b>UnderRaid</b> by Dynamic Deadlines GmbH & Co. KG</a></li>
						</ul>
					
					
				</div> 
				<div class="clear"></div>
			</div>
		</section>
	</main>
<?php echo require('footer.php'); ?>