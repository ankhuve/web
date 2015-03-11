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

    <title> Sammanfattning </title>

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css" />

  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">
  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<center><h1> Sammanfattning </h1></center>
			</div>
		</div>
		<p class="centered marginTop"> Om allting ser bra ut kan du klicka på nästa-knappen för att gå vidare och börja använda applikationen!</p>
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

			// echo sizeof(explode(",",$_COOKIE['clicked']));
			if(isset($_COOKIE['clicked'])){

				$chosenTasks = "(".$_COOKIE['clicked'].")";
				$chosenTasksQuery = "SELECT * FROM task WHERE id IN ".$chosenTasks.";";
				$result = queryDb($conn, $chosenTasksQuery);

				while($line = $result->fetch_object()){
					$taskID = $line->id;
					$description = utf8_encode($line->description);
					$points = $line->points;
					echo '<div class="row">';
					echo '<div class="col-xs-8 col-xs-offset-1">';
					echo "<input type='checkbox' name='taskID[]' value=$taskID checked='checked'>".$description."</input>";
					echo '</div>';
					echo '<div class="col-xs-2">'.$points.'</div>';
					echo '</div>';
				}

			}

			$customs = $_POST['taskDesc'];
			$numCustoms = sizeof($customs);
			if($numCustoms>0){
				foreach($customs as $customTaskDescription){
				echo '<div class="row">';
				echo '<div class="col-xs-8 col-xs-offset-1">';
				echo "<input type='checkbox' name='taskDesc[]' value='".$customTaskDescription."' checked='checked'>".$customTaskDescription."</input>";
				echo '</div>';
				echo '<div class="col-xs-2">10</div>';
				echo '</div>';
				}
			}
		?>
		<div class="row">
			<center>
				<input type="submit" class="btn" value="Nästa" onclick="unsetCookie(clicked)">
			</center>
		</div>
		</form>
		

	</div>
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="js/main-controller.js"></script>
</body>
</html>
