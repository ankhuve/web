<?php
	include_once("config.php");
	include_once("functions.php");
	$dateToday = date("Y-m-d H:i:s");
	$userID = $_COOKIE['userID'];
	$type = $_POST['type'];
	$clickedQuery = "INSERT INTO clickReg VALUES (".$userID.",'".$dateToday."',".$type.");";
	queryDb($conn, $clickedQuery);
?>