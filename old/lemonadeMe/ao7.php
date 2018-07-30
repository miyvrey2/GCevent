<?php 
// Losse kosten en waardes
$aantalMensen 	= 12;
$aantalAutos 	= 3;
$aantalGCdagen 	= 3;
$kostenGCEntree	= number_format(11.50, 2);
$kostenLunch 	= number_format(15, 2);
$kostenDiner	= number_format(20, 2);
$kostenSticker	= number_format(15, 2);
$kostenBenzin 	= number_format(90, 2);

$kostenGarage	= number_format(12.95, 2);
$kostenPark   	= ($kostenGarage * $aantalGCdagen * $aantalAutos) + ($kostenBenzin * $aantalAutos) + ($kostenSticker * $aantalAutos);
$kostenPark		= number_format($kostenPark, 2);
$kostenParkPP  	= number_format($kostenPark / $aantalMensen, 2);
// Hotel Kosten berekenen
$hotelPerNacht 	= number_format(40, 2);
$hotelDagen 	= intval(4);
$kostenHotelPP 	= $hotelPerNacht * $hotelDagen;
$kostenHotelPP 	= number_format($kostenHotelPP, 2);
$kostenHotelTot	= $hotelPerNacht * $hotelDagen * $aantalMensen;
$kostenHotelTot = number_format($kostenHotelTot, 2);

