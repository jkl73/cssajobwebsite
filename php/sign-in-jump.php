<!DOCTYPE html>
<html lang="en">
<head>
  <title>CSSA sign in page</title>
  <meta http-equiv="refresh" content="10; URL=index.php" charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
 <link rel="stylesheet" href="http://localhost/cssajobwebsite/css/main.css">
 <script src="js/main.js"></script>
  <style>
  </style>
</head>

<body>
<?php
include("header.php");
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

$email = $_POST['email'];
$pwd = $_POST['pwd'];


$query = "select S.username, S.pwd from user_info S where S.email ='". $email."';";
$result = mysql_query($query);

$row = mysql_fetch_array($result);
reset($row);
echo "<div class=\"container\">";
if($row[1] == $pwd){
    echo "<p>Hello ".$row[0]."!</p><br>";
}else{
    echo "<p>Wrong password!</p><br>";
}
?>
<p>Pages will redirect automatically after 10 seconds</p>
</div>


<?php
  include("footer.php");
?>
</body>
</html>