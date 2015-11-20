<!DOCTYPE HTML>
<head>
	<title>Homepage</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
	 <link rel="stylesheet" href="../css/main.css">
	 <link rel="stylesheet" href="../css/profile.css">
	 <script src="js/main.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<style>
	.jumbo_circle {
		width: 150px;
		height: 150px;
		text-align: center;
		line-height:150px;
		border-radius: 50%;
		margin: 150px 30px;
		font-size: 150%;
		display: inline-block;
		color: white;
	}

	#slogan{
		position: absolute;
		left: 100px;
		top: 80px;
		font-size: 500%;
	}

	.center{
		width: 650px;
		margin: auto;
	}

	</style>
</head>

<body>
<?php
	session_start();
	include_once("header.php");
	include_once('sqlfuncs.php');

	if(!isset($_SESSION['email']))
	{
		header('Location: index.php');
		exit;
	}

	$myemail = $_SESSION["email"];

	if (sql_is_verified($myemail, $_SESSION['type'])) {

	} else {
		echo "<h3>Please verify your email</h3>";
		return;
	}
?>

<div class="center">
<a href="refer.php">
<div id="refer" style="background-color: #3333FF;" class="jumbo_circle">
Refer
</div>
</a>

<a href="jobs.php">
<div id="jobs" style="background-color: #006600;" class="jumbo_circle">
Jobs
</div>
</a>

<a href="tutorial.php">
<div id="tutorial" style="background-color: #CC00FF;" class="jumbo_circle">
Tutorial
</div>
</a>
</div>


<?php
	include_once("footer.php");
?>
<script>
	$(document).ready(function(){
		$("#refer").hover(function(){
			$("body").css("background-color", "#3366FF");
			$(".center").before("<h1 style='color:white;' id='slogan'>Find an Insider</h1>");

			}, function(){
			$("#slogan").remove();
			$("body").css("background-color", "white");
		});
		$("#jobs").hover(function(){
			$("body").css("background-color", "#009900");
			$(".center").before("<h1 style='color:white;' id='slogan'>Fullfill Your Dream</h1>");

			}, function(){
			$("#slogan").remove();
			$("body").css("background-color", "white");
		});
		$("#tutorial").hover(function(){
			$("body").css("background-color", "#CC66FF");
			$(".center").before("<h1 style='color:white;' id='slogan'>Learn the Magic</h1>");

			}, function(){
			$("#slogan").remove();
			$("body").css("background-color", "white");
		});
	});
</script>
</body>
</html>