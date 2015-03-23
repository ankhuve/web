<?php
	setcookie("userID", "dummy", time() - (86400 * 10), "/");
	setcookie("username", "dummy", time() - (86400 *  10), "/");
	setcookie("clicked", "dummy", time() - (86400 * 10), "/");
	// echo "smuts";
	header("Location: ../login.php");
?>