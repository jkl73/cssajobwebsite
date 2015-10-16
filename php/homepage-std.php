<!DOCTYPE HTML>
<head>
	<title>Profile</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
	 <link rel="stylesheet" href="http://localhost/cssajobwebsite/css/main.css">
	 <link rel="stylesheet" href="../css/profile.css">
	 <script src="js/main.js"></script>
  	<style>
  	</style>
</head>

<body>
<?php
  include("header.php");
?>
<div class = "container">
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8">
  	 <ul class="list-group">
<?php
	//$server = mysql_connect("localhost","root","1qaz-pl,");
	$server = mysql_connect("cssadbinstance.ccmgeu2ghiy1.us-east-1.rds.amazonaws.com", "cssaadmin", "cssaadmin123"); 
	if (!$server) { 
		print "Error - Could not connect to MySQL"; 
		exit; 
	}
	$db = mysql_select_db("user_student"); 
	if (!$db) { 
		print "Error - Could not select the user_student database"; 
		exit; 
	}
	if(!isset($_COOKIE['email']))
	{
		header('Location: index.php');
		exit;
	}
	$myemail = $_COOKIE["email"];

	$query = "select company,postid,email,position,visit from post_info;";
	$result = mysql_query($query);
	if(!$result){
		print "Error- Get info from post_info failed";
		$error = mysql_error();
		print "<p>". $error . "</p>";
		//exit;		
	}

	while($row = mysql_fetch_array($result)){
		$num_fields = sizeof($row);
		reset($row); 
		echo "<li class=\"list-group-item\">";
		echo "<span class=\"badge\">".$row["visit"]."</span>";
		echo '<a href="#">'.$row["company"].' information by '.$row["email"].' for position: '.$row["position"].'</a>';
		echo "</li> "; 
	} 
	print "</ul>";
?>
  </div>
  <div class="col-xs-6 col-md-4">
  	<ul class="list-group">
<?php
	$query = 'select name,grad_year,major,job_type from student where email = "'.$myemail.'";';
	$result = mysql_query($query);
	if(!$result){
		print "Error- Get info from student failed";
		$error = mysql_error();
		print "<p>". $error . "</p>";
		exit;		
	}
	$row = mysql_fetch_array($result);
		$num_fields = sizeof($row);
		echo '<li class="list-group-item">Username: '.$row["name"].'</li>';
		echo '<li class="list-group-item">Expected Graduation Year: '.$row["grad_year"].'</li>';
		echo '<li class="list-group-item">Major: '.$row["major"].'</li>';
		echo '<li class="list-group-item">Looking for job\'s type: '.$row["job_type"].'</li>';
	echo "</ul>"
?>
  </div>
</div>
</div>


<?php
  include("footer.php");
?>

</body>
</html>