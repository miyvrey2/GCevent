<?php
if(!empty($_POST["action"])){
	if($_POST['action'] == "calculateRekening"){
		// Create a return variable
		$return = '';

		// Losse kosten en waardes
		$aantalMensen 	= $_POST['aantalMensen'];
		$aantalAutos 	= $_POST['aantalAutos'];
		$aantalGCdagen 	= 3;
		$kostenGCEntree	= number_format(11.50, 2);
		$kostenLunch 	= number_format(15, 2);
		$kostenDiner	= number_format(20, 2);
		$kostenSticker	= number_format(15, 2);
		$kostenBenzin 	= number_format(97, 2);

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
		$kostenTotaalPP	= $kostenHotelPP + ($aantalGCdagen * $kostenGCEntree) /*+ $kostenLunch + $kostenDiner*/ + ($kostenPark / $aantalMensen) + 25;
		$kostenTotaalPP = number_format($kostenTotaalPP, 2);
		$kostenTotaalRe = $kostenTotaalPP * $aantalMensen;
		$kostenTotaalRe = number_Format($kostenTotaalRe, 2);

		// $return waardes vullen met html
		// $return vullen met Autokosten
		$return .= '
		<!--AUTO -->
		<h2>Alle kosten m.b.t. auto en reis</h2>
		<div class="line">
			<span class="naming"> Kosten voor 1 auto heen en terug:<br />
			<em>Aardig accurate schatting met benzine</em></span>	
			<span class="amounts">&euro;'. $kostenBenzin .'</span>	
		</div>
		<div class="line">
			<span class="naming"> Kosten voor miljeusticker: <br />
			<em>Per auto aan te schaffen</em></span>	
			<span class="amounts">&euro;'. $kostenSticker .'</span>
		</div>
		<div class="line">
			<span class="naming"> Kosten voor parkeren per dag:<br />
			<em>Garage bij bioscoop</em></span>
			<span class="amounts">&euro;'. $kostenGarage .'</span>
		</div>
		<div class="line sum">
			<span class="naming"> Totaalkosten auto p/p:<br />
			<em>((parkeerkosten x aantal GC dagen x aantal autos) + (benzine x aantal autos) + (sticker x aantal autos)) / aantal mensen</em></span>
			<span class="amounts">&euro;'. $kostenParkPP .'</span>
		<div class="clear"></div>
			<span class="naming"> Totaalkosten auto:<br />
			<em>(parkeerkosten x aantal GC dagen x aantal autos) + (benzine x aantal autos) + (sticker x aantal autos)</em></span>
			<span class="amounts">&euro;'. $kostenPark .'</span>
		</div>
		<div class="clear">';

		// $return vullen met Hotel
		$return .= '
		<!--HOTEL -->
		<h2>Alle kosten m.b.t. het hotel</h2>
		<div class="line">
			<span class="naming"> Kosten voor overnachting p/p: <br />
			<em>Hotel K&ouml;ln Bonn : 40 </em></span>
			<span class="amounts">&euro;'. $hotelPerNacht .'</span>
		</div>
		<div class="line">
			<span class="naming"> Aantal dagen verblijf in hotel:<br />
			<em>Met Wildcard, woe-do-vrij en za naar huis</em></span>		
			<span class="amounts">'. $hotelDagen .'</span>
		</div>
		<div class="line sum">
			<span class="naming"> Totaalkosten hotel p/p:<br />
			<em>Hotelkosten per nacht x Aantal hoteldagen</em></span>			
			<span class="amounts">&euro;'. $kostenHotelPP .'</span>
		<div class="clear"></div><br />
			<span class="naming"> Totaalkosten hotel totaal:<br />
			<em>Hotelkosten per nacht x aantal hoteldagen x aantal mensen</em></span>		
			<span class="amounts">&euro;'. $kostenHotelTot .'</span>
		</div>
		<div class="clear">'; 
		$peerk = $kostenTotaalPP - ($aantalGCdagen * $kostenGCEntree) - 25;
		// $return vullen met totalen
		$return .= '
		<!--TOTAAL -->
		<h2>Totaalkosten</h2>
		<div class="line sum">
			<span class="naming"> Totaalkosten per persoon: <br />
			<em>Hotelkosten per nacht x aantal hoteldagen + wildcard <!--+ lunch + diner--></em></span>
			<span class="amounts">&euro;'. $kostenTotaalPP .'</span>
		<div class="clear"> <br />
		<div class="line sum">
			<span class="naming"> Totaalkosten per persoon min kaarten: <br />
			<em>Hotelkosten per nacht x aantal hoteldagen  <!--+ lunch + diner--></em></span>
			<span class="amounts">&euro;'. $peerk  .'</span>
		<div class="clear"> <br />
			<span class="naming"> Totaalkosten van de groep: <br />
			<em>Hotelkosten per nacht x aantal hoteldagen x aantal mensen <!--+ lunch + diner--></em></span>
			<span class="amounts">&euro;'. $kostenTotaalRe .'</span>
		</div>';
		echo $return;
	}
}
?>