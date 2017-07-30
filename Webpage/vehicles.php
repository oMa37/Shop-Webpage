<?php
	session_start();

	if(!isset($_SESSION["sessionUsername"])) {

		header("Location: login.php");
	}

	$expireAfter = 15; // 15 Minutes

	if(isset($_SESSION['last_action'])){

	    $secondsInactive = time() - $_SESSION['last_action']; // Gets how many inactivity seconds has passed
	    $expireAfterSeconds = $expireAfter * 60; // Convert minutes to seconds
	    
	    if($secondsInactive >= $expireAfterSeconds) {

	        session_unset();
	        session_destroy();
	        header("Location: login.php");
	    }
	}
 
	$_SESSION['last_action'] = time();
	$_SESSION["currentPage"] = "pageVehicles";

	function getVehicleName($id) {

		static $vehicleNames = array(400 => 'Landstalker','Bravura','Buffalo','Linerunner','Pereniel','Sentinel','Dumper','Firetruck',
		'Trashmaster','Stretch','Manana','Infernus','Voodoo','Pony','Mule', 'Cheetah', 
	    'Ambulance','Leviathan','Moonbeam','Esperanto','Taxi','Washington','Bobcat','Mr Whoopee','BF Injection','Hunter','Premier','Enforcer','Securicar','Banshee','Predator', 
	    'Bus','Rhino','Barracks','Hotknife','Trailer','Previon','Coach','Cabbie','Stallion','Rumpo','RC Bandit','Romero','Packer','Monster','Admiral','Squalo','Seasparrow', 
	    'Pizzaboy', 'Tram', 'Trailer', 'Turismo', 'Speeder', 'Reefer', 'Tropic', 'Flatbed', 'Yankee', 'Caddy', 'Solair', 
	    'Berkleys RC Van', 'Skimmer', 'PCJ-600', 'Faggio', 'Freeway', 'RC Baron', 'RC Raider', 'Glendale', 'Oceanic', 'Sanchez', 'Sparrow', 
	    'Patriot', 'Quad', 'Coastguard', 'Dinghy', 'Hermes', 'Sabre', 'Rustler', 'ZR-350', 'Walton', 'Regina', 'Comet', 'BMX', 'Burrito', 
	    'Camper', 'Marquis', 'Baggage', 'Dozer', 'Maverick', 'News Maverick', 'Rancher', 'FBI Rancher', 'Virgo', 'Greenwood', 'Jetmax', 'Hotring-Racer A', 
	    'Sandking', 'Blista', 'Police Maverick', 'Boxville', 'Benson', 'Mesa', 'RC Goblin', 'Hotring-Racer B', 'Hotring-Racer C', 'Bloodring-Banger', 
	    'Rancher', 'Super-GT', 'Elegant', 'Journey', 'Bike', 'Mountain Bike', 'Beagle', 'Cropdust', 'Stunt', 'Tanker', 'RoadTrain', 'Nebula', 
	    'Majestic', 'Buccaneer', 'Shamal', 'Hydra', 'FCR-900', 'NRG-500', 'HPV1000', 'Cement Truck', 'Tow Truck', 'Fortune', 'Cadrona', 'FBI Truck', 
	    'Willard', 'Forklift', 'Tractor', 'Combine', 'Feltzer', 'Remington', 'Slamvan', 'Blade', 'Freight', 'Streak', 'Vortex', 'Vincent', 
	    'Bullet', 'Clover', 'Sadler', 'Firetruck', 'Hustler', 'Intruder', 'Primo', 'Cargobob', 'Tampa', 'Sunrise', 'Merit', 'Utility', 'Nevada', 
	    'Yosemite', 'Windsor', 'Monster Truck A', 'Monster Truck B', 'Uranus', 'Jester', 'Sultan', 'Stratum', 'Elegy', 'Raindance', 'RC Tiger', 'Flash', 'Tahoma', 
	    'Savanna', 'Bandito', 'Freight', 'Trailer', 'Kart', 'Mower', 'Duneride', 'Sweeper', 'Broadway', 'Tornado', 'AT-400', 'DFT-30', 'Huntley', 
	    'Stafford', 'BF-400', 'Newsvan', 'Tug', 'Trailer', 'Emperor', 'Wayfarer', 'Euros', 'Hotdog', 'Club', 'Trailer', 'Trailer', 'Andromada', 
	    'Dodo', 'RC Cam', 'Launch', 'Police Car', 'Police Car', 'Police Car', 'Police Ranger', 'Picador', 'S.W.A.T. Van', 'Alpha', 'Phoenix', 
	    'Broken Glendale', 'Broken Sadler', 'Luggage Trailer', 'Luggage Trailer', 'Stair Trailer', 'Boxville', 'Farm Plow', 'Utility Trailer');

		if(!empty($id)) {

			return $vehicleNames[$id];
		}
		return false;
	}

	$vehicles = array(400 =>
		array(400, 6520), array(401, 3102), array(402, 3419), array(403, 9601), array(404, 7183), array(405, 5250),
		array(406, 8828), array(407, 5657), array(408, 6092), array(409, 4466), array(410, 1021), array(411, 9049), array(412, 1268),
		array(413, 9711), array(414, 8770), array(415, 8040), array(416, 5130), array(417, 2769), array(418, 1018), array(419, 9355),
		array(420, 8284), array(421, 1705), array(422, 4882), array(423, 1294), array(424, 3580), array(425, 4276), array(426, 9880),
		array(427, 2723), array(428, 9703), array(429, 3011), array(430, 5698), array(431, 4642), array(432, 3910), array(433, 6603),
		array(434, 9766), array(435, 9606), array(436, 9069), array(437, 9346), array(438, 2497), array(439, 8665), array(440, 6577),
		array(441, 2715), array(442, 3063), array(443, 7610), array(444, 4075), array(445, 7709), array(446, 3595), array(447, 5429),
		array(448, 9645), array(449, 5111), array(450, 2225), array(451, 1643), array(452, 3277), array(453, 9191), array(454, 1401),
		array(455, 8306), array(456, 6013), array(457, 9108), array(458, 8209), array(459, 8298), array(460, 8587), array(461, 8360),
		array(462, 4987), array(463, 7606), array(464, 5998), array(465, 1118), array(466, 9129), array(467, 1016), array(468, 9175),
		array(469, 8229), array(470, 9645), array(471, 8378), array(472, 8635), array(473, 4472), array(474, 1092), array(475, 2762),
		array(476, 6409), array(477, 4473), array(478, 1413), array(479, 6028), array(480, 6624), array(481, 3304), array(482, 6743),
		array(483, 8750), array(484, 5877), array(485, 9957), array(486, 5630), array(487, 9802), array(488, 6702), array(489, 1368),
		array(490, 2345), array(491, 8467), array(492, 2133), array(493, 9391), array(494, 6677), array(495, 7743), array(496, 4739),
		array(497, 1832), array(498, 8838), array(499, 2728), array(500, 1016), array(501, 2002), array(502, 4735), array(503, 6066),
		array(504, 8730), array(505, 5160), array(506, 1405), array(507, 5369), array(508, 6810), array(509, 6319), array(510, 2409),
		array(511, 1750), array(512, 9925), array(513, 9261), array(514, 2838), array(515, 4730), array(516, 4045), array(517, 3098),
		array(518, 7833), array(519, 7276), array(520, 8887), array(521, 2561), array(522, 3167), array(523, 6006), array(524, 3886),
		array(525, 7699), array(526, 1263), array(527, 9456), array(528, 4026), array(529, 1314), array(530, 7281), array(531, 1804),
		array(532, 6675), array(533, 5833), array(534, 4173), array(535, 5517), array(536, 3088), array(537, 4589), array(538, 3480),
		array(539, 4761), array(540, 1813), array(541, 3085), array(542, 2385), array(543, 3687), array(544, 2972), array(545, 3084),
		array(546, 3871), array(547, 2987), array(548, 5259), array(549, 2922), array(550, 7379), array(551, 1133), array(552, 1669),
		array(553, 1434), array(554, 6309), array(555, 2597), array(556, 9370), array(557, 7893), array(558, 5483), array(559, 9516),
		array(560, 3216), array(561, 2624), array(562, 5244), array(563, 2642), array(564, 9280), array(565, 5784), array(566, 3054),
		array(567, 7592), array(568, 7018), array(569, 4513), array(570, 6921), array(571, 4570), array(572, 8302), array(573, 1907),
		array(574, 6872), array(575, 6415), array(576, 7594), array(577, 1072), array(578, 6079), array(579, 1558), array(580, 2155),
		array(581, 6062), array(582, 2399), array(583, 4856), array(584, 9489), array(585, 9552), array(586, 6403), array(587, 1291),
		array(588, 8992), array(589, 4996), array(590, 1364), array(591, 7188), array(592, 2622), array(593, 2640), array(594, 4409),
		array(595, 2350), array(596, 9746), array(597, 6339), array(598, 4419), array(599, 8915), array(600, 9295), array(601, 5014),
		array(602, 1015), array(603, 1639), array(604, 1293), array(605, 6432), array(606, 2762), array(607, 8296), array(608, 4658),
		array(609, 8176)
	);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shop - Vehicles</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/sweetalert2.min.js"></script>
  	<link rel="stylesheet" href="css/sweetalert2.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
	include 'header.php';
