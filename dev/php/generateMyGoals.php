<?php
	session_start();
	include_once("config.php");
	include_once("functions.php");
	$fullDateToday = getdate();
	$today = $fullDateToday['year']."-".$fullDateToday['mon']."-".$fullDateToday['mday'];

	$notAccomplishedTasksQuery = "SELECT * FROM task 
								WHERE id 
								IN(SELECT taskID
								FROM tasklist
								WHERE taskID NOT IN (SELECT taskID
								FROM accomplished
								WHERE date = '".$today."' AND userID = ".$_COOKIE[
								'userID'].") and userID = ".$_COOKIE['userID'].");";

	$accomplishedTasksQuery = "SELECT * FROM task 
								WHERE id 
								IN(SELECT taskID
								FROM tasklist
								WHERE taskID IN (SELECT taskID
								FROM accomplished
								WHERE date = '".$today."' AND userID = ".$_COOKIE['userID'].") and userID = ".$_COOKIE['userID'].");";
	
	$notAccomplishedObj = queryDb($conn, $notAccomplishedTasksQuery);
	$accomplishedObj = queryDb($conn, $accomplishedTasksQuery);

	// echo "<div class='row'><center><strong>Accomplished: </strong></center></div>";
	while($accomplished = $accomplishedObj->fetch_object()){
		$taskID = $accomplished->id;
		$description = utf8_encode($accomplished->description);
		$points = $accomplished->points;
		echo '<div class="row">';
		echo '<div class="col-xs-8 col-xs-offset-1" onclick="changeAccomplished(this)" style="color:green;">';
		echo '<input type="checkbox" value="'.$taskID.'" onclick="checkboxTrigger(this)" checked="checked">';
		echo $description;
		echo '</div>';
		echo '<div class="col-xs-2 centered">';
		echo $points;
		echo '</div>';
		echo '</div>';
	}
	// echo "<div class='row'><center><strong>Not accomplished: </strong></center></div>";
	while($notAccomplished = $notAccomplishedObj->fetch_object()){
		$taskID = $notAccomplished->id;
		$description = utf8_encode($notAccomplished->description);
		$points = $notAccomplished->points;
		echo '<div class="row">';
		echo '<div class="col-xs-8 col-xs-offset-1" onclick="changeAccomplished(this)" style="color:red;">';
		echo '<input type="checkbox" value="'.$taskID.'" onclick="checkboxTrigger(this)">';
		echo $description;
		echo '</div>';
		echo '<div class="col-xs-2 centered">';
		echo $points;
		echo '</div>';
		echo '</div>';
	}
	
?>