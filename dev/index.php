<?php 
	if(!isset($_COOKIE['userID'])){
		header("Location: login.php");
	} else {
		include_once("php/config.php");
		include_once("php/functions.php");
		$loggedIn = $_COOKIE['userID'];
		$tasklistQuery = "SELECT count(*) numberOfTasks FROM tasklist WHERE userID = '".$loggedIn."';";
		$result = queryDb($conn, $tasklistQuery);
		$resultObj = $result->fetch_object();
		$numberOfTasks = $resultObj->numberOfTasks;
		if($numberOfTasks == 0){
			Header("Location: welcome.html");
		}
	}
	
?>
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
		<script src="js/main-controller.js"></script>
		<script src="js/mainPageFunctions.js"></script>
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	</head>
<body>
	<nav class="navbar navbar-default header">
  		<div class="container-fluid">
  			<?php
  				if(isset($_COOKIE['username'])){
  					echo "<p class='navbar-text'>Inloggad som ".$_COOKIE['username']."</p>";
  					echo '<button onclick="logOut()" type="button" class="btn btn-default navbar-btn">Logga ut</button>';
  				} else {
  					echo "<p class='navbar-text'> You are not logged in </p>";
  					echo '<button onclick="toLogin()" type="button" class="btn btn-default navbar-btn">Logga in</button>';
  				}
  			?>
  			
  		</div>
  	</nav>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2">
				<center><h1> Välkommen <?php echo $_COOKIE['username']; ?></h1></center>
			</div>
		</div>
		<div class="row mainBody">
			<center>
				<button class="btn" onclick="showMyGoals()">Mina mål</button>
				<button class="btn" onclick="showHighscore()">Highscore</button>
				<button class="btn" onclick="showMyStats()">Stats</button>
			</center>
			<div id="goalView">
				<div class="row">
					<center><h2 class="headline">Mina mål</h2></center>
				</div>
				<div id="myTasks" onload="generateMyGoals()">

				</div>
				<div class="row">
					<div class="col-xs-8 col-xs-offset-2">
						<center><button class="btn" onclick="generateMyGoals()">Refresh goals</button></center>
					</div>
				</div>
			</div>
			<div id="highscoreView">
				<div class="row">
					<center><h2 class="headline"> Highscore Total </h2></center>
				</div>
				<div id="highscoreTotal" onload="generateTotalHighscore()">

				</div>
				<div class="row">
					<div class="col-xs-8 col-xs-offset-2">
						<center><button class="btn" onclick="generateTotalHighscore()">Refresh total highscore</button></center>
					</div>
				</div>

				<div class="row">
					<center><h2 class="headline"> Highscore idag </h2></center>
				</div>
				<div id="highscoreDaily" onload="generateDailyHighscore()">

				</div>
				<div class="row">
					<div class="col-xs-8 col-xs-offset-2">
						<center><button class="btn" onclick="generateDailyHighscore()">Refresh daily highscore</button></center>
					</div>
				</div>
			</div>
			<div id="statsView">
				<center><h2 class="headline">Stats go here</h2></center>
			</div>

		</div>

	</div>
</body>
</html>