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
   <link rel="stylesheet" href="../css/main.css">
   <link rel="stylesheet" href="../css/profile.css">
 <script src="js/main.js"></script>
  <style>
  </style>
</head>

<body>
  <?php
    session_start();
    include_once("header.php");
    include_once("sqlfuncs.php");
  ?>
  <div class = "container">
    <?php

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $user_row = sql_get_userInfo_byEmail($email);

    if(count($user_row) == 0) //no such email
    {
      echo "<p>Email Invalid!</p><br>";
      echo "<a href='index.php'>back to login page</a>";
    }
    else if($user_row[0]["password"] != $pwd) //wrong password
    {
      echo "<p>Wrong Password!</p><br>";
      echo "<a href='index.php'>back to login page</a>";
    }
    else
    {
      $_SESSION["email"] = $email;
      echo "<h1 class = 'text-center'>Hello!</h1><br>";
      if($user_row[0]["type"] == 2)
      {
        $_SESSION["type"] = "stu";
        header('Location: three_circles.php');
      }
      else if($user_row[0]["type"] == 1)
      {
        $_SESSION["type"] = "emp";
        header('Location: three_circles.php');
      }
      else if($user_row[0]["type"] == 0)
      {
        $_SESSION["type"] = "admin";
        header('Location: three_circles.php');
      }

    }
    /*$stu_row = sql_get_stuInfo_byEmail($email);
    $emp_row = sql_get_empInfo_byEmail($email);
    

    if (!$stu_row && !$emp_row) {
      echo "<p>Email Invalid!</p><br>";
    } else {
      if($stu_row){
        if($stu_row[0]["password"] == $pwd){
           $_SESSION["email"] = $email;
           $_SESSION["type"] = "stu";

           // setcookie("email", $email);
           // setcookie("type", "stu");
           echo "<h1 class = 'text-center'>Hello!</h1><br>";
           header('Location: homepage.php');
        } else{
           echo "<p>Wrong Password!</p><br>";
        }
      } else {
        if($emp_row[0]["password"] == $pwd) {
           $_SESSION["email"] = $email;
           $_SESSION["type"] = "emp";

           echo "<h1 class = 'text-center'>Hello!</h1><br>";
           header('Location: homepage.php');
        } else{
           echo "<p>Wrong Password!</p><br>";
        }
      }
    }*/
    ?>
    
    </div>


<?php
  include_once("footer.php");
?>
</body>
</html>