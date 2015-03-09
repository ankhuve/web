<?php

	function generateTaskID($conn){
		$countQuery = "SELECT max(id) maxID FROM task;";
	    if (($result = mysqli_query($conn, $countQuery)) === false) {
	       printf("Query failed: %s<br />\n%s", $countQuery, mysqli_error($conn));
	       exit();
	    }
	    $line = $result->fetch_object();
	    $currentMax = $line->maxID;
	    return $currentMax + 1;
	}

	function generateUserID($conn){
		$countQuery = "SELECT max(id) maxID FROM user;";
	    if (($result = mysqli_query($conn, $countQuery)) === false) {
	       printf("Query failed: %s<br />\n%s", $countQuery, mysqli_error($conn));
	       exit();
	    }
	    $line = $result->fetch_object();
	    $currentMax = $line->maxID;
	    return $currentMax + 1;
	}

	function queryDb($conn, $query){
		if (($result = mysqli_query($conn, $query)) === false) {
	       printf("Query failed: %s<br />\n%s", $query, mysqli_error($conn));
	       exit();
	    }
	    return $result;		
	}

	function passwordHash($password){
		$hashedPassword = hash('sha256', 'pillarandstones'.$password);
		return $hashedPassword;
	}

	function login($conn, $username, $password){
		$hashedPassword = passwordHash($password);
		$loginQuery = "SELECT id FROM user WHERE username='".$username."' AND password ='".$hashedPassword."';";
		$result = queryDb($conn, $loginQuery);
		$resultObj = $result->fetch_object();
		$id = $resultObj->id;
		return $id;
	}

?>