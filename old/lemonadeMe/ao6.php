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
			Gamescom 2015 kostenplaatje
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
			Gamescom 2015 kostenplaatje
		</h1>
	</header>
	<nav>
		
	</nav>
	<main class="container">
	<h2>Algemeen</h2>
	<p>
		Als eerste, supertof dat je uberhaupt mee gaat! :D Neem alles hieronder even goed door! De kosten die we soms opsommen hebben we vorig jaar zelf ervaren, maar kunnen we wellicht nog verbeteren. Mocht je nog iets vinden waar je over twijfelt, of onduidelijk voor je is, vraag het gerust.
	</p>
	<br />
	<p>
		<b>Maar serieus: </b>Sinds dit jaar zijn we van 8 naar 14 man gegaan, waarvan we allemaal eigen interesses hebben. Probeer om elkaar te denken, en houd er rekening mee dat we niet alles met 14 man kunnen / willen / moeten / gaan doen. We proberen het gewoon gezellig te maken (en te houden!!), maar wel ervoor te zorgen dat we ons fatsoen behouden.
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
		
	<h2>Overzicht</h2>
	<p>
		Even alle feiten op een rijtje. 
	</p>
	<div class="line line-header">
		<span class="column_1"> Dag</span>
		<span class="column_2"> Activiteit</span>
		<span class="column_3"> Wie</span>
		<span class="column_4"> Opmerkingen</span>
	</div>	
	<div class="line">
		<span class="column_1"> Dinsdag<br /><em>4 Augustus 2015</em></span>
		<span class="column_2"> 09:30 Verzamelen</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2"> 10:00 Vertrek</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2"> 12:30 Aankomst D&uuml;sseldorf</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2"> 15:30 Vertrek uit D&uuml;sseldorf</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2"> 16:30 Aankomst hotel Koln-Bonn</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2"> 18:00 Eten..?</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> Geef aan waar je dit wilt :)</span>
	</div>	
	<div class="line">
		<span class="column_1"> Woensdag<br /><em>5 Augustus 2015</em></span>
		<span class="column_2"> 12:15 Vertrek naar Gamescom</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, <s>Justin</s>, Kevin H, Kevin T, <s>Mariska</s>, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2 font_strong"> 13:00 Gamescom press day</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, <s>Justin</s>, Kevin H, Kevin T, <s>Mariska</s>, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2"> 19:00 Eten..?</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> Geef aan waar je dit wilt :)</span>
	</div>
	<div class="line">
		<span class="column_1"> Donderdag<br /><em>6 Augustus 2015</em></span>
		<span class="column_2"> 09:30 Vertrekken naar Gamescom</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2 font_strong"> 10:00 Gamescom first public day</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> Vrijdag<br /><em>7 Augustus 2015</em></span>
		<span class="column_2"> 09:30 Vertrekken naar Gamescom</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2 font_strong"> 10:00 Gamescom second public day</span>
		<span class="column_3 font_small"> Jeffrey</span>
		<span class="column_4"> </span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2"> 10:00 Keulen city in</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar</span>
		<span class="column_4"> </span>
	</div>
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2"> 16:00 / 18:00 Afsluiten met allen eten</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</span>
		<span class="column_4"> Ons lijkt het leuk om dat, net als vorig jaar, met z'n allen te doen bij bijv. een chinees (wok) restaurant.</span>
	</div>
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2"> --:00 Uitzwaaien Kevin H en Mariska</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, <s>Kevin H</s>, Kevin T, <s>Mariska</s>, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey </span>
		<span class="column_4"> Later te bepalen hoe laat. (leukste is na met zn allen af te sluiten)</span>
	</div>	
	<div class="line">
		<span class="column_1"> </span>
		<span class="column_2"> --:00 Terugreis </span>
		<span class="column_3 font_small">Kevin H, Mariska</span>
		<span class="column_4"> Kevin H en Mariska geven aan wanneer ze ong. weggaan.</span>
	</div>	
	<div class="line">
		<span class="column_1"> Zaterdag<br /><em>8 Augustus 2015</em></span>
		<span class="column_2"> 10:00 Terugreis</span>
		<span class="column_3 font_small"> Bjorn, Bobbie, Heleen, John, Justin, Kevin T,  Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey </span>
		<span class="column_4"> </span>
	</div>	
	<p>
		 <!-- Met deze regels kunnen we allemaal gewoon genieten en kijk ik alleen chagerijnig als we geld te kort komen ;)<br />  -->
		 <em style="font-size:12px;">(P.S. Mocht je het niet eens zijn met de bovenstaande activiteiten, neem even contact met mij op.)</em>
	</p>
	<h2>Personen betaald</h2>
	<ul class="nextAgether">
		<li>&#9745; Bjorn</li>
		<li>&#9744; Bobbie </li>
		<li>&#9745; Heleen</li>
		<li>&#9745; John</li>
		<li>&#9744; Justin</li>
		<li>&#9745; Kevin T</li>
		<li>&#9744; Mark</li>
		<li>&#9745; Rob</li>
		<li>&#9745; Sabrina</li>
		<li>&#9744; Virgil</li>
		<li>&#9744; Yvar</li>
		<li>&#9745; Jeffrey</li>
		<li> </li>
		<li>&#9744; Kevin H</li>
		<li>&#9744; Mariska</li>
	</ul>
	<!-- <ul style="padding-left:20px;margin-top:20px;margin-bottom:20px;">
		<li style="padding: 10px; border-radius: 3px; border:2px solid #9B3232; text-shadow:0px 0px 5px black; color:white; margin:10px 0px;background-color:#B33A3A; margin-left: -20px;">&bull; Verzilver en betaal de WILDCARDS die je hebt kunnen krijgen in je mail! </li>
		<li>De tickets voor donderdag (en evt. vrijdag) regelen we zodra ze online komen, net als vorig jaar.<br /><em style="font-size:12px;">(dit kan binnen een maand vanaf nu (10-02-2015) zijn)</em></li>
		<li>Het hotel komt ook rond die tijd om te regelen.</li>
		<li>De kosten van het hotel worden voordat we naar gamescom gaan geregeld.</li>
		<li>De regels hierboven kennen geen uitzonderingen. No exceptions.</li>
	</ul> -->
	<h2>Alle aantallen algemeen</h2>
	<div class="line">
		<span class="naming"> Aantal mensen dat nu meegaat: <br />
			<em>Definitief: Bjorn, Bobbie, Heleen, John, Justin, Kevin H, Kevin T, Mariska, Mark, Rob, Sabrina, Virgil, Yvar, Jeffrey</em> 
		 </span>
		 <span class="amounts">
		 	<!-- Select Aantal Mensen -->
			<select id="aantalMensen" onchange="rekeningUpdate();">
				<option value="11">11 mensen</option>
				<option value="12" selected="selected">12 mensen</option>
				<option value="13">13 mensen</option>
			</select>
		 </span>
	</div>	
	<div class="line">
		<span class="naming"> Aantal autos (per 4 personen): <br />
		<em>Chauffeurs: Mark, Sabrina en Jeffrey</em> 
		</span>
		<span class="amounts">
			<!-- Select Jaar -->
			<select id="aantalAutos" onchange="rekeningUpdate();">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3" selected="selected">3</option>
			</select>
		</span>
	</div>	
	<div class="line">
		<span class="naming"> Aantal dagen op gamescom zijn: <br />
		<em>Zonder Wildcard, do-vrij</em>
		 </span>
		 <span class="amounts"><?php echo $aantalGCdagen; ?> </span>
	</div>	
	<div class="line">
		<span class="naming"> Aantal dagen op gamescom met Wildcard: <br />
		<em>Wildcard in email</em>
		 </span>
		 <span class="amounts">&euro;25.00</span>
	</div>	
	<div class="line">
		<span class="naming"> Kosten in euro's voor entree: <br />
		<em>(uitgegaan van vroegboekkorting</em> </span>
		<span class="amounts">&euro;<?php echo $kostenGCEntree; ?></span>
	</div>	
	<!-- <div class="line">
		<span class="naming"> Kosten voor lunch per dag: <br />
		<em>(schatting)</em>  </span>
		<span class="amounts">&euro;<?php echo $kostenLunch; ?></span>
	</div>	
	<div class="line">
		<span class="naming"> Kosten voor diner per avond: <br />
		<em>(schatting)</em> </span>
		<span class="amounts">&euro;<?php echo $kostenDiner; ?></span>
	</div> -->
	<div class="clear">

	<div id="rekeningOpmaak">
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
			<em>Hotel K&ouml;ln Bonn : 40 / Hotel ... : 40</em></span>
			<span class="amounts">&euro;<?php echo $hotelPerNacht; ?></span>
		</div>
		<div class="line">
			<span class="naming"> Aantal dagen verblijf in hotel:<br />
			<em>met Wildcard, woe-do-vrij en za naar huis</em></span>		
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
	</div>
	</main>
	<script type="text/javascript">
    $(document).ready(function() {
    	setTimeout (function() { 
        	rekeningUpdate();
    	}, 1000);
    });

    // Rekening Update
	var rekeningUpdate = function() {        
		// Set the Variables for the POST
		var aantalMensen = $('#aantalMensen').val();
		var aantalAutos = $('#aantalAutos').val();

		// Post to get the new data
		$.post( "/Action/", {aantalMensen: aantalMensen, aantalAutos: aantalAutos,  action: "calculateRekening" }, function( data ) {

			// alert the data
			//alert(data);
			
			// Replace the bill with the new generated bill
			$('#rekeningOpmaak').replaceWith('<div id="rekeningOpmaak"> ' + data + ' </div>');

		});
	}
    </script>
	</body>
</html>