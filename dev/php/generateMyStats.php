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

	$totPtsEverQuery = "SELECT sum(points) accomplishedEver
FROM accomplished JOIN user 
ON accomplished.userID = user.id JOIN task 
ON accomplished.taskID = task.id
WHERE userID = '".$_COOKIE['userID']."'
GROUP BY username;";

	$daysOfUsage = "SELECT TIMESTAMPDIFF(DAY, first, CURDATE()) days
FROM (SELECT MIN(date) AS first
FROM accomplished
WHERE userid=".$_COOKIE['userID'].") AS a;";

	$ptsToday = queryDb($conn, $totPtsTodayQuery);
	$ptsToday = $ptsToday->fetch_object()->accomplishedToday;
	if(is_null($ptsToday)){
		$ptsToday = 0;
	}

	$ptsAvailable = queryDb($conn, $totPtsAvailableQuery);
	$ptsAvailable = $ptsAvailable->fetch_object()->available;
	

	$ptsEver = queryDb($conn, $totPtsEverQuery);
	$ptsEver = $ptsEver->fetch_object()->accomplishedEver;
	if(is_null($ptsEver)){
		$ptsEver = 0;
	}

	$usageDays = queryDb($conn, $daysOfUsage);
	$usageDays = $usageDays->fetch_object()->days;
	if($usageDays==0){
		$usageDays = 1;
	}else{
		$usageDays++;
	}

	$ptsPossibleEver = $usageDays * $ptsAvailable;

	$output = $ptsToday.",".$ptsAvailable.",".$ptsEver.",".$ptsPossibleEver;

	echo $output;
?>