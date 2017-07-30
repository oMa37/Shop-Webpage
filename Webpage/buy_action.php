<?php
	session_start();

	set_time_limit(0);
    ob_implicit_flush();
 
    $address = '127.0.0.1';
    $port = 7778;

    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if(!@socket_connect($socket, $address, $port)) {

    	echo '0';
    }

    $checkConnection = "1|".$_SESSION["sessionUsername"]."";
    socket_write($socket, $checkConnection, strlen($checkConnection));

    $buffer = socket_read($socket, 128);

    if(strcmp($buffer, "Online") != 0) {

    	echo '1';
    }
    else {

    	$checkMoney = "2|".$_SESSION["sessionUsername"]."";
    	socket_write($socket, $checkMoney, strlen($checkMoney));

    	$buffer = socket_read($socket, 128);

    	if($_SESSION["currentPage"] == 'pageVehicles') {

	    	if(strval($buffer) < $_POST["vehiclePrice"]) {

	    		echo '2';
	    	}
	    	else {

	    		$buyVehicle = "3|".$_SESSION["sessionUsername"]."|".$_POST["vehicleModel"]."|".$_POST["vehiclePrice"]."";
		    	socket_write($socket, $buyVehicle, strlen($buyVehicle));

		    	$buffer = socket_read($socket, 128);

		    	if(strcmp($buffer, "BoughtVehicle") == 0) {

		    		echo '3';
		    	}
		    	else echo '0';
	    	}
	    }
	    else if($_SESSION["currentPage"] == 'pageSkins') {

	    	if(strval($buffer) < $_POST["skinPrice"]) {

	    		echo '2';
	    	}
	    	else {

	    		$buySkin = "4|".$_SESSION["sessionUsername"]."|".$_POST["skinID"]."|".$_POST["skinPrice"]."";
		    	socket_write($socket, $buySkin, strlen($buySkin));

		    	$buffer = socket_read($socket, 128);

		    	if(strcmp($buffer, "BoughtSkin") == 0) {

		    		echo '3';
		    	}
		    	else echo '0';
	    	}
	    }
    }
    socket_close($socket);
?>