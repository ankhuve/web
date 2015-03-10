<?php
	session_start();
	include_once("functions.php");
	include_once("config.php");

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(isset($_POST['login'])){
		$id = login($conn, $username, $password);
		if(!is_null($id)){

			if(isset($_SESSION['wrongPassword'])){
				unset($_SESSION['wrongPassword']);
			}

			$_SESSION['loggedIn'] = $id;
			$_SESSION['username'] = $username;

			$getUserTasks = "SELECT count(*) numTasks FROM tasklist JOIN task ON tasklist.taskID= task.id WHERE tasklist.userID =".$id.";";
			$resultObj = queryDb($conn, $getUserTasks);
			$result = $resultObj->fetch_object();
			$numTasks = $result->numTasks;

			if($numTasks<1){
				// The user has no assigned tasks
				Header("Location: ../setup.php");
			} else {
				// The user has assigned tasks
				Header("Location: ../index.php");
			}
		} else {
			$_SESSION['wrongPassword'] = true;
			Header("Location: ../login.php");
		}
	} else if (isset($_POST['register'])){

		if(isset($_SESSION['wrongPassword'])){
			unset($_SESSION['wrongPassword']);
		}

		$newUserID = generateUserID($conn);

		$hashedPassword = passwordHash($password);
		$newUserQuery = "INSERT INTO user VALUES(".$newUserID.",'".$username."','".$hashedPassword."');";

		queryDb($conn, $newUserQuery);

    	$_SESSION['loggedIn'] = $id;
    	$_SESSION['username'] = $username;
    	header("Location: ../setup.php");
	} else {
		echo "WHAT THE FUCK ARE YOU DOING HERE?!";
	}
	
?>
