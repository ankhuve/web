<?php 
	include_once("config.php");
	include_once("functions.php");

	$totPtsTodayQuery = "SELECT sum(points) accomplishedToday
FROM accomplished JOIN user 
ON accomplished.userID = user.id JOIN task 
ON accomplished.taskID = task.id 
WHERE date = '".date("Y-m-d")."' and userID = '".$_COOKIE['userID']."'
GROUP BY username;";

	$totPtsAvailableQuery = "SELECT sum(points) available
FROM tasklist JOIN task 
ON tasklist.taskID = task.id 
WHERE userID = '".$_COOKIE['userID']."';";

	$ptsToday = queryDb($conn, $totPtsTodayQuery);
	$ptsToday = $ptsToday->fetch_object()->accomplishedToday;
	if(is_null($ptsToday)){
		$ptsToday = 0;
	}

	$ptsAvailable = queryDb($conn, $totPtsAvailableQuery);
	$ptsAvailable = $ptsAvailable->fetch_object()->available;
	$output = $ptsToday.",".$ptsAvailable;
	echo $output;
?>