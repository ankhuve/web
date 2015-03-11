<?php
	session_start();
	include_once("config.php");
	include_once("functions.php");
	$fullDateToday = getdate();
	$today = $fullDateToday['year']."-".$fullDateToday['mon']."-".$fullDateToday['mday'];
	$taskID = $_POST['taskID'];
	$userID = $_COOKIE['userID'];
	$unAccomplishGoalQuery = "DELETE FROM accomplished WHERE userID = ".$userID." AND taskID = ".$taskID." AND date = '".$today."';";

	queryDb($conn, $unAccomplishGoalQuery);

?>