?>

<div class="container text-center">
  <h3>Vehicles</h3><br>
  <div class="row">
    <?php

    for ($i = 400; $i < 610; $i++) {
    	
    	echo "
	    	<div class='col-xs-18 col-sm-6 col-md-3'>
	    		<div class='thumbnail'>
	    			<div class='caption'>
	    				<h4>".getVehicleName($i)."</h4>
	    			</div>
	         		<img src='img/Vehicles/Vehicle_".$i.".jpg'>
	            	<div class='caption'>
	            		<p>$".number_format($vehicles[$i][1])."</p>
	                	<p><button type='button' class='btn btn-info' onClick='BuyVehicle(".$vehicles[$i][1].", ".$vehicles[$i][0].")'>Buy</button></p>
	            	</div>
	        	</div>
	    	</div>
	    ";
    }

    ?>
  </div>
</div>


<footer class="footer">
	<a href="#" class="crunchify-top"><h4>↑</h4></a>
  	<br><p>Copyright &copy; oMa37</p>
</footer>

<script>
function BuyVehicle(price, id) {

	$.ajax({
		type: 'POST',
		url: 'buy_action.php',
		data: 'vehicleModel=' + id + '&vehiclePrice=' + price,
		success: function(response) {

			if(response == '0') {

				failedConnection();
			}
			else if(response == '1') {

				playerDisconnected();
			}
			else if(response == '2') {

				playerMoney();
			}
			else if(response == '3') {

				playerBought();
			}
		}
	});
}
</script>

