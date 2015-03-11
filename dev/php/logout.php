<?php
	session_start();
	session_unset();
	setcookie("userID", "dummy", time() - (86400 * 10), "/");
	setcookie("username", "dummy", time() - (86400 *  10), "/");
	// setcookie("clicked", "dummy", time() - (86400 * 10), "/");
	header("Location: ../login.php");
?>