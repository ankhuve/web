<?php
	$hostname = 'rickard-202881.mysql.binero.se';
	$username = '202881_sq75951';
	$password = 'ErdickProgramming1';
	$database = '202881-rickard';

	$desiredUsername = $_POST['username'];
	$desiredPassword = $_POST['password'];

	$conn = mysqli_connect($hostname, $username, $password, $database);
	
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    };
?>