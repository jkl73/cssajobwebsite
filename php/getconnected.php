<!DOCTYPE HTML>
<head>
 <title>Cornell CSSA Jobs site</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
 <link rel="stylesheet" href="../css/main.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
 <style>
 </style>
</head>

<body>
<?php
  session_start();
  include("./header.php");
  include("sqlfuncs.php");
  //$server = mysql_connect("localhost", "root", "1qaz-pl,"); 
  $conn = getconn();

  $type = $_POST["type"];
  $email = $_POST["email"];
  $month = $_POST["month"];
  $year = $_POST["year"];


  if($type == "stu"){
    $major = $_POST["major"];
    $job_type = $_POST["job-type"];


    $sql = "UPDATE student SET grad_year=\"".$year."-".$month."-"."00\",major='".$major."',job_type = '".$job_type."' WHERE email='".$email."'";
    
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    if(!$result){
      pdo_die($stmt);  
    }
  }
  else{
    $position = $_POST["position"];
    $company = $_POST["company"];
    $Linkedin = $_POST["Linkedin"];
    $sql = " UPDATE employer SET grad_year=\"".$year."-".$month."-"."00\",company='".$company."',Linkedin = '".$Linkedin."',position ='". $position ."' WHERE email='".$email."' ";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    if(!$result){
      pdo_die($stmt);  
    }
  }
?>


<form action = "update-connect-info.php" method = "POST">
  <div id="recmd" class="center">
  <div>
    see some connections you may have...
  </div>

  <div class="recmdp">
  <div class="pic">
    <div class="text">
      Get
      Connect
    </div>
  </div>
  <span class="recmddescip">
    Mike
  </span>
  <span class="recmddescip">
    google
  </span>
  </div>

  <div class="recmdp">
  <div class="pic">
    <div class="text">
      Get
      Connect!
    </div>
  </div>
  <span class="recmddescip">
    Shi
  </span>
  <span class="recmddescip">
    Microsoft
  </span>
  </div>
    <div class="recmdp">
  <div class="pic">
    <div class="text">
      Get
      Connect!
    </div>
  </div>
  <span class="recmddescip">
    Yi
  </span>
  <span class="recmddescip">
    Oracle
  </span>
  </div>
    <div class="recmdp">
  <div class="pic">
    <div class="text">
      Get
      Connect!
    </div>
  </div>
  <span class="recmddescip">
    Fan
  </span>
  <span class="recmddescip">
    Yelp
  </span>
  </div>
    <div class="recmdp">
  <div class="pic">
    <div class="text">
      Get
      Connect!
    </div>
  </div>
  <span class="recmddescip">
    Chen
  </span>
  <span class="recmddescip">
    Uber
  </span>
  </div>
    <div class="recmdp">
  <div class="pic">
    <div class="text">
      Get
      Connect!
    </div>
  </div>
  <span class="recmddescip">
    Charles
  </span>
  <span class="recmddescip">
    Facebook
  </span>
  </div>
    <div class="recmdp">
  <div class="pic">
    <div class="text">
      Get
      Connect!
    </div>
  </div>
  <span class="recmddescip">
    Luke
  </span>
  <span class="recmddescip">
    IBM
  </span>
  </div>
    <div class="recmdp">
  <div class="pic">
    <div class="text">
      Get
      Connect!
    </div>
  </div>
  <span class="recmddescip">
    Wang
  </span>
  <span class="recmddescip">
    Intel
  </span>
  </div>
  

  <div class = "text-right">
  <button type="submit" class="btn btn-default" >Skip</button>
  <button type="submit" class="btn btn-default" >Next -></button>
  </div>
  <div class = "text-right">
  </div>


  </div>
  <input type = "hidden" name = "email" value = <?php echo '"'.$email.'"'; ?>>
  <input type = "hidden" name = "type" value = <?php echo '"'.$type.'"'; ?>>
</form>


<?php
  include("./footer.php");
?>
</body>