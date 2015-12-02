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

	body {
		background: url(../pictures/slope.jpg) no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}

	.jumbo_circle:before {
		content:" ";
		width: 150px;
		height: 150px;
		border-radius: 50%;
		display:inline-block;
		z-index: 1;
		position: absolute;
		left: 0px;
		top:0px;

		-webkit-filter: blur(5px);
  		-moz-filter: blur(1px);
  		-o-filter: blur(1px);
  		-ms-filter: blur(1px);
  		filter: blur(5px);
	}
	#jobs:before{
		background-color: #0CABCD;
	}
	#tutorial:before{
		background-color: #8362BD;
	}
	#refer:before{
		background-color: #47C753;
	}

	.jumbo_circle {
		opacity: 0.8;
		z-index: 2;
		text-align: center;
		width: 150px;
		height:150px;
		border-radius: 50%;
		display: inline-block;
		margin: 150px 30px;
		font-size: 220%;
		position: relative;
	}
	.jumbo_circle span{
		position: absolute;
		line-height: 150px;
		z-index:5;
		color:white;
		width: 150px;
		left: 0px;	
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
	if(isset($_POST['submit']))
	{
		  $conn = getconn();

		  $type = $_POST["type"];
		  $email = $_POST["email"];
		  $first_name = $_POST["first_name"];
		  $middle_name = $_POST["middle_name"];
		  $last_name = $_POST["last_name"];
		  $phone = $_POST["phone"];
		  $address = $_POST["address"];
		  $linkedin = $_POST["linkedin"];

		  if ($type == "stu" || $type == "alu") {
		    $major = $_POST["major"];
		  	$month = $_POST["month"];
		  	$year = $_POST["year"];

		    $sql = "UPDATE student SET grad_year=\"".$year."-".$month."-"."00\",major='".$major."',first_name='".$first_name."',middle_name='".$middle_name."',last_name='".$last_name.
		    "',phone_number='".$phone."',address='".$address."',Linkedin='".$linkedin." WHERE email='".$email."'";
		    
		    $stmt = $conn->prepare($sql);
		    $result = $stmt->execute();
		    if(!$result){
		      pdo_die($stmt);  
		    }
		  }
		  else if ($type == "emp") {
		    $position = $_POST["position"];
		    $company = $_POST["company"];

		    $sql = "UPDATE student SET company='".$company."',position='".$position.",'first_name='".$first_name."',middle_name='".$middle_name."',last_name='".$last_name.
		    "',phone_number='".$phone."',address='".$address."',Linkedin='".$linkedin." WHERE email='".$email."'";

		    $stmt = $conn->prepare($sql);
		    $result = $stmt->execute();
		    if(!$result){
		      pdo_die($stmt);  
		    }
		  } else echo "user_type error";

	}
?>

<div class="center">

<a href="homepage.php?module=refer">
<div id="refer"  class="jumbo_circle">
	<span>Refer</span>
</div>
</a>

<a href="homepage.php?module=job">
<div id="jobs" class="jumbo_circle">
	<span>Jobs</span>
</div>
</a>

<a href="tutorial.php">
<div id="tutorial" class="jumbo_circle">
	<span>Tutorial</span>
</div>
</a>
</div>


<?php
	include_once("footer.php");
?>
<script>
	$(document).ready(function(){
		$("#refer").hover(function(){
			$(".center").before("<h1 style='color:black;' id='slogan'>Find an Insider</h1>");

			}, function(){
			$("#slogan").remove();
		});
		$("#jobs").hover(function(){
			$(".center").before("<h1 style='color:black;' id='slogan'>Fullfill Your Dream</h1>");

			}, function(){
			$("#slogan").remove();
		});
		$("#tutorial").hover(function(){
			$(".center").before("<h1 style='color:black;' id='slogan'>Learn the Magic</h1>");

			}, function(){
			$("#slogan").remove();
		});
	});
</script>
</body>
</html>