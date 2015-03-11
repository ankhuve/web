<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
		<meta name="mobile-web-app-capable" content="yes">
		<title>GRÖN</title>
		<link rel="icon" sizes="192x192" href="img/iconhd.png">
		<link rel="icon" type="image/png" href="img/fav.png">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>    
		<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="js/getsize.js"></script>
		<script src="js/createGoal.js"></script>
	</head>
<body onload="updateChosen()">
	<div class="container fullWidth goalBg">

		<div class="wrapper">
			<div id="goalHeaders">
				<h1 class="mdMargin center" id="chooseGoalsHeader">Skapa egna mål</h1>
				<h2 class="thinHeader center">10 poäng per mål</h2>
				<h2> Du har total valt <span id="totalGoals"></span>/5 mål. </h2>
			</div>
		</div>

		<form action="summary.php" method="post">
			<div class="goalGrid center">
				
				<div class="col-xs-12 newGoalForm">
					<input class="userinput newGoal" id="goalInput" type="goalDescription" placeholder="T.ex. duscha fem minuter kortare.">
					<div class="createGoal" id="createGoalButton" onclick="createGoal()">Skapa</div>
				</div>

				<span class="createdGoals">

				</span>
			</div>


			<div class="bottomGreen">
				
				<!-- <h2 class="goalInstructions"><a href="index.php">Skapa egna mål.</a></h2> -->
				<div class="navArrows">
					<div class="prev">
						<a href="goals.php">
							<img class="arrow" src="img/prev_arrow_white.png">
						</a>
					</div>
				</div>
				
				<input type="submit" value="Klar!" class="doneLink"></input>
			</div>
		</form>

	</div>
</body>