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
$db = mysql_connect("localhost", "root", "1qaz-pl,"); 
if (!$db) { 
	print "Error - Could not connect to MySQL"; 
	exit; 
}
$er = mysql_select_db("user_student"); 
if (!$er) { 
	print "Error - Could not select the guest database"; 
	exit; 
}
$alumni = $_POST["alumni"];
$username = $_POST["username"];
$email = $_POST["email"];
$pwd = $_POST["pwd"];

echo $alumni. $username . $email. $pwd;

$sql = "CREATE TABLE user_info (
email VARCHAR(30) NOT NULL,
username VARCHAR(20),
pwd VARCHAR(18)
)";
if (mysql_query($sql) == TRUE){
	echo "Create Table Sucessfully! <br>";
} else{
	echo "Error creating table: <br>";
}


$query = "INSERT INTO user_info(email, username, pwd)  VALUES('". $email."','".$username. "','". $pwd."')";
$query = stripslashes($query);
if ($result = mysql_query($query) == TRUE){
	echo "INSERT Sucessfully!";
	echo "<br>";
}

if ($alumni == 'alu'){
	include("alup.php");
}
else
{
	include("stup.php");
}

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
print "</table>";
?>




<?php
  include("footer.php");
?>

</body>
</html>