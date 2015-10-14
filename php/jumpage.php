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
	<?php
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

	$type = $_POST["alumni"];
	$name = $_POST["username"];
	$email = $_POST["email"];
	$pwd = $_POST["pwd"];

	$query = "select * from employer E,student S where S.email ='". $email. "' || E.email ='". $email. "';";
	$result = mysql_query($query);
	if(!$result){
		print "Error- Judge failed";
		$error = mysql_error();
		print "<p>". $error . "</p>";
		exit;		
	}

	$row = mysql_fetch_array($result);
	if($row){
		print "Email used";
		exit;
	}

	if($type == 'alu'){
			$query = "INSERT INTO employer(name, email, password) VALUES('".$name."','".$email. "','".$pwd."')";
	}
	else if($type == 'stu'){
			$query = "INSERT INTO student(name, email, password) VALUES('".$name."','".$email. "','".$pwd."')";
	}

	$query = stripslashes($query);
	$result = mysql_query($query);
	if(!$result){
		print "Error- Inserting into student/employer failed";
		$error = mysql_error();
		print "<p>". $error . "</p>";
		exit;		
	}

	if ($type == 'alu'){
		include("alup.php");
	}
	else{
		include("stup.php");
	}
	/*
	$query = "select * from user_info";
	$result = mysql_query($query);
	print "<table border = 1><caption> <h2> All User Info </h2> </caption>"; 
	print "<tr align = 'center'>";


	print "<tr align = 'center'><th>email</th><th>username</th><th>password</th></tr>";
	while($row = mysql_fetch_array($result)){
		$num_fields = sizeof($row);
		reset($row); 
		print "<tr align = 'center'>"; 
		for ($field_num = 0; $field_num < $num_fields/2 ; $field_num++) 
			print "<td>" . $row[$field_num] . "</td> "; 
		print "</tr>"; 
	} 
	print "</table>";*/
	?>




<?php
  include("footer.php");
?>

</body>
</html>