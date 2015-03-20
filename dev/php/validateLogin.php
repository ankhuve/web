<?php
	session_start();
	include_once("functions.php");
	include_once("config.php");

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(isset($_POST['login'])){
		$id = login($conn, $username, $password);
		if(!is_null($id)){

			if(isset($_POST['wrongPassword'])){
				unset($_POST['wrongPassword']);
			}

			setcookie("userID", $id, time() + (86400 * 10), "/");
			// setcookie("username", utf8_decode($username), time() + (86400 *  10), "/");

			$getUserTasks = "SELECT count(*) numTasks FROM tasklist JOIN task ON tasklist.taskID= task.id WHERE tasklist.userID =".$id.";";
			$resultObj = queryDb($conn, $getUserTasks);
			$result = $resultObj->fetch_object();
			$numTasks = $result->numTasks;

			if($numTasks<1){
				// The user has no assigned tasks
				Header("Location: ../welcome.php");
			} else {
				// The user has assigned tasks
				Header("Location: ../index.php");
			}
		} else {
			// $_SESSION['wrongPassword'] = true;
			$_POST['wrongPassword'] = true;
			Header("Location: ../login.php");
		}
	} else if (isset($_POST['register'])){

		if(isset($_POST['wrongPassword'])){
			unset($_POST['wrongPassword']);
		}

		$newUserID = generateUserID($conn);

		$hashedPassword = passwordHash($password);
		$newUserQuery = "INSERT INTO user VALUES(".$newUserID.",'".$username."','".$hashedPassword."');";

		queryDb($conn, $newUserQuery);
		
		setcookie("userID", $newUserID, time() + (86400 * 10), "/");
		// setcookie("username", $username, time() + (86400 *  10), "/");
    	// $_SESSION['loggedIn'] = $id;
    	// $_SESSION['username'] = $username;
    	header("Location: ../welcome.php");
	} else {
		echo "WHAT THE FUCK ARE YOU DOING HERE?!";
	}
	
?>
