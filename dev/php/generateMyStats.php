<?php 
	include_once("config.php");
	include_once("functions.php");

	// Dagens accomplished
	$totPtsTodayQuery = "SELECT sum(points) accomplishedToday
FROM accomplished JOIN user 
ON accomplished.userID = user.id JOIN task 
ON accomplished.taskID = task.id 
WHERE date = CURDATE() and userID = '".$_COOKIE['userID']."'";

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

	// Dagar från första accomplished
	$daysOfUsageQuery = "SELECT TIMESTAMPDIFF(DAY, a.first, CURDATE()) days
FROM (SELECT MIN(date) AS first
FROM accomplished
WHERE userid='".$_COOKIE['userID']."') AS a;";

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

	$daysOfUsage = queryDb($conn, $daysOfUsageQuery);
	$daysOfUsage = $daysOfUsage->fetch_object()->days;
	if($daysOfUsage==0){
		$daysOfUsage = 1;
	}

	$output = $ptsToday.",".$ptsAvailable.",".$ptsEver.",".$ptsAvailableEver.",".$daysOfUsage;

	echo $output;
?>