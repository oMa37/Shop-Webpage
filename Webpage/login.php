<?php
	session_start();

	if(isset($_SESSION["sessionUsername"])) {

		header("Location: vehicles.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shop - Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<br><br><br><br>
<div class="container">
  	<h3 class="text-center">Login</h3>
  	<p id="login_error"></p>
	<form class="form-horizontal" action="post" method="post">
	    <div class="form-group">
	      	<label class="control-label col-sm-2" for="playerName">Username:</label>
	      	<div class="col-sm-8">
	        	<input type="playerName" class="form-control" id="playerName" placeholder="Enter username" name="playerName" required>
	      	</div>
	    </div>
	    <div class="form-group">
	      	<label class="control-label col-sm-2" for="playerPassword">Password:</label>
	      	<div class="col-sm-8">          
	        	<input type="password" class="form-control" id="playerPassword" placeholder="Enter password" name="playerPassword" required>
	      	</div>
	    </div>
	    <div class="form-group">
	      	<div class="col-sm-offset-2 col-sm-10">
	        	<div class="checkbox">
	         		<a href="register.php">Don't have an account?</a>
	        	</div>
	      	</div>
	    </div>
	    <div class="form-group">        
	      	<div class="col-sm-offset-2 col-sm-10">
	        	<input type="button" class="btn btn-default" value="Login" onClick="SubmitLoginUser()">
	      	</div>
	    </div>
	</form>
</div>


<footer class="footer" style="padding: 15px;">
  	<p>Copyright &copy; oMa37</p>
</footer>

<script type="text/javascript">
function SubmitLoginUser() {

	var login_username_value = $('#playerName').val(), login_password_value = $('#playerPassword').val();
	if(login_username_value == '' || login_password_value == '') {

		$('#login_error').html('<div class="alert alert-danger text-center fade in" style="width: 500px; padding: 10px; margin: auto;">\
	  											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
		  										<strong>Insert below your username and password!</strong>\
											</div><br>').show();
	}
	else {

		$.ajax({
			type: 'POST',
			url: 'login_action.php',
			data: "playerName=" + login_username_value + "&playerPassword=" + login_password_value,
			success: function(response)
			{
				$('#login_error').html(response);
				if(response == '1') {

					$('#login_error').html('<div class="alert alert-success text-center fade in" style="width: 500px; padding: 10px; margin: auto;">\
	  											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
		  										<strong>Successfully logged in!</strong>\
											</div><br>').show();
					login_user_timer = setTimeout('FadeOutLoginUser()', 1500);
				}
				else if(response == '2') {

					$('#login_error').html('<div class="alert alert-danger text-center fade in" style="width: 500px; padding: 10px; margin: auto;">\
	  											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
		  										<strong>Username does not exist</strong>\
											</div><br>').show();
				}
				else if(response == '3') {

					$('#login_error').html('<div class="alert alert-danger text-center fade in" style="width: 500px; padding: 10px; margin: auto;">\
	  											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
		  										<strong>Password is not correct</strong>\
											</div><br>').show();
				}
			}
		});
	}
}

function FadeOutLoginUser() {

	$('#login_error').fadeOut('slow');
	window.location = "vehicles.php";
	clearTimeout(login_user_timer);
}
</script>

</div>
</body>
</html>