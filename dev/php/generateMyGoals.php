<?php
	include_once("config.php");
	include_once("functions.php");
	$fullDateToday = getdate();
	$today = $fullDateToday['year']."-".$fullDateToday['mon']."-".$fullDateToday['mday'];

	// function consoleLog($message){
	// 	$output.= "<script type='text/javascript'>console.log('".$message."');</script>";
	// }
	// consoleLog("Mjao");
	$notAccomplishedTasksQuery = "SELECT * FROM task 
								WHERE id 
								IN(
									SELECT taskID
									FROM tasklist
									WHERE taskID NOT IN (
										SELECT taskID
										FROM accomplished
										WHERE date = '".$today."' AND userID = ".$_COOKIE['userID'].") 
									AND userID = ".$_COOKIE['userID']." 
									AND tasklistDate = (
										SELECT max(tasklistDate) 
										FROM tasklist 
										WHERE userID = ".$_COOKIE['userID']."))
								ORDER BY task.points DESC;";

	$accomplishedTasksQuery = "SELECT * FROM task 
								WHERE id 
								IN(
									SELECT taskID
									FROM tasklist
									WHERE taskID IN (
										SELECT taskID
										FROM accomplished
										WHERE date = '".$today."' AND userID = ".$_COOKIE['userID'].") 
								and userID = ".$_COOKIE['userID']."
								AND tasklistDate = (
									SELECT max(tasklistDate) 
									FROM tasklist 
									WHERE userID = ".$_COOKIE['userID']."))
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
	$output.= "<p style='color:white;'> Showing ".sizeof($results)." goals</p>";

	function compare($a, $b){
	    if ($a['points'] == $b['points']) {
	        return 0;
	    }
	    return ($a['points'] < $b['points']) ? 1 : -1;
	}

	usort($results, "compare");

	// $output = "<p style='color:white;'> Showing ".sizeof($results)." goals</p>";

	$output = "";
	foreach ($results as $key => $value) {
		$taskID = $value['taskID'];
		$description = $value['description'];
		$points = $value['points'];
		
		$output .= '<div class="goal" style="background-color: '.$colorsAndPoints[$points].';" onclick="changeAccomplished(this)">';
		if($value["accomplished"]){
			$output .= '<div class="pointCircle checkBg"><div class="points" style="display: none;">'.$points.'p </div></div>';
			$output .= '<div class="tableFix">';
			$output .= '<div class="description accomplished" id="'.$taskID.'" style="color: rgba(255, 255, 255, 0.5);">';
			$output .= $description;
			$output .= '</div>';
			$output .= '</div>';
		}else{
			$output .= '<div class="pointCircle"><div class="points">'.$points.'p </div></div>';
			$output .= '<div class="tableFix">';
			$output .= '<div class="description unaccomplished" id="'.$taskID.'" style="color:#ffffe8;">';
			$output .= $description;
			$output .= '</div>';
			$output.= '</div>';
		}
		$output .= "</div>";
	}
	echo $output;
	
?>