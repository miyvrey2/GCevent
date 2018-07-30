<?php 
// Losse kosten en waardes
$aantalMensen 	= 8;
$aantalAutos 	= 2;
$aantalGCdagen 	= 2;
$kostenGCEntree	= number_format(11.50, 2);
$kostenLunch 	= number_format(15, 2);
$kostenDiner	= number_format(20, 2);
$kostenSticker	= number_format(15, 2);
$kostenBenzin 	= number_format(70, 2);

$kostenGarage	= number_format(12.95, 2);
$kostenPark   	= ($kostenGarage * $aantalGCdagen * $aantalAutos) + ($kostenBenzin * $aantalAutos) + ($kostenSticker * $aantalAutos);
$kostenPark		= number_format($kostenPark, 2);
$kostenParkPP  	= number_format($kostenPark / 7, 2);
// Hotel Kosten berekenen
$hotelPerNacht 	= number_format(45, 2);
$hotelDagen 	= intval(3);
$kostenHotelPP 	= $hotelPerNacht * $hotelDagen;
$kostenHotelPP 	= number_format($kostenHotelPP, 2);
$kostenHotelTot	= $hotelPerNacht * $hotelDagen * $aantalMensen;
$kostenHotelTot = number_format($kostenHotelTot, 2);

// Totale Kosten (per persoon en allemaal)
$kostenTotaalPP	= $kostenHotelPP + ($aantalGCdagen * $kostenGCEntree) + $kostenLunch + $kostenDiner + ($kostenPark / $aantalMensen);
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
			Gamescom 2015 kostenplaatje
		</title>
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/x-icon" href="http://www.gamescomevent.com/icon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="description" content="Gamescom is a convention that is being held at Cologne(K&ouml;hn). Last year there was around a 340,000 visitors to come and watch all the works that are being showed here by popular game-developers. " />
	    <meta name="keywords" content="gamescom, games, koln, convention, germany, august " />
	    <meta name="robots" content="index, follow" />
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
	</style>	
	</head>
	<body>
	<header>
		<h1>
			Gamescom 2015 kostenplaatje
		</h1>
	</header>
	<nav>
		
	</nav>
	<main class="container">
	<h2>Alle aantallen algemeen</h2>
	<div class="line">
		<span class="naming"> Aantal mensen dat nu meegaat: <br />
			<em>Definitief: Mark, Heleen, John, Bjorn, Kevin H, Sabrina, Jeffrey</em>
		 </span>
		 <span class="amounts"><?php echo $aantalMensen; ?></span>
	</div>	
	<div class="line">
		<span class="naming"> Aantal autos (per 4 personen): <br />
		<em>Chauffeurs: Mark en Jeffrey</em>
		</span>
		<span class="amounts"><?php echo $aantalAutos; ?></span>
	</div>	
	<div class="line">
		<span class="naming"> Aantal dagen op gamescom zijn: <br />
		<em>Zonder Wildcard, do-vrij</em>
		 </span>
		 <span class="amounts"><?php echo $aantalGCdagen; ?> </span>
	</div>	
	<div class="line">
		<span class="naming"> Kosten in euro's voor entree: <br />
		<em>(uitgegaan van vroegboekkorting</em> </span>
		<span class="amounts">&euro;<?php echo $kostenGCEntree; ?></span>
	</div>	
	<div class="line">
		<span class="naming"> Kosten voor lunch per dag: <br />
		<em>(schatting)</em>  </span>
		<span class="amounts">&euro;<?php echo $kostenLunch; ?></span>
	</div>	
	<div class="line">
		<span class="naming"> Kosten voor diner per avond: <br />
		<em>(schatting)</em> </span>
		<span class="amounts">&euro;<?php echo $kostenDiner; ?></span>
	</div>
	<div class="clear">

	<!--AUTO -->
	<h2>Alle kosten m.b.t. auto en reis</h2>
	<div class="line">
		<span class="naming"> Kosten voor 1 auto heen en terug:<br />
		<em>Aardig accurate schatting met benzine</em></span>	
		<span class="amounts">&euro;<?php echo $kostenBenzin; ?></span>	
	</div>
	<div class="line">
		<span class="naming"> Kosten voor miljeusticker: <br />
		<em>Per auto aan te schaffen</em></span>	
		<span class="amounts">&euro;<?php echo $kostenSticker; ?></span>
	</div>
	<div class="line">
		<span class="naming"> Kosten voor parkeren per dag:<br />
		<em>Garage bij bioscoop</em></span>
		<span class="amounts">&euro;<?php echo $kostenGarage; ?></span>
	</div>
	<div class="line sum">
		<span class="naming"> Totaalkosten auto p/p:<br />
		<em>((parkeerkosten x aantal GC dagen x aantal autos) + (benzine x aantal autos) + (sticker x aantal autos)) / aantal mensen</em></span>
		<span class="amounts">&euro;<?php echo $kostenParkPP; ?></span>
	<div class="clear"></div>
		<span class="naming"> Totaalkosten auto:<br />
		<em>(parkeerkosten x aantal GC dagen x aantal autos) + (benzine x aantal autos) + (sticker x aantal autos)</em></span>
		<span class="amounts">&euro;<?php echo $kostenPark; ?></span>
	</div>
	<div class="clear">
	
	<!--HOTEL -->
	<h2>Alle kosten m.b.t. het hotel</h2>
	<div class="line">
		<span class="naming"> Kosten voor overnachting p/p: <br />
		<em>Hotel F&uuml;ck : 45 / Hotel J&auml;gerHoff : 40 / Hotel ... : 40</em></span>
		<span class="amounts">&euro;<?php echo $hotelPerNacht; ?></span>
	</div>
	<div class="line">
		<span class="naming"> Aantal dagen verblijf in hotel:<br />
		<em>Zonder Wildcard, woe-do-vrij en za naar huis</em></span>		
		<span class="amounts"><?php echo $hotelDagen; ?></span>
	</div>
	<div class="line sum">
		<span class="naming"> Totaalkosten hotel p/p:<br />
		<em>Hotelkosten per nacht x Aantal hoteldagen</em></span>			
		<span class="amounts">&euro;<?php echo $kostenHotelPP; ?></span>
	<div class="clear"></div><br />
		<span class="naming"> Totaalkosten hotel totaal:<br />
		<em>Hotelkosten per nacht x aantal hoteldagen x aantal mensen</em></span>		
		<span class="amounts">&euro;<?php echo $kostenHotelTot; ?></span>
	</div>
	<div class="clear">
	
	<!--TOTAAL -->
	<h2>Totaalkosten</h2>
	<div class="line sum">
		<span class="naming"> Totaalkosten per persoon: <br />
		<em>Hotelkosten per nacht x aantal hoteldagen x aantal mensen</em></span>
		<span class="amounts">&euro;<?php echo $kostenTotaalPP; ?></span>
	<div class="clear"> <br />
		<span class="naming"> Totaalkosten van de groep: <br />
		<em>Hotelkosten per nacht x aantal hoteldagen x aantal mensen</em></span>
		<span class="amounts">&euro;<?php echo $kostenTotaalRe; ?></span>
	</div>
	</main>
	</body>
</html>