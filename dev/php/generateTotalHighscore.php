<?php
	include_once("config.php");
	include_once("functions.php");
	$totalHighscoreQuery = "SELECT IFNULL(accomplishedPts-(possiblePts-accomplishedPts), -possiblePts) totalPoints, user.username username
FROM (
    SELECT SUM(points) possiblePts, tasklist.userID userID
    FROM tasklist
    JOIN task ON taskID = id
    AND tasklistDate <= CURDATE() 
    GROUP BY userID) POSSIBLEPOINTS
LEFT JOIN 
    (SELECT SUM( points ) accomplishedPts, userID
    FROM accomplished
    JOIN task ON accomplished.taskID = task.id
    GROUP BY userID) ACCOMPLISHEDPOINTS
ON POSSIBLEPOINTS.userID = ACCOMPLISHEDPOINTS.userID 
JOIN user ON POSSIBLEPOINTS.userID = user.id
ORDER BY totalPoints DESC";
	// $totalHighscoreQuery = "SELECT username, sum(points) totalPoints, user.id userID  FROM accomplished JOIN user ON accomplished.userID = user.id JOIN task ON accomplished.taskID = task.id GROUP BY username ORDER BY totalPoints DESC;";
	$resultObj = queryDb($conn, $totalHighscoreQuery);
	// echo '<div class="row">';
	// echo '<div class="col-xs-7 col-xs-offset-1"><h4><strong>Namn</strong></h4></div>';
	// echo '<div class="col-xs-3 centered"><h4><strong>Poäng</strong></h4></div>';
	$pos = 1;
	$colorsAndPosition = array(1=>'#64bb50', 2=>'#55a244', 3=>'#4a8d3c', 4=>'#3f7833', 5=>'#36652b');
	while($line = $resultObj->fetch_object()){
		echo '<div class="goal" style="background-color: '.$colorsAndPosition[$pos].';">';
		$username = $line->username;
		$totalPoints = $line->totalPoints;
		$userID = $line->userID;
		if($userID == $_COOKIE['userID'] && $pos<=5){
			echo '<div class="pointCircle"><div class="points">'.$totalPoints.'p</div></div>';
			echo '<div class="tableFix"><div class="positionCircle"><div class="position">'.$pos.'</div></div></div>';
			echo '<div class="tableFix"><div class="description">Du</div></div>';
		} else {
			if($pos<=5){
				echo '<div class="pointCircle"><div class="points">'.$totalPoints.'p</div></div>';
				echo '<div class="tableFix"><div class="positionCircle"><div class="position">'.$pos.'</div></div></div>';
				echo '<div class="tableFix"><div class="description">'.$username.'</div></div>';
			}
		}
		echo '</div>';
		$pos++;
	}
	// echo "</div>";
?>