<script>            
jQuery(document).ready(function() {
	var offset = 220;
	var duration = 500;
	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > offset) {
			jQuery('.crunchify-top').fadeIn(duration);
		} else {
			jQuery('.crunchify-top').fadeOut(duration);
		}
	});

	jQuery('.crunchify-top').click(function(event) {
		event.preventDefault();
		jQuery('html, body').animate({scrollTop: 0}, duration);
		return false;
	})
});
</script>

<script>
function failedConnection() {
	swal({
      text: "Something went wrong, try again later!",
      type: "error",
      closeOnConfirm: false,
      confirmButtonText: "Close",
      confirmButtonColor: "#ec6c62"
    });
}

function playerMoney() {
    swal({
      text: "You don't have enough money to buy this vehicle!",
      type: "error",
      closeOnConfirm: false,
      confirmButtonText: "Close",
      confirmButtonColor: "#ec6c62"
    });
}

function playerBought() {
    swal({
      text: "You have successfully bought this vehicle!",
      type: "success",
      closeOnConfirm: false,
      confirmButtonText: "Close",
    });
}

function playerDisconnected() {
    swal({
      text: "You are not connected to the server!",
      type: "warning",
      closeOnConfirm: false,
      confirmButtonText: "Close",
      confirmButtonColor: "#ec6c62"
    });
}
</script>

</body>
</html>