<!DOCTYPE html>
<html lang="en">
<head>
  <title>Logout</title>
  <meta http-equiv="refresh" content="1; URL=index.php" charset="utf-8">
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
You will be redirected in 1 second...

<?php
  session_start();
  session_destroy();

  // if (isset($_COOKIE['email'])) {
  // 	unset($_COOKIE['email']);
  //   // empty value and expiration one hour before
  //   $res = setcookie('email', '', time() - 3600);
  // }
  // if (isset($_COOKIE['type'])) {
  // 	unset($_COOKIE['type']);
  //   // empty value and expiration one hour before
  //   $res = setcookie('type', '', time() - 3600);
  // }
?>

</body>