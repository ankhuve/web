<?php
	session_start();
	include("functions.php");
	include_once("config.php");

	$loggedInUser = $_SESSION['loggedIn'];

	$selectQuery = "SELECT * FROM task WHERE addedBy =".$loggedInUser.";";
	$result = queryDb($conn, $selectQuery);

    while($line = $result->fetch_object()){
		$description = $line->description;
		$points = $line->points;
		$taskID = $line->id;
		echo "<div class='row'>";
		echo "<div class='col-xs-9'>";
		echo "<input type='checkbox' name='customTaskID[]' value='".$taskID."' checked='checked'>";
		echo $description;
		echo "</div>";
		echo "<div class='col-xs-3'>";
		echo $points;
		echo "</div>";
		echo "</div>";
	};

?>