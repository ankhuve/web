<?php
	session_start();
	include_once("config.php");
	include_once("functions.php");
	$totalHighscoreQuery = "SELECT username, sum(points) totalPoints, user.id userID  FROM accomplished JOIN user ON accomplished.userID = user.id JOIN task ON accomplished.taskID = task.id GROUP BY username ORDER BY totalPoints DESC;";
	$resultObj = queryDb($conn, $totalHighscoreQuery);
	echo '<div class="row">';
	echo '<div class="col-xs-7 col-xs-offset-1"><h4><strong>Namn</strong></h4></div>';
	echo '<div class="col-xs-3 centered"><h4><strong>Poäng</strong></h4></div>';
	while($line = $resultObj->fetch_object()){
		echo '<div class="row">';
		$username = $line->username;
		$totalPoints = $line->totalPoints;
		$userID = $line->userID;
		if($userID == $_SESSION['loggedIn']){
			echo '<div class="col-xs-7 col-xs-offset-1"><strong> Du </strong></div>';
			echo '<div class="col-xs-3 centered"><strong>'.$totalPoints.'</strong></div>';
			// echo "<p> DU - ".$totalPoints."</p>";
		} else {
			echo '<div class="col-xs-7 col-xs-offset-1">'.$username.'</strong></div>';
			echo '<div class="col-xs-3 centered">'.$totalPoints.'</div>';
		}
		echo '</div>';
	}
	echo "</div>";
?>