// Totale Kosten (per persoon en allemaal)
$kostenTotaalPP	= $kostenHotelPP + ($aantalGCdagen * $kostenGCEntree) /*+ $kostenLunch + $kostenDiner*/ + ($kostenPark / $aantalMensen);
$kostenTotaalPP = number_format($kostenTotaalPP, 2);
$kostenTotaalRe = $kostenTotaalPP * $aantalMensen;
$kostenTotaalRe = number_Format($kostenTotaalRe, 2);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="language" content="english" />
		<title>
			Gamescom 2017 kostenplaatje
		</title>
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/x-icon" href="http://www.gamescomevent.com/icon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="description" content="Gamescom is a convention that is being held at Cologne(K&ouml;hn). Last year there was around a 340,000 visitors to come and watch all the works that are being showed here by popular game-developers. " />
	    <meta name="keywords" content="gamescom, games, koln, convention, germany, august " />
	    <meta name="robots" content="index, follow" />

	    <!-- Import javascript -->
	    <script src='http://gamescomevent.com/js/jquery.js'></script>
	    <script src='http://gamescomevent.com/js/jquery-ui-1.9.2.custom.js'></script>
	    <script src='http://gamescomevent.com/js/bootstrap.js'></script>
	    <script src='http://gamescomevent.com/js/Chart.min.js'></script>
	    <script src='http://gamescomevent.com/js/bootstrap-multiselect.js'></script>

		<style>
		*{
			top: 0px;
			margin: 0px;
			padding: 0px;
			font-family: 'Ubuntu', sans-serif;
		}
		header{
			position:relative;
			width: 100%;
			height: 500px;
			background-image:url('http://www.pctipp.ch/fileadmin/media/bilder/artikelbilder/gamescom_13_022_009.jpg');
			background-size: cover;
			background-position: center;
		}

		.container{
			position: relative;
			width: 1280px;
			min-height: 10px;
			margin: 0px auto;
		}

		.container h2{
			padding-top:30px;
			margin:20px 0px;
		}

		.naming{
			width:50%;
			display:block;
			float:left;
		}

		.naming em{
			padding-left:10px;
			font-size:12px;
		}

		.amounts{
			width: 45%;
			display:block;
			float:left;
		}

		.sum{
			background-color: rgb(150,180,210) !important;
			border-top: rgb(100,150,130) 2px dashed;
			border-bottom: rgb(100,150,130) 2px dashed;
		}

		.line:nth-child(even){
			background-color:rgb(220,220,220);
		}
		.line:nth-child(odd){
			background-color:rgb(250,250,250);
		}

		.line{
			display:block;
			width:98%;
			padding: 5px 1%;
			float:left;
		}

		.clear{
			clear:both;
		}
		
		@media screen and (max-width:1280px){
			header{
				height:200px;
			}
			header h1{
				text-align:center;
				color: white;
				padding-top:10px;
				text-shadow: 0px 0px 15px black;
			}
			.container{
			width: 100%;
			}
			.container h2{
				padding-left:5px;
			}
			.amounts{
				text-align:right;
			}
			
			em{
				display:inline-block;
			}
		}
		
		.line-header{
			font-weight: bold;
		}
		
		.column_1, .column_2, .column_3, .column_4{
			width: 24.5%;
			display: inline-block;
		}
		
		.nextAgether{
			list-style-type: none;
			margin-bottom: 140px;
		}
		
		.nextAgether li{
			width: 50%;
			float: left;
		}
		
		.font_small{
			font-size: 12px;
		}
		.font_strong{
			font-weight: bold;
		}
	</style>	
	</head>
	<body>
	<header>
		<h1> 
			Gamescom 2017 kostenplaatje
		</h1>
	</header>
	<nav>
		
	</nav>
	<main class="container">
	<h2>Algemeen</h2>
	<p>
		Wauw, wat gaat de tijd hard. Voor we van start gaan, enorm supertof dat je uberhaupt mee gaat! :D Neem alles hieronder even goed door! De hieronder genoemde punten en kosten hebben we de afgelopen jaren zelf ervaren, maar kunnen we wellicht nog verbeteren. Mocht je nog iets vinden waar je over twijfelt, of onduidelijk voor je is, vraag het gerust.
	</p>
	<br />
	<p>
		<b>Een korte notitie </b>Sinds de laatste keer zijn we wel van een paar dingen terug gekomen. Met name qua planning en tijd is het voor ons (Mark en Jeffrey) het niet altijd even makkelijk om iedereen zijn of haar wens te voldoen. Ook is het met een grote groep minder moeilijk als we elkaar kennen. <br />
		<br />
		<b>We nemen dan ook als besluit dat </b>we met niet meer dan 10 man / vrouw (of anders achtigen) gaan. Oud AO studenten dan ook voorop in de lijst. Bij wat hierboven staat geldt ook dat we allemaal eigen interesses hebben. Probeer om elkaar te denken, en houd er rekening mee dat we niet alles met 10 man kunnen / willen / moeten / gaan doen. We proberen het gewoon gezellig te maken (en te houden!!), maar wel ervoor te zorgen dat we ons fatsoen behouden.		
	</p>
	<br />
	<p style="padding: 10px 20px; border-radius: 3px; border:2px solid #9B3232; text-shadow:0px 0px 5px black; color:white; margin:10px 0px;background-color:#B33A3A; margin-left: 0px;">
		Zorg zelf voor: </br />
		&bull; Lunch en diner geld. (Tip: Lidl of Aldi lunch regelen van 3 euro, avondeten van hooguit 10tje per dag.)</br />
		&bull; Een geldig paspoort / ID kaart. Hier wordt , zoals elk jaar, op gecontroleerd voor o.a. je bandje.</br />
		&bull; Je tickets. Elke dag, zelf meenemen.</br />
		<br />
		&bull; Geld voor iets extra's op de beurs (of in de steden) te kopen.</br />
	</p>
		
	<p>
		<b>Feitjes van voorgaande jaren:</b><br />
		&bull; Het hotel was voor minimaal 45 en maximaal 50 euro per persoon per nacht te vinden. <br />
		&bull; Hotel köln-bonn in Bonn was wat warm (door de warme dagen), het Hotel F&uuml;ck in Leverkusen was wat moeilijker aan te rijden en kussens konden beter.<br />
		&bull; De wildcards zijn steeds meer een unicum. Vele e-mailadressen worden ook ge-reset voor de mail hiervoor.<br />
		&bull; 170 + xxx aan benzine<br />
		&bull; 16 euro voor avondje uit eten (hotel restaurant Köln Bonn)<br />
		&bull; 15 cent voor een Kaiserbr&eoml;tchen<br />
		&bull; 21 euro voor avondje chinees (chinees in Köln Bonn)<br />
		&bull; <br />
		&bull; <br />
		&bull; <br />
		&bull; <br />
		&bull; <br />
		&bull; <br />
		&bull; <br />
		&bull; <br />
		&bull; <br />
		
	</p>
