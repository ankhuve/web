<?php
	session_start();
	include_once("config.php");
	include_once("functions.php");

	if(!empty($_POST['taskID'])){

		$loggedIn = $_SESSION['loggedIn'];
		$valueString = "";
		$nChosen = sizeof($_POST['taskID']);
		$taskIDs = $_POST['taskID'];
		for($i = 0; $i<$nChosen-1; $i++){
			$valueString .= "(".$loggedIn.",".$taskIDs[$i]."),";
		}
		$valueString .= "(".$loggedIn.",".$taskIDs[$nChosen-1].")";

		$tasklistQuery = "INSERT INTO tasklist VALUES ".$valueString.";";
		queryDb($conn, $tasklistQuery);
		Header("Location: ../index.php");
	} else {
		$message = "No chosen tasks, you will be redirected to the first setup page.";
		echo "<script type='text/javascript'>alert('$message');</script>";
		Header("Location: ../setup.php");

	}

?>