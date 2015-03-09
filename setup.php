<?php 
	session_start(); 
	include_once("php/config.php");
	include_once("php/functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Setup </title>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="kexjobb.css" />

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
			<div class="col-xs-10 col-xs-offset-1">
				<center><h1> Välkommen <?php echo $_SESSION['username']; ?></h1></center>
			</div>
		</div>
		<div class="row welcomeInfo">
			<div class="col-xs-10 col-xs-offset-1">
				<p class="centered">I denna applikation kan du välja eller skapa några intressanta miljövänliga mål som du vill ha uppnått när veckan är slut.</p>
				<p class="centered">Målen du väljer ska på något sätt minska ditt ekologiska fotavtryck.</p> 
			</div>
		</div>


		<div class="row selectGoals">
			<div class="col-xs-10 col-xs-offset-1">
				<p class="centered"> Här kan du välja dina mål bla bla bla: </p>
				<div class="col-xs-10 col-xs-offset-1">
					<div class="row">
						<div class="col-xs-8">
							<strong>Uppgift</strong>
						</div>
						<div class="col-xs-4">
							<strong>Poäng</strong>
						</div>
					</div>
				<?php 
					$goalsQuery = 'SELECT * FROM task WHERE addedBy is null;';
					$result = queryDb($conn, $goalsQuery);
					echo "<form action='addCustomTask.php' method='post'>";
					
				    while($line = $result->fetch_object()){
				    	$taskID = $line->id;
				    	$taskDescription = $line->description;
				    	$taskPoints = $line->points;
				    	echo "<div class='row'>";
				    	echo "<div class='col-xs-8'>";
				    	echo "<input type='checkbox' name='taskID[]' value=$taskID>".$taskDescription."</input>";
				    	echo "</div>";
				    	echo "<div class='col-xs-4'>";
				    	echo $taskPoints;
				    	echo "</div>";
				    	echo "</div>";
				    }
					// $customTaskID = generateTaskID($conn);
				?>
					<p class="centered"> På nästa sida kommer du kunna lägga till egna mål. Kul va!? </p>
				    <center>
				    	<!-- <input type='button' value='Tillbaka' class='btn' onclick='backToWelcome()'> -->
				    	<input type='submit' value='Nästa' class='btn'>
				    </center>
				    </form>
				
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="js/main-controller.js"></script>
</body>
</html>
