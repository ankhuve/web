<?php 
	session_start();
	include_once("php/config.php");
	include("php/functions.php");

    $desiredUsername = $_POST['username'];
	$desiredPassword = $_POST['password'];

    $countQuery = 'SELECT count(*) numberOfUsers FROM user WHERE username="'.$desiredUsername.'" GROUP BY id;';
    $result = queryDb($conn, $countQuery);

    while($line = $result->fetch_object()){
		$numberOfUsers = $line->numberOfUsers;
	};
	mysqli_free_result($result);

	if($numberOfUsers>=1){
		$_SESSION['usernameAvailable'] = "not available";
		echo $_SESSION['usernameAvailable'];
		header("Location: newUser.php");

	} else {

		$_SESSION['usernameAvailable'] = "available";
		$newUserID = generateUserID($conn);

		$hashedPassword = passwordHash($desiredPassword);
		$newUserQuery = "INSERT INTO user VALUES(".$newUserID.",'".$desiredUsername."','".$hashedPassword."');";

		$result = queryDb($conn, $newUserQuery);

    	$_SESSION['loggedIn'] = $newUserID;
    	$_SESSION['username'] = $desiredUsername;
    	header("Location: setup.php");
	}
	
?>
