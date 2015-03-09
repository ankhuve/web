<?php 
	session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Sammanfattning </title>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="kexjobb.css" />

  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">
  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
</head>
<body>
	<nav class="navbar navbar-default header">
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
				<center><h1> Sammanfattning </h1></center>
			</div>
		</div>
		<p class="centered"> Om allting ser bra ut kan du klicka på nästa-knappen för att gå vidare och börja använda applikationen!</p>
		<div class="row">
			<div class="col-xs-8 col-xs-offset-1">
				<strong>Beskrivning</strong>
			</div>
			<div class="col-xs-2">
				<strong>Poäng</strong>
			</div>
		</div>
		<form action="php/createTasklist.php" method="post">
		<?php
			include_once("php/config.php");
			$chosenTasks = [];

			$_SESSION['chosenTasksArray'];
			if(!empty($_POST['customTaskID'])) {
    			foreach($_POST['customTaskID'] as $customTask) {
    				array_push($chosenTasks, $customTask);
				}
			}

			if(!empty($_POST['taskID'])) {
    			foreach($_POST['taskID'] as $checkedTask) {
    				array_push($chosenTasks, $checkedTask);
				}
			}

			$numberOfTasks = sizeof($chosenTasks);
			$tasksInString = "(";
			for($i = 0; $i<$numberOfTasks-1; $i++){
				$tasksInString .= $chosenTasks[$i].",";
			}
			$tasksInString .= $chosenTasks[$numberOfTasks-1].")";
			$chosenTasksQuery = "SELECT * FROM task WHERE id IN ".$tasksInString.";";
			$result = queryDb($conn, $chosenTasksQuery);
			while($line = $result->fetch_object()){
				$taskID = $line->id;
				$description = $line->description;
				$points = $line->points;
				echo '<div class="row">';
				echo '<div class="col-xs-8 col-xs-offset-1">';
				echo "<input type='checkbox' name='taskID[]' value=$taskID checked='checked'>".$description;
				echo '</div>';
				echo '<div class="col-xs-2">';
				echo $points;
				echo '</div>';
				echo '</div>';
			}
		?>
		<div class="row">
			<center>
				<input type="submit" class="btn" value="Nästa">
			</center>
		</div>
		</form>
		

	</div>
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="js/main-controller.js"></script>
</body>
</html>
