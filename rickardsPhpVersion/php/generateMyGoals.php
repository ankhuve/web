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
								WHERE date = '".$today."' AND userID = ".$_SESSION[
								'loggedIn'].") and userID = ".$_SESSION['loggedIn'].");";

	$accomplishedTasksQuery = "SELECT * FROM task 
								WHERE id 
								IN(SELECT taskID
								FROM tasklist
								WHERE taskID IN (SELECT taskID
								FROM accomplished
								WHERE date = '".$today."' AND userID = ".$_SESSION[
								'loggedIn'].") and userID = ".$_SESSION['loggedIn'].");";
	
	$notAccomplishedObj = queryDb($conn, $notAccomplishedTasksQuery);
	$accomplishedObj = queryDb($conn, $accomplishedTasksQuery);

	// echo "<div class='row'><center><strong>Accomplished: </strong></center></div>";
	while($accomplished = $accomplishedObj->fetch_object()){
		$taskID = $accomplished->id;
		$description = $accomplished->description;
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
		$description = $notAccomplished->description;
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