<?php 
	if(isset($_COOKIE['userID'])){
		Header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0" minimal-ui>
		<meta name="mobile-web-app-capable" content="yes">
		<meta content="yes" name="apple-mobile-web-app-capable">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="apple-touch-icon-precomposed" sizes="192x192" href="img/iconhd_apple.png">
		<title>GRÖN</title>
		<link rel="icon" sizes="192x192" href="img/iconhd.png">
		<link rel="icon" type="image/png" href="img/fav.png">

		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>    
		<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="js/getsize.js"></script>
		<script src="js/main-controller.js"></script>
		<script type="application/javascript" src="js/fastclick.js"></script>
		<script type="text/javascript">
			window.addEventListener('load', function() {
			    FastClick.attach(document.body);
			}, false);
		</script>
	</head>
<body>
	<div class="container fullWidth bgImg">
		<center>
			<div class="wrapper">
				<center>
					<div class="col-xs-12 logoHolder">
						<img class="logo" src="img/logo.png">
					</div>
					<form action="php/validateLogin.php" method="post">
						<div class="col-xs-12 loginForm">
							<input class="userinput" type="username" name="username" placeholder="Username" onchange="loginOrRegister(this.value)">
							<input class="userinput" type="password" name="password" placeholder="*********">
						</div>
					
						<div class="col-xs-12 bottomBar" id="loginOrRegister">
						</div>
						
					</form>
				</center>
			</div>
		</center>
	</div>
</body>
</html>