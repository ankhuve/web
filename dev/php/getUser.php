<?php
	$q = $_GET['q'];

	include("config.php");
	include("functions.php");

	$getUserQuery = "SELECT count(*) numUsers FROM user WHERE username='".$q."';";
	$resultObj = queryDb($conn, $getUserQuery);
	$result = $resultObj->fetch_object();
	$numUsers = $result->numUsers;

	if($numUsers<1){
		echo '
		<div class="col-xs-6 col-xs-offset-3 bottomLink" id="register">
			<center><input type="submit" name="register" class="loginRegister" value="Registrera"></center>
		</div>;';
	} else {
		echo '
		<div class="col-xs-6 col-xs-offset-3 bottomLink" id="login">
			<center><input type="submit" name="login" class="loginRegister" value="Logga in"></center>
		</div>';
	}
?>