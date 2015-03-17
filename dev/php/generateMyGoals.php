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
								WHERE date = '".$today."' AND userID = ".$_COOKIE[
								'userID'].") and userID = ".$_COOKIE['userID'].")
								ORDER BY task.points DESC;";

	$accomplishedTasksQuery = "SELECT * FROM task 
								WHERE id 
								IN(SELECT taskID
								FROM tasklist
								WHERE taskID IN (SELECT taskID
								FROM accomplished
								WHERE date = '".$today."' AND userID = ".$_COOKIE['userID'].") and userID = ".$_COOKIE['userID'].")
								ORDER BY task.points DESC;";
	
	$notAccomplishedObj = queryDb($conn, $notAccomplishedTasksQuery);
	$accomplishedObj = queryDb($conn, $accomplishedTasksQuery);


	$colorsAndPoints = array(30=>'#64bb50', 25=>'#55a244', 20=>'#4a8d3c', 15=>'#3f7833', 10=>'#36652b');

	$results = array();
	while($accomplished = $accomplishedObj->fetch_object()){
		$taskID = $accomplished->id;
		$description = utf8_encode($accomplished->description);
		$points = $accomplished->points;
		$taskInfo = array(
    		"taskID" => $taskID,
    		"description" => $description,
    		"points" => $points,
    		"accomplished" => true,
    		);

		array_push($results, $taskInfo);
	}

	while($notAccomplished = $notAccomplishedObj->fetch_object()){
		$taskID = $notAccomplished->id;
		$description = utf8_encode($notAccomplished->description);
		$points = $notAccomplished->points;
		$taskInfo = array(
    		"taskID" => $taskID,
    		"description" => $description,
    		"points" => $points,
    		"accomplished" => false,
    		);
		array_push($results, $taskInfo);
	}

	function compare($a, $b){
	    if ($a['points'] == $b['points']) {
	        return 0;
	    }
	    return ($a['points'] < $b['points']) ? 1 : -1;
	}

	usort($results, "compare");

	foreach ($results as $key => $value) {
		echo '<div class="goal" style="background-color: '.$colorsAndPoints[$value["points"]].';" onclick="changeAccomplished(this)">';
		if($value["accomplished"]){
			echo '<div class="pointCircle checkBg"><div class="points" style="display: none;">'.$value["points"].'p</div></div>';
		}else{
			echo '<div class="pointCircle"><div class="points">'.$value["points"].'p</div></div>';
		}
		echo '<div class="tableFix">';
		if($value["accomplished"]){
			echo '<div class="description accomplished" id="'.$value["taskID"].'" style="color: rgba(255, 255, 255, 0.5);">';
		} else {
			echo '<div class="description unaccomplished" id="'.$value["taskID"].'" style="color:#ffffe8;">';
		}
		echo $value["description"];
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
	
?>