<?php
	include_once("config.php");
	include_once("functions.php");

	$tasklistQuery = "SELECT taskID FROM tasklist WHERE userID = ".$_COOKIE['userID']." AND tasklistDate = (SELECT max(tasklistDate) FROM tasklist WHERE userID = ".$_COOKIE['userID'].");";
	$tasklistObj = queryDb($conn, $tasklistQuery);
	$output = "";
	while($line = $tasklistObj->fetch_object()){
		$output .= $line->taskID.",";
	}
	echo rtrim($output,",");
?>