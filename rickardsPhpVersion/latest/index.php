<!DOCTYPE html>
<?php 
	session_start();
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
	</head>
<body>
	<?php
		include_once("php/config.php");
		include_once("php/functions.php");
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
	
	<div class="container fullWidth bgImg">
		<p>TODO INDEX PAGE</p>
	</div>
</body>
</html>