<?php 
	session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Login </title>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="kexjobb.css" />

  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">
  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
</head>
<body>
	<nav class="navbar navbar-default header" style="display:none;">
  		<div class="container-fluid">
  			<?php
  				include_once("php/functions.php");
  				if(isset($_SESSION['loggedIn'])){
  					echo "<p class='navbar-text'>Signed in as ".$_SESSION['username']."</p>";
  					echo '<button onclick="logOut()" type="button" class="btn btn-default navbar-btn">Log out</button>';
  				} else {
  					echo "<p class='navbar-text'> You are not logged in </p>";
  					echo '<button onclick="toLogin()" type="button" class="btn btn-default navbar-btn">Log in</button>';
  				}
  			?>
  		</div>
  	</nav>

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2">
				<center><h1> Log in </h1></center>
			</div>
		</div>

		<?php 
      if(!isset($_SESSION['loggedIn'])){
        echo '
        <form action="php/validateLogin.php" method="post">
      		<div class="row" style="margin-top:30px;">
      			<div class="col-xs-8 col-xs-offset-2">
      				<input type="text" name="username" class="form-control" placeholder="Username">
      				<input type="password" name="password" class="form-control" placeholder="Password">
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-xs-8 col-xs-offset-2">
      				<center><input class="btn" type="submit" value="Log in"><input class="btn"  onclick="toNewUser()" type="button" value="Create new user"></center>
      			</div>
      		</div>
      	</form>';
      } else {
      echo '
      <div class="row">
        <center> You are already logged in </center>
        <center><button onclick="logOut()" type="button" class="btn btn-default">Log out</button></center>
      </div>';
      }; 
    ?>

    

<?php 
    $available = $_SESSION['invalidUser'];
    if($available == "invalid"){
    	echo "<div class='row'>";
    	echo "<div class='col-xs-8 col-xs-offset-2'>";
    	echo "<center> Inloggningen misslyckades, vänligen försök igen!</center>";
    	echo "</div>";
    	echo "</div>";
    }
?>
	</div>
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="js/main-controller.js"></script>
</body>
</html>
