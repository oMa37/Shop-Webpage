<?php 
	session_start();
	include("config.php");

	$conn = mysqli_connect($hostname, $username, $password, $database);

	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$query = "SELECT Username, Password FROM `Users` WHERE `Username` = '".$_POST["playerName"]."'";
	$result = mysqli_query($conn, $query);

	if(mysqli_num_rows($result) == 1) {

		echo '1';
	}
	else {

		$query = "INSERT INTO `Users` (Username, Password) VALUES ('".$_POST["playerName"]."', '".$_POST["playerPassword"]."')";

		if (mysqli_query($conn, $query)) {

			$_SESSION["sessionUsername"] = $_POST["playerName"];
		    echo '2';
		}
	}

	mysqli_close($conn);
?>