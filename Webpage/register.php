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
  	<h3 class="text-center">Register</h3>
  	<p id="register_error"></p>
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
	      	<label class="control-label col-sm-2" for="playerconfPassword">Confirm Password:</label>
	      	<div class="col-sm-8">          
	        	<input type="password" class="form-control" id="playerconfPassword" placeholder="Enter password" name="playerconfPassword" required>
	      	</div>
	    </div>
	    <div class="form-group">
	      	<div class="col-sm-offset-2 col-sm-10">
	        	<div class="checkbox">
	         		<a href="login.php">Already registered?</a>
	        	</div>
	      	</div>
	    </div>
	    <div class="form-group">        
	      	<div class="col-sm-offset-2 col-sm-10">
	        	<input type="button" class="btn btn-default" value="Register" onClick="RegisterUser()">
	      	</div>
	    </div>
	</form>
</div>


<footer class="footer" style="padding: 15px;">
  	<p>Copyright &copy; oMa37</p>
</footer>

<script type="text/javascript">
function RegisterUser() {

	var register_username_value = $('#playerName').val(), register_password_value = $('#playerPassword').val(), register_confpassword_value = $('#playerconfPassword').val();
	var regleng = register_username_value.length;
	if(register_username_value == '' || register_password_value == '' || register_confpassword_value == '') {

		$('#register_error').html('<div class="alert alert-danger text-center fade in" style="width: 500px; padding: 10px; margin: auto;">\
	  											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
		  										<strong>Insert below your username and password!</strong>\
											</div><br>').show();
	}
	else if(register_password_value != register_confpassword_value) {

		$('#register_error').html('<div class="alert alert-danger text-center fade in" style="width: 500px; padding: 10px; margin: auto;">\
	  											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
		  										<strong>Both passwords must match each others!</strong>\
											</div><br>').show();
	}
	else if(regleng > 24) {

		$('#register_error').html('<div class="alert alert-danger text-center fade in" style="width: 500px; padding: 10px; margin: auto;">\
	  											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
		  										<strong>Invalid username!</strong>\
											</div><br>').show();
	}
	else {

		$.ajax({
			type: 'POST',
			url: 'register_action.php',
			data: "playerName=" + register_username_value + "&playerPassword=" + register_password_value,
			success: function(response)
			{
				$('#register_error').html(response);
				if(response == '1') {

					$('#register_error').html('<div class="alert alert-danger text-center fade in" style="width: 500px; padding: 10px; margin: auto;">\
	  											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
		  										<strong>Username already exists!</strong>\
											</div><br>').show();
				}
				else if(response == '2') {

					$('#register_error').html('<div class="alert alert-success text-center fade in" style="width: 500px; padding: 10px; margin: auto;">\
	  											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\
		  										<strong>Successfully registered!</strong>\
											</div><br>').show();
					register_user_timer = setTimeout('FadeOutRegisterUser()', 1500);
				}
			}
		});
	}
}

function FadeOutRegisterUser() {

	$('#register_error').fadeOut('slow');
	window.location = "vehicles.php";
	clearTimeout(register_user_timer);
}
</script>

</div>
</body>
</html>