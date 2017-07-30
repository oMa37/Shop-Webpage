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
	$_SESSION["currentPage"] = "pageSkins";

	$skins = array(0 =>
		array(0, 7593), array(1, 6197), array(2, 2041), array(3, 2666), array(4, 1644), array(5, 8454), array(6, 2119), array(7, 2112), array(8, 7050),
		array(9, 4029), array(10, 2797), array(11, 8879), array(12, 8914), array(13, 5213), array(14, 7955), array(15, 8539), array(16, 8585), array(17, 8375), array(18, 6500),
		array(19, 2716), array(20, 8230), array(21, 7359), array(22, 9254), array(23, 8344), array(24, 6741), array(25, 5271), array(26, 2761), array(27, 4527), array(28, 7814),
		array(29, 1700), array(30, 4833), array(31, 4695), array(32, 8143), array(33, 7757), array(34, 5602), array(35, 1999), array(36, 2769), array(37, 6675), array(38, 4654),
		array(39, 1887), array(40, 5106), array(41, 9839), array(42, 3518), array(43, 3448), array(44, 2374), array(45, 8068), array(46, 7002), array(47, 4983), array(48, 3971),
		array(49, 9271), array(50, 6895), array(51, 2892), array(52, 8880), array(53, 2215), array(54, 3349), array(55, 1405), array(56, 3520), array(57, 9139), array(58, 7338),
		array(59, 6188), array(60, 5828), array(61, 2168), array(62, 5676), array(63, 9715), array(64, 4065), array(65, 9605), array(66, 4444), array(67, 4533), array(68, 1992),
		array(69, 3248), array(70, 1327), array(71, 4515), array(72, 5622), array(73, 1056), array(74, 6709), array(75, 4827), array(76, 7141), array(77, 7359), array(78, 7459), 
		// Ignore the ID 78, It's invalid skin ID.
		array(79, 7640), array(80, 1876), array(81, 5526), array(82, 3263), array(83, 4972), array(84, 7258), array(85, 2842), array(86, 9333), array(87, 9849), array(88, 7063),
		array(89, 1326), array(90, 5861), array(91, 2987), array(92, 1890), array(93, 5787), array(94, 1655), array(95, 9964), array(96, 2724), array(97, 1020), array(98, 8299), array(99, 5635),
		array(100, 6600), array(101, 7175), array(102, 3040), array(103, 7162), array(104, 6252), array(105, 7076), array(106, 4755), array(107, 9269), array(108, 9688), array(109, 2343),
		array(110, 5138), array(111, 4783), array(112, 4645), array(113, 2101), array(114, 3979), array(115, 6201), array(116, 6504), array(117, 4272), array(118, 9049), array(119, 1018),
		array(120, 3813), array(121, 5506), array(122, 8466), array(123, 1734), array(124, 8949), array(125, 3714), array(126, 6554), array(127, 3571), array(128, 3380), array(129, 5576),
		array(130, 2142), array(131, 1321), array(132, 2139), array(133, 7977), array(134, 5133), array(135, 8145), array(136, 6013), array(137, 3587), array(138, 8463), array(139, 4133),
		array(140, 9357), array(141, 9428), array(142, 3578), array(143, 3201), array(144, 2251), array(145, 4481), array(146, 3946), array(147, 9416), array(148, 4639), array(149, 5446),
		array(150, 5175), array(151, 4674), array(152, 6133), array(153, 5161), array(154, 5769), array(155, 3363), array(156, 6648), array(157, 1018), array(158, 6946), array(159, 9412),
		array(160, 7248), array(161, 3085), array(162, 2632), array(163, 6514), array(164, 7896), array(165, 4817), array(166, 5935), array(167, 2136), array(168, 4892), array(169, 4662),
		array(170, 6070), array(171, 1190), array(172, 2160), array(173, 7497), array(174, 1954), array(175, 6604), array(176, 5224), array(177, 7409), array(178, 5089), array(179, 3366),
		array(180, 6143), array(181, 2442), array(182, 8597), array(183, 6753), array(184, 7285), array(185, 4277), array(186, 4657), array(187, 8638), array(188, 5491), array(189, 6879),
		array(190, 5901), array(191, 8457), array(192, 9719), array(193, 5698), array(194, 6921), array(195, 7610), array(196, 1346), array(197, 3182), array(198, 8421), array(199, 1186),
		array(200, 8959), array(201, 2232), array(202, 2595), array(203, 8678), array(204, 7020), array(205, 1034), array(206, 1828), array(207, 7125), array(208, 1516), array(209, 7705),
		array(210, 7577), array(211, 7621), array(212, 1739), array(213, 5372), array(214, 9871), array(215, 1740), array(216, 9305), array(217, 4213), array(218, 1972), array(219, 7753),
		array(220, 5744), array(221, 7546), array(222, 3826), array(223, 8101), array(224, 1895), array(225, 5363), array(226, 2607), array(227, 5061), array(228, 3762), array(229, 8582),
		array(230, 2515), array(231, 7248), array(232, 8343), array(233, 4979), array(234, 4166), array(235, 4603), array(236, 1383), array(237, 6589), array(238, 8925), array(239, 8846),
		array(240, 8428), array(241, 4557), array(242, 4235), array(243, 9919), array(244, 2747), array(245, 9447), array(246, 7537), array(247, 5414), array(248, 3191), array(249, 7990),
		array(250, 2028), array(251, 6767), array(252, 9764), array(253, 4551), array(254, 4110), array(255, 2575), array(256, 9993), array(257, 4231), array(258, 4081), array(259, 5679),
		array(260, 7578), array(261, 8894), array(262, 4322), array(263, 5936), array(264, 6040), array(265, 2673), array(266, 8080), array(267, 2543), array(268, 7759), array(269, 9846),
		array(270, 5310), array(271, 8797), array(272, 8694), array(273, 5822), array(274, 9008), array(275, 6326), array(276, 8886), array(277, 6603), array(278, 3382), array(279, 5667),
		array(280, 4905), array(281, 5409), array(282, 8720), array(283, 3722), array(284, 5012), array(285, 2643), array(286, 2835), array(287, 7062), array(288, 8016), array(289, 1493),
		array(290, 8331), array(291, 9733), array(292, 9879), array(293, 6727), array(294, 9599), array(295, 5706), array(296, 6881), array(297, 5115), array(298, 9625), array(299, 4991)
	);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop - Skins</title>
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
  <h3>Skins</h3><br>
  <div class="row">
    <?php

    for ($i = 0; $i < 300; $i++) { 
    	
    	if($i == 78) continue;
    	
    	echo "
	    	<div class='col-xs-18 col-sm-6 col-md-3'>
	    		<div class='thumbnail'>
	    			<div class='caption'>
	    				<h4>Skin ID: ".$i."</h4>
	    			</div>
	         		<img src='img/Skins/".$i.".png'>
	            	<div class='caption'>
	            		<p>$".number_format($skins[$i][1])."</p>
	                	<p><button type='button' class='btn btn-info' onClick='BuySkin(".$skins[$i][1].", ".$skins[$i][0].")'>Buy</button></p>
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
function BuySkin(price, id) {

	$.ajax({
		type: 'POST',
		url: 'buy_action.php',
		data: 'skinID=' + id + '&skinPrice=' + price,
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
      text: "You don't have enough money to buy this skin!",
      type: "error",
      closeOnConfirm: false,
      confirmButtonText: "Close",
      confirmButtonColor: "#ec6c62"
    });
}

function playerBought() {
    swal({
      text: "You have successfully bought this skin!",
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