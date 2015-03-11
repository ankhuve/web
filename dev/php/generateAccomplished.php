<?php
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
								WHERE date = '".$today."') and userID = ".$_COOKIE['userID'].");";

	$accomplishedTasksQuery = "SELECT * FROM task 
								WHERE id 
								IN(SELECT taskID
								FROM tasklist
								WHERE taskID IN (SELECT taskID
								FROM accomplished
								WHERE date = '".$today."') and userID = ".$_COOKIE['userID'].");";
	
	$notAccomplishedObj = queryDb($conn, $notAccomplishedTasksQuery);
	$accomplishedObj = queryDb($conn, $accomplishedTasksQuery);

	echo "<div class='row'><center><strong>Accomplished: </strong></center></div>";
	while($accomplished = $accomplishedObj->fetch_object()){
		$taskID = $accomplished->id;
		$description = $accomplished->description;
		$points = $accomplished->points;
		echo '<div class="row">';
		echo '<div class="col-xs-8 col-xs-offset-2">';
		echo '<input type="checkbox" value="'.$taskID.'" onclick="unAccomplishMe()" checked="checked">';
		echo $description;
		echo '</div>';
		echo '<div class="col-xs-2">';
		echo $points;
		echo '</div>';
		echo '</div>';
	}
	echo "<div class='row'><center><strong>Not accomplished: </strong></center></div>";
	while($notAccomplished = $notAccomplishedObj->fetch_object()){
		$taskID = $notAccomplished->id;
		$description = $notAccomplished->description;
		$points = $notAccomplished->points;
		echo '<div class="row">';
		echo '<div class="col-xs-8 col-xs-offset-2">';
		echo '<input type="checkbox" value="'.$taskID.'" onclick="accomplishMe()">';
		echo $description;
		echo '</div>';
		echo '<div class="col-xs-2">';
		echo $points;
		echo '</div>';
		echo '</div>';
	}
	
?>