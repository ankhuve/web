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
		<script src="js/main-controller.js"></script>
		<script type="application/javascript" src="js/fastclick.js"></script>
		<script type="text/javascript">
			window.addEventListener('load', function() {
			    FastClick.attach(document.body);
			}, false);
		</script>
		<script src="js/checkIfLoggedIn.js"></script>
	</head>
<body onload="unsetCookie('clicked')">
	<div class="container fullWidth goalBg">
		<div class="wrapper">
			<div id="goalHeaders">
				<h1 class="mdMargin center" id="chooseGoalsHeader">Välj dina dagliga mål</h1>
				<h2 class="thinHeader center" id="chooseGoalsSub">Valda mål: <span id="numChosenGoals">0</span></h2>
			</div>
		</div>
		<div class="goalGrid">
			<div class="row" id="goals">
				<!-- Goals go here -->
			</div>
		</div>
		<div class="bottomGreen">
			
			<h2 class="goalInstructions increasedPadding">På nästa sida kommer du kunna skapa egna mål.</h2>
			<div class="navArrows bottomFix">
			<div class="prev">
				<img class="arrow" src="img/prev_arrow_white.png" onclick="window.location='welcome.php'">
			</div>
			<div class="next">
				<img class="arrow toCustomGoals" src="img/arrow_white.png" onclick="window.location='create.php'">
			</div>
		</div>
		</div>

	</div>
</body>