<?php
	require_once('../components/squice.php');
	require_once('../components/header.php'); 
	
	$meta_object = array(
	'url' => 'https://www.gamescomevent.com/program/',
	'title' => 'Gamescom 2017 Programs and schedules || Gamescomevent',
	'description' => 'There is a lot to cover at Gamescom. This Program can come in handy, just be sure you don\'t mis aout a thing.',
	'keywords' => 'gamescom, games, koln, convention, germany, august, event, 2017, line-up, hall 9, playable games, release, schedule, program, time, presentation',

	);
	
	echo set_header($meta_object);
?>
	<style>
		#page_slider .page_image:before{
			content:' ';
			width:100%;
			background-color:rgba(230,180,100,0.7);
			height:300px;
			position:absolute;
			display:block;
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
		            <a href="https://www.gamescomevent.com/program/" title="Program">Program</a>
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
				      "@id": "https://www.gamescomevent.com/program/",
				      "name": "Program",
				      "image": "https://www.gamescomevent.com/images/icon-game.png"
				    }
				  }
				</script>
				
				<h1>Program</h1>
				<div class="content-text">
					<br />
					
					<?php 
					
					$halls = array(
						0  => "*",
						1  => "Hall 1",
						2  => "Hall 2",
						3  => "Hall 3",
						4  => "Hall 4",
						5  => "Hall 5",
						6  => "Hall 6",
						7  => "Hall 7",
						8  => "Hall 8",
						9  => "Hall 9",
						10 => "Hall 10",
						11 => "Hall 11",
						12 => "Hall 12",
					);
					
					$thursday = array(
						0 => array(
							"startTime" => "09:00",
							"endTime" => "09:05",
							"hall" => "*",
							"title" => "Opening",
							"desc" => "The opening is the start of the day",
						),
						0 => array(
							"startTime" => "09:00",
							"endTime" => "17:00",
							"hall" => "4",
							"title" => "Merchandise",
							"desc" => "The opening is the start of the day",
						),
						
					);
					?>
					<style>
						table{
							width: 100%; 
							display: block;
							overflow-x: scroll;
							border: 1px solid gray;
						}
						
						table td{
							padding: 5px;
							text-align: center;
						}
						
						.td_even{
							background-color: rgba(230,180,100,0.3);
						}
						
						::-webkit-scrollbar-thumb {
						    background: 					rgba(230,180,100,0.7);
						}
						::-webkit-scrollbar-thumb:window-inactive {
							background: 					rgba(230,180,100,0.3); 
						}

					</style>
					
					<table>
						<tr>
							<td>Day</td>
							<td colspan="11" class="td_uneven">Wednesday</td>
							<td colspan="11" class="td_even">Thursday</td>
							<td colspan="12" class="td_uneven">Friday</td>
							<td colspan="12" class="td_even">Saturday</td>
						</tr>
						<tr>
							<td></td>
							<td class="td_even">10:00</td>
							<td class="td_even">11:00</td>
							<td class="td_even">12:00</td>
							<td class="td_even">13:00</td>
							<td class="td_even">14:00</td>
							<td class="td_even">15:00</td>
							<td class="td_even">16:00</td>
							<td class="td_even">17:00</td>
							<td class="td_even">18:00</td>
							<td class="td_even">19:00</td>
							<td class="td_even">20:00</td>
							<td class="td_uneven">10:00</td>
							<td class="td_uneven">11:00</td>
							<td class="td_uneven">12:00</td>
							<td class="td_uneven">13:00</td>
							<td class="td_uneven">14:00</td>
							<td class="td_uneven">15:00</td>
							<td class="td_uneven">16:00</td>
							<td class="td_uneven">17:00</td>
							<td class="td_uneven">18:00</td>
							<td class="td_uneven">19:00</td>
							<td class="td_uneven">20:00</td>
							<td class="td_even">09:00</td>
							<td class="td_even">10:00</td>
							<td class="td_even">11:00</td>
							<td class="td_even">12:00</td>
							<td class="td_even">13:00</td>
							<td class="td_even">14:00</td>
							<td class="td_even">15:00</td>
							<td class="td_even">16:00</td>
							<td class="td_even">17:00</td>
							<td class="td_even">18:00</td>
							<td class="td_even">19:00</td>
							<td class="td_even">20:00</td>
							<td class="td_uneven">09:00</td>
							<td class="td_uneven">10:00</td>
							<td class="td_uneven">11:00</td>
							<td class="td_uneven">12:00</td>
							<td class="td_uneven">13:00</td>
							<td class="td_uneven">14:00</td>
							<td class="td_uneven">15:00</td>
							<td class="td_uneven">16:00</td>
							<td class="td_uneven">17:00</td>
							<td class="td_uneven">18:00</td>
							<td class="td_uneven">19:00</td>
							<td class="td_uneven">20:00</td>
						</tr>
						<tr>
							<td>Hall 5.1</td>
							<td>Opening</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Hall 5.2</td>
							<td>Opening</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Hall 6</td>
							<td>Opening</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Hall 7</td>
							<td>Opening</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Hall 8</td>
							<td>Opening</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Hall 9</td>
							<td>Opening</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Hall 10.1</td>
							<td>Opening</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</table>
					Timetable here.
				</div> 
				<div class="clear"></div>
			</div>
		</section>
	</main>
<?php echo require('footer.php'); ?>