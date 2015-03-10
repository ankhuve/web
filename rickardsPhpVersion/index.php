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
    <meta name="mobile-web-app-capable" content="yes">

    <title> Index </title>
    
	<link rel="icon" sizes="192x192" href="img/iconhd.png">
	<link rel="icon" type="image/png" href="img/fav.png">
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
	<?php
		if(!isset($_SESSION['loggedIn'])){
			header("Location: login.php");
		} else {
			$loggedIn = $_SESSION['loggedIn'];
			$tasklistQuery = "SELECT count(*) numberOfTasks FROM tasklist WHERE userID = '".$loggedIn."';";
			$result = queryDb($conn, $tasklistQuery);
			$resultObj = $result->fetch_object();
			$numberOfTasks = $resultObj->numberOfTasks;
			if($numberOfTasks == 0){
				Header("Location: setup.php");
			}

		}
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2">
				<center><h1> Välkommen <?php echo $_SESSION['username']; ?></h1></center>
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
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="js/main-controller.js"></script>
	<script src="js/mainPageFunctions.js"></script>
</body>
</html>
