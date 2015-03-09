<?php 
	session_start(); 
	include_once("php/functions.php");
	include_once("php/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Custom Task </title>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="kexjobb.css"/>

  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">
  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
</head>

<body>
	<nav class="navbar navbar-default header">
  		<div class="container-fluid">
  			<?php
  				
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
				<center><h4> Dina valda mål från föregående sida </h4></center>
				<form action='summary.php' method='post' id='customGoalForm'>
				<?php
					if(!empty($_POST['taskID'])) {
		    			foreach($_POST['taskID'] as $checkedTask) {
		    				$taskQuery = "SELECT description, points FROM task WHERE id=".$checkedTask.";";
		            		$result = queryDb($conn, $taskQuery);
		            		$line = $result->fetch_object();
		            		$description = $line->description;
		            		$points = $line->points;
		            		echo "<div class='row'>";
		            		echo "<div class='col-xs-9'><input type='checkbox' name='taskID[]' value=$checkedTask checked='checked'>".$description."</div>";
		            		echo "<div class='col-xs-3'>".$points."</div>";
		            		echo "</div>";
						}
					}
				?>
			
				<span class="centered">
					<h4> Lägg till egna mål </h4>
					<p> Egna mål ger 10 poäng vardera osv. <span id="refreshGoals" class="glyphicon glyphicon-refresh"></span></p>
				</span>
				
				<div id="myCustomGoals" onload="refreshMyGoals()">
				
				</div>
				<div class="row">
					<div class="col-xs-8 col-xs-offset-2">
						<input type="text" class="form-control" id="userInput">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-8 col-xs-offset-2">
						<center>
							<input type="button" value="Add custom goal" class="btn" id="addGoal">
						</center>
					</div>
				</div>
				
				<div class="row">
					<center><button onclick="goBack()" class="btn"> Tillbaka </button><input type="submit" class="btn" value="Nästa"></center>
				</div>
			</form>
			<!-- <div class="row centered">
				If the goals does not refresh correctly, click the button below.
				<center><button class="btn" id="refreshGoals">Refresh my goals </button></center>
			</div> -->
		</div>

		
	</div>
	<script type="text/javascript">window.onload = function() {refreshMyGoals();};</script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="js/main-controller.js"></script>
	
</body>
</html>
