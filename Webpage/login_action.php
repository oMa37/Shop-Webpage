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

		while($row = mysqli_fetch_assoc($result)) {

			if($_POST["playerPassword"] == $row["Password"]) {

				$_SESSION["sessionUsername"] = $row["Username"];
				echo '1';
			}
			else echo '3';
		}
	}
	else echo '2';

	mysqli_close($conn);
?>