<?php
	session_start();
	include("functions.php");
	include_once("config.php");
	// echo $_POST['userInput'];

	$newTaskID = generateTaskID($conn);
	// echo "New task ID: ".$newTaskID;
	$newTaskDescription = $_POST['userInput'];
	$loggedInUser = $_SESSION['loggedIn'];

	$insertQuery = "INSERT INTO task VALUES(".$newTaskID.",'".$newTaskDescription."',10,".$loggedInUser.");";
	queryDb($conn, $insertQuery);
	echo $newTaskID;
	echo $newTaskDescription;
?>