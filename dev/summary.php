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
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
  	<script src="js/checkIfLoggedIn.js"></script>
  	<script src="js/main-controller.js"></script>
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  	<script type="application/javascript" src="js/fastclick.js"></script>
	<script type="text/javascript">
		window.addEventListener('load', function() {
		    FastClick.attach(document.body);
		}, false);
	</script>
</head>
<body>
	<div class="container fullWidth summaryBg">
		<div class="headerBg center">
			<h1> Sammanfattning </h1>
		</div>
		<div class="summaryBody">
			<p class="center instruction"> Om allting ser bra ut kan du klicka på nästa-knappen för att gå vidare och börja använda applikationen!</p>
			<div class="allGoals">
				<div class="row titles">
					<div class="col-xs-7 col-xs-offset-1">
						<div class="summaryHeader">Beskrivning</div>
					</div>
					<div class="col-xs-3">
						<div class="summaryHeader">Poäng</div>
					</div>
				</div>
				<form action="php/createTasklist.php" method="post">
					<?php
						$totalPoints = 0;
						if(isset($_COOKIE['clicked']) OR (sizeof($_POST['taskDesc']) > 0)){
							
							if(isset($_COOKIE['clicked'])){
								$chosenTasks = "(".$_COOKIE['clicked'].")";
								$chosenTasksQuery = "SELECT * FROM task WHERE id IN ".$chosenTasks.";";
								$result = queryDb($conn, $chosenTasksQuery);

								while($line = $result->fetch_object()){
									$taskID = $line->id;
									$description = utf8_encode($line->description);
									$points = $line->points;
									$totalPoints += $points;
									echo '<div class="row">';
									echo '<div class="col-xs-8 col-xs-offset-1">';
									echo "<input type='checkbox' class='marginRight' name='taskID[]' value=$taskID checked='checked'><span class='taskDescription'>".$description."</span></input>";
									echo '</div>';
									echo '<div class="col-xs-2">'.$points.'</div>';
									echo '</div>';
								}
							}
						}

						$customs = $_POST['taskDesc'];
						$numCustoms = sizeof($customs);
						if($numCustoms>0){
							foreach($customs as $customTaskDescription){
							echo '<div class="row">';
							echo '<div class="col-xs-8 col-xs-offset-1">';
							echo "<input type='checkbox' class='marginRight' name='taskDesc[]' value='".$customTaskDescription."' checked='checked'>".$customTaskDescription."</input>";
							echo '</div>';
							echo '<div class="col-xs-2">10</div>';
							echo '</div>';
							$totalPoints += 10;
							}
						}
						echo '<hr class="customDivider"/>';
						echo '<div class="totalPoints"><p>Med dessa mål kan du totalt tjäna <strong>'.$totalPoints.'</strong> poäng om dagen.</p></div>';
					?>
			</div>
		</div>
			<div id="bottomSummaryLinks">
				<div class="outerBottomLink">
					<center>
						<div class="bottomLink toOwnGoals">
							<input type="button" class="removeInputStyling" value="Tillbaka" onclick="window.location='create.php'"/>
							<!-- <input class="removeInputStyling" value="Tillbaka" onclick="window.location='create.php'"> -->
						</div>
					</center>
				</div>
				<div class="outerBottomLink">
					<center>
						<div class="bottomLink toIndex">
							<input type="submit" class="removeInputStyling" value="Klar!" onclick="unsetCookie(clicked)">
						</div>
					</center>
				</div>
			</div>
		</form>

	</div>
</body>
</html>
