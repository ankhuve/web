<?php
	include_once("config.php");
	include_once("functions.php");
	if(!empty($_POST['taskID'])){
		$loggedIn = $_COOKIE['userID'];

		$valueString = "";
		$nChosen = sizeof($_POST['taskID']);
		$taskIDs = $_POST['taskID'];
		for($i = 0; $i<=$nChosen-1; $i++){
			$valueString .= "(".$loggedIn.",".$taskIDs[$i]."),";
		}

		$customTasks = $_POST['taskDesc'];
		$minTaskID = generateTaskID($conn);

		$newTasksQuery = "INSERT INTO task VALUES";
		foreach($customTasks as $ct){
			$newTasksQuery .= "(".$minTaskID.",'".utf8_encode($ct)."', 10,".$loggedIn."),";
			$valueString .= "(".$loggedIn.",".$minTaskID."),";
			$minTaskID += 1; 
		}
		$newTasksQuery = trim($newTasksQuery, ",");
		$newTasksQuery.=";";
		$valueString = trim($valueString, ",");
		$tasklistQuery = "INSERT INTO tasklist VALUES ".$valueString.";";

		queryDb($conn, $newTasksQuery);
		queryDb($conn, $tasklistQuery);

		Header("Location: ../index.php");
	} else {
		$message = "No chosen tasks, you will be redirected to the first setup page.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		Header("Location: ../goals.php");
	}

?>