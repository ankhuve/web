<?php
	include_once("config.php");
	include_once("functions.php");
	$nTotGoal = sizeof($_POST['taskID'])+sizeof($_POST['taskDesc']);
	

	if($nTotGoal > 0){
		$fullDateToday = getdate();
		$today = $fullDateToday['year']."-".$fullDateToday['mon']."-".$fullDateToday['mday'];
		$checkIfTasksExist = "SELECT COUNT(*) FROM tasklist WHERE userID=".$_COOKIE['userID'].";";

		$loggedIn = $_COOKIE['userID'];

		$valueString = "";
		$nChosen = sizeof($_POST['taskID']);
		$taskIDs = $_POST['taskID'];

		// Number of days to be added
		$daysToAdd = 7; 

		for($i = 0; $i<=$nChosen-1; $i++){
			$valueString .= "(".$loggedIn.",".$taskIDs[$i].",'".$today."'),";
			$date = date_create($today);
			// Adds predefined tasks $daysToAdd days forward.
			for($j = 0; $j < $daysToAdd; $j++){
				$date = date_add($date, date_interval_create_from_date_string("1 day"));
				$valueString .= "(".$loggedIn.",".$taskIDs[$i].",'".date_format($date, "Y-m-d")."'),";
			}
		}

		$customTasks = $_POST['taskDesc'];
		$minTaskID = generateTaskID($conn);

		if(sizeof($customTasks) > 0){
			$newTasksQuery = "INSERT INTO task VALUES";

			foreach($customTasks as $ct){ //Loop through custom tasks
				$newTasksQuery .= "(".$minTaskID.",'".utf8_decode($ct)."', 10,".$loggedIn."),";
				$valueString .= "(".$loggedIn.",".$minTaskID.",'".$today."'),";

				$date = date_create($today);
				// Add custom tasks to tasklist $daysToAdd days forward.
				for($j = 0; $j < $daysToAdd; $j++){
					$date = date_add($date, date_interval_create_from_date_string("1 day"));
					$valueString .= "(".$loggedIn.",".$minTaskID.",'".date_format($date, "Y-m-d")."'),";
				}

				$minTaskID += 1; 
			}
			$newTasksQuery = trim($newTasksQuery, ",");
			$newTasksQuery.=";";
			queryDb($conn, $newTasksQuery);
		}

		$valueString = trim($valueString, ",");
		
		$checkIfTasksExist = "SELECT COUNT(*) numTasks FROM tasklist WHERE userID=".$_COOKIE['userID']." AND tasklistDate >= '".$today."';";
		if((queryDb($conn, $checkIfTasksExist)->fetch_object()->numTasks)>0){
			$removePreviousGoals = "DELETE FROM tasklist WHERE userID=".$_COOKIE['userID']." AND tasklistDate >= CURDATE();";
			queryDb($conn, $removePreviousGoals);
			$deleteDailyPoints = "DELETE FROM accomplished WHERE userID=".$_COOKIE['userID']." AND date='".$today."';";
			queryDb($conn, $deleteDailyPoints);
		}
		$tasklistQuery = "INSERT INTO tasklist VALUES ".$valueString.";";
		queryDb($conn, $tasklistQuery);

		Header("Location: ../index.php");

	} else {
		$message = "Inga valda mål, du kommer att omdirigeras till den första intällningssidan där du kan välja mål.";
		echo utf8_decode("<script type='text/javascript'>alert('$message');</script>");
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../goals.php">';
		
	}

?>