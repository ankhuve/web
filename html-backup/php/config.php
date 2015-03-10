<?php
	$hostname = 'localhost';
	$username = 'eforsbe';
	$password = 'eforsbe-xmlpub13';
	$database = 'eforsbe';

	$desiredUsername = $_POST['username'];
	$desiredPassword = $_POST['password'];

	$conn = mysqli_connect($hostname, $username, $password, $database);
	
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    };
?>