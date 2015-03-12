<?php
	include_once("config.php");
	include_once("functions.php");
	$nTotGoal = sizeof($_POST['taskID'])+sizeof($_POST['taskDesc']);
	if($nTotGoal > 0){
		$loggedIn = $_COOKIE['userID'];

		$valueString = "";
		$nChosen = sizeof($_POST['taskID']);
		$taskIDs = $_POST['taskID'];
		for($i = 0; $i<=$nChosen-1; $i++){
			$valueString .= "(".$loggedIn.",".$taskIDs[$i]."),";
		}

		$customTasks = $_POST['taskDesc'];
		$minTaskID = generateTaskID($conn);

		if(sizeof($customTasks) > 0){
			$newTasksQuery = "INSERT INTO task VALUES";
			foreach($customTasks as $ct){
				$newTasksQuery .= "(".$minTaskID.",'".utf8_decode($ct)."', 10,".$loggedIn."),";
				$valueString .= "(".$loggedIn.",".$minTaskID."),";
				$minTaskID += 1; 
			}
			$newTasksQuery = trim($newTasksQuery, ",");
			$newTasksQuery.=";";
			queryDb($conn, $newTasksQuery);
		}

		$valueString = trim($valueString, ",");
		$tasklistQuery = "INSERT INTO tasklist VALUES ".$valueString.";";		
		queryDb($conn, $tasklistQuery);

		Header("Location: ../index.php");
	} else {
		// Header("Location: ../goals.php");

		$message = "Inga valda mål, du kommer att omdirigeras till den första intällningssidan där du kan välja mål.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../goals.php">';
		
	}

?>