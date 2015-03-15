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
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>  
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'> 
		<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="js/getsize.js"></script>
		<script src="js/main-controller.js"></script>
		<script src="js/mainPageFunctions.js"></script>
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">google.load('visualization', '1.0', {'packages':['corechart']});</script>
	</head>
<body>
	<nav class="indexHeader">
  		<!-- <div class="container-fluid"> -->
		<img class="menuButton" src="img/logout.png" onclick="logOut()">
		<div class="headerTitle">
			Mina mål
		</div>
		<!-- <?php
			if(isset($_COOKIE['username'])){
				echo "<p class='navbar-text'>Inloggad som ".$_COOKIE['username']."</p>";
				echo '<button onclick="logOut()" type="button" class="btn btn-default navbar-btn">Logga ut</button>';
			} else {
				echo "<p class='navbar-text'> You are not logged in </p>";
				echo '<button onclick="toLogin()" type="button" class="btn btn-default navbar-btn">Logga in</button>';
			}
		?> -->
  			
  		<!-- </div> -->
  	</nav>
	<div class="container fullWidth offsetHeader">
		<div class="mainBody">
			<div id="goalView">
				<div id="myTasks" onload="generateMyGoals()">
					<!-- Tasks go here -->
				</div>
			</div>

			<div id="highscoreView">
				<div id="highscoreTotal" onload="generateTotalHighscore()">
					<!-- Highscores go here -->
				</div>
				
				
				<div id="highscoreDaily" onload="generateDailyHighscore()">
					<!-- Highscores go here -->
				</div>
				<div class="toggleDaily" onclick="toggleHighscore()" id="total"><div class="toggle"></div></div>
			</div>

			<div id="statsView">
				<div id="myStats">
					<div class="dailyStats">
						<div class="description">Daglig statistik</div>
						<div class="pieChart" id="myDailyStats">
							<!-- Pie chart goes here -->
						</div>
					</div>
					<div class="totalStats">
						<div class="description">Total statistik</div>
						<div class="pieChart" id="myTotalStats">
							<!-- Pie chart goes here -->
						</div>
					</div>
					
					<!-- Stats go here -->
				</div>
			</div>

			<div class="footer">
				<div class="tab myGoals" onclick="showMyGoals()">
				</div>
				<div class="tab highScore" onclick="showHighscore()">
				</div>
				<div class="tab stats" onclick="showMyStats()">
				</div>
			</div>
		</div>

	</div>
</body>
</html>