<?php
	session_start();
	include_once("config.php");
	include_once("functions.php");
	$fullDateToday = getdate();
	$today = $fullDateToday['year']."-".$fullDateToday['mon']."-".$fullDateToday['mday'];
	$taskID = $_POST['taskID'];
	$userID = $_SESSION['loggedIn'];
	$accomplishGoalQuery = "INSERT INTO accomplished VALUES(".$userID.",".$taskID.",'".$today."');";

	queryDb($conn, $accomplishGoalQuery);

?>