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
		<script src="js/chooseGoal.js"></script>
		<script src="js/getsize.js"></script>
	</head>
<body>
	<div class="container fullWidth goalBg">
		<div class="wrapper">
			<div id="goalHeaders">
				<h1 class="mdMargin center" id="chooseGoalsHeader">Välj några mål</h1>
				<h2 class="thinHeader center">Valda mål: <span id="numChosenGoals">0</span>/5</h2>
				<!-- <h2 class="thinHeader center" id="chooseGoalsSub">För att förbättra miljön har jag tänkt att:</h2> -->
			</div>
		</div>
		<div class="goalGrid">
			<div class="row" id="goals">
				<!-- Goals go here -->
			</div>
		</div>
		<div class="bottomGreen">
			
			<h2 class="goalInstructions">Välj några mål eller gå vidare och skapa egna</h2>
			<div class="navArrows">
			<div class="prev">
				<a href="welcome.html">
					<img class="arrow" src="img/prev_arrow_white.png">
				</a>
			</div>
			<div class="next">
				<a href="create.php">
				<!-- <a href="#"> -->
					<img class="arrow toCustomGoals" src="img/arrow_white.png">
				</a>
			</div>
		</div>
		</div>

	</div>
</body>