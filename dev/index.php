<?php 
	if(!isset($_COOKIE['userID'])){
		header("Location: login.php");
	} else if($_COOKIE['userID']<50){
		header('Location: php/logout.php');
	}else {
		include_once("php/config.php");
		include_once("php/functions.php");
		$loggedIn = $_COOKIE['userID'];
		$tasklistQuery = "SELECT numTasksToday, numPastTasks
						FROM (
  						(SELECT count(*) numTasksToday, ".$loggedIn." userID
 						FROM tasklist 
  						WHERE userID = ".$loggedIn." AND tasklistDate = CURDATE()) AS A
						JOIN
						(SELECT count(*) numPastTasks, ".$loggedIn." userID
						FROM tasklist 
						WHERE userID = ".$loggedIn." AND tasklistDate <= CURDATE()) AS B
						ON A.userID = B.userID)";
		$result = queryDb($conn, $tasklistQuery);
		$resultObj = $result->fetch_object();
		$numTasksToday = $resultObj->numTasksToday;
		$numPastTasks = $resultObj->numPastTasks;
		if($numTasksToday == 0 && $numPastTasks == 0){
			Header("Location: welcome.php");
		} else if($numTasksToday == 0 && $numPastTasks > 0) {
			$setTodaysTasklistQuery = "INSERT INTO tasklist SELECT userID, taskID, CURDATE() FROM tasklist WHERE userID = ".$loggedIn." AND tasklistDate = (SELECT max(tasklistDate) FROM tasklist WHERE userID = ".$loggedIn.");";
			queryDb($conn, $setTodaysTasklistQuery);
		}
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" minimal-ui>
		<meta name="mobile-web-app-capable" content="yes">
		<meta content="yes" name="apple-mobile-web-app-capable">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="apple-touch-icon-precomposed" sizes="192x192" href="img/iconhd_apple.png">
		<title>GRÖN</title>
		<link rel="icon" sizes="192x192" href="img/iconhd.png">
		<link rel="icon" type="image/png" href="img/fav.png">

		<!-- Bootstrap CSS -->
		<!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'> 
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>  
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'> 
		<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="js/getsize.js"></script>
		<script src="js/main-controller.js"></script>
		<script src="js/mainPageFunctions.js"></script>
		<script type="application/javascript" src="js/fastclick.js"></script>
		<script type="text/javascript">
			window.addEventListener('load', function() {
			    FastClick.attach(document.body);
			}, false);
		</script>

		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">google.load('visualization', '1.0', {'packages':['corechart']});</script>
	</head>
<body>
	<nav class="indexHeader">
		<img class="button menuButton" src="img/menu.png" onclick="slideMenu()">
		<div class="headerTitle">
			Mina mål
		</div>
  	</nav>
  	<div class="container fullwidth" id="outer">
	  	<nav id="slideMenu" style="display: none;">
	  		<ul>
	  			<li id="userInfo"><img class="userIcon" src="img/user.png"><span class="username"></span></li>
  				<li onclick="chooseNewGoals()">Välj nya mål</li>
  				<li class="sideMenuBottomFix" onclick="logOut()"><img class="button" id="logoutButton" src="img/logout_white.png"> Logga ut</li>
	  		</ul>
	  	</nav>
		<div class="container fullWidth offsetHeader" onclick="slideBackMenu()">
			<div class="mainBody">
				<div id="goalView">
					<div id="myTasks" onload="generateMyGoals()"></div>
				</div>

				<div id="statsView">
					<div id="myStats">
						<div class="dailyStats">
							<div class="description statsTitle">Daglig statistik</div>
							<div class="pieChart" id="myDailyStats">
								<!-- Pie chart goes here -->
							</div>
						</div>
						<div class="totalStats">
							<div class="description statsTitle">Total statistik</div>
							<div class="pieChart" id="myTotalStats">
								<!-- Pie chart goes here -->
							</div>
						</div>
						<!-- Stats go here -->
					</div>
					<div id="textStats">
						<div id="leftStat" class="description statsTitle smaller">
							Poäng avklarade idag: </br><span id="pointsToday"></span>
						</div>
						<div id="middleStat" class="description statsTitle smaller">
							Totalt avklarade poäng:</br><span id="pointsTotal"></span>
						</div>
						<div id="rightStat" class="description statsTitle smaller">
							Snittpoäng per dag:</br><span id="avgDailyPoints"></span>
						</div>
					</div>
					
				</div>

				<div class="footer">
					<div class="tab myGoals" onclick="showMyGoals();clickLog('1')">
					</div>
					<div class="tab stats" onclick="showMyStats();clickLog('3')">
					</div>
				</div>
			</div>

		</div>
	</div>
</body>
</html>