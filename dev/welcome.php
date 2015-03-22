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
		<!-- Bootstrap CSS -->
		<!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>    
		<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="js/dragend.js"></script>
		<script src="js/getsize.js"></script>
		<script src="js/shiftInstructions.js"></script>
		<script type="application/javascript" src="js/fastclick.js"></script>
		<script src="js/main-controller.js"></script>
		<script src="js/mainPageFunctions.js"></script>
		<script type="text/javascript">
			window.addEventListener('load', function() {
			    FastClick.attach(document.body);
			}, false);
		</script>
	</head>
<body>
	<div class="container fullWidth bgImg">
		<center>
			<div class="topHalfWrapper">
				<h1 id="welcomeText">Hej och välkommen till GRÖN!</h1>
			</div>
			<div id="welcomeDivider"></div>
			<div class="bottomWrapper">
				<div class="dragend-page" data-role="welcomeInstruction" id="1">
					<h2 class="welcomeInstructions">Här kan du välja eller skapa några intressanta miljövänliga mål som du vill ha uppnått innan veckan är slut.</h2>
					<div class="navArrows">
						<div class="next">
							<img class="arrow" src="img/arrow.png">
						</div>
					</div>
				</div>
				<div class="dragend-page" data-role="welcomeInstruction" id="2">
					<h2 class="welcomeInstructions">Målen du väljer ska på något sätt minska ditt ekologiska fotavtryck.</h2>
					<div class="navArrows">
						<div class="prev">
							<img class="arrow" src="img/prev_arrow.png">
						</div>
						<div class="next">
							<img class="arrow" src="img/arrow.png">
						</div>
					</div>
				</div>
				<div class="dragend-page" data-role="welcomeInstruction" id="3">
					<h2 class="welcomeInstructions">Det kan vara saker du vill göra, eller saker du redan gör för att förbättra miljön.</h2>
					<div class="navArrows">
						<div class="prev">
							<img class="arrow" src="img/prev_arrow.png">
						</div>
						<div class="next">
							<a href="goals.php">
								<p class="nextText">Gå vidare</p>
							</a>
						</div>
					</div>
				</div>
			</div>
		</center>
	</div>
</body>