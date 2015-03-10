<?php
	session_start();
	include_once("functions.php");
	include_once("config.php");

	$username = $_POST['username'];
	$password = $_POST['password'];
	$id = login($conn, $username, $password);
	if(is_null($id)){
		$_SESSION['invalidUser'] = "invalid";
		header("Location: ../login.php");
	} else {
		$usernameQuery = "SELECT username FROM user WHERE id='".$id."';";
		$result = queryDb($conn, $usernameQuery);
		$resultObj = $result->fetch_object();
		$username = $resultObj->username;
		$_SESSION['invalidUser'] = "valid";
		$_SESSION['loggedIn'] = $id;
		$_SESSION['username'] = $username;
		header("Location: ../index.php");
	}
?>