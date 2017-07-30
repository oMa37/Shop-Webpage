<?php
	session_start();

	if(!isset($_SESSION["sessionUsername"])) {

		header("Location: login.php");
	}
	else if(isset($_SESSION["sessionUsername"])) {

		header("Location: vehicles.php");
	}
?>