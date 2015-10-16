<!DOCTYPE html>
<html lang="en">
<head>
  <title>CSSA sign in page</title>
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
  <?php include("header.php");?>
  <div class = "container">
    <?php
    //$server = mysql_connect("localhost", "root", "1qaz-pl,"); 
    $server = mysql_connect("cssadbinstance.ccmgeu2ghiy1.us-east-1.rds.amazonaws.com", "cssaadmin", "cssaadmin123"); 
    if (!$server) { 
        print "Error - Could not connect to MySQL"; 
        exit; 
    }
    $db = mysql_select_db("user_student"); 
    if (!$db) { 
        print "Error - Could not select the guest database"; 
        exit; 
    }

    $email = $_POST['email'];
    $type = $_POST['type'];

    setcookie("email",$email);
    setcookie("type",$type);

    
    header('Location: homepage.php');
    ?>
    
    </div>


<?php
  include("footer.php");
?>
</body>
</html>