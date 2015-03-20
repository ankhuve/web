<?php 
	include_once("config.php");
	include_once("functions.php");
	$usernameQuery = "SELECT username FROM user WHERE id=".$_COOKIE['userID'].";";
	echo queryDb($conn, $usernameQuery)->fetch_object()->username;
?>