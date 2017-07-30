<?php 
  include("config.php");

  $conn = mysqli_connect($hostname, $username, $password, $database);

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $query = "SELECT `Money` FROM `Users` WHERE `Username` = '".$_SESSION["sessionUsername"]."'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) == 1) {

    while($row = mysqli_fetch_assoc($result)) {

        $currentMoney = $row["Money"];
    }
  }
  else $currentMoney = 0;

  mysqli_close($conn);
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="vehicles.php">Vehicles</a></li>
        <li><a href="skins.php">Skins</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a><?php echo $_SESSION["sessionUsername"];?></a></li>
        <li><a><?php echo "$".number_format($currentMoney)."";?></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
      </ul>
    </div>
  </div>
</nav>