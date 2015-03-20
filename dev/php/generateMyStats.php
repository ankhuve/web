<?php 
	include_once("config.php");
	include_once("functions.php");

	// Dagens accomplished
	$totPtsTodayQuery = "SELECT sum(points) accomplishedToday
FROM accomplished JOIN user 
ON accomplished.userID = user.id JOIN task 
ON accomplished.taskID = task.id 
WHERE date = '".date("Y-m-d")."' and userID = '".$_COOKIE['userID']."'
GROUP BY username;";

	// Dagens möjliga poäng
	$totPtsAvailableQuery = "SELECT sum(points) available
FROM tasklist JOIN task 
ON tasklist.taskID = task.id 
WHERE userID = '".$_COOKIE['userID']."' AND tasklistDate = CURDATE();";

	// Totalt accomplished poäng
	$totPtsEverQuery = "SELECT sum(points) accomplishedEver
FROM accomplished JOIN user 
ON accomplished.userID = user.id JOIN task 
ON accomplished.taskID = task.id
WHERE userID = '".$_COOKIE['userID']."'
GROUP BY username;";

	// Totalt möjliga poäng
	$totPtsAvailableEverQuery = "SELECT SUM(points) possiblePts
FROM tasklist
JOIN task ON taskID = id
AND tasklistDate <= CURDATE() 
WHERE userID = '".$_COOKIE['userID']."'
GROUP BY userID;";

	$ptsToday = queryDb($conn, $totPtsTodayQuery);
	$ptsToday = $ptsToday->fetch_object()->accomplishedToday;
	if(is_null($ptsToday)){
		$ptsToday = 0;
	}

	$ptsAvailable = queryDb($conn, $totPtsAvailableQuery);
	$ptsAvailable = $ptsAvailable->fetch_object()->available;

	$ptsAvailableEver = queryDb($conn, $totPtsAvailableEverQuery);
	$ptsAvailableEver = $ptsAvailableEver->fetch_object()->possiblePts;
	

	$ptsEver = queryDb($conn, $totPtsEverQuery);
	$ptsEver = $ptsEver->fetch_object()->accomplishedEver;
	if(is_null($ptsEver)){
		$ptsEver = 0;
	}

	$output = $ptsToday.",".$ptsAvailable.",".$ptsEver.",".$ptsAvailableEver;

	echo $output;
?>