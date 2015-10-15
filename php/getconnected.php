<!DOCTYPE HTML>
<head>
 <title>Cornell CSSA Jobs site</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
 <link rel="stylesheet" href="http://localhost/cssajobwebsite/css/main.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>

 <style>




  .recmdp {
    margin: 20px;
    border-radius: 50%;
    float: left;
    width: 100px;
    height: 150px;
  }
.center {
     float: none;
     margin-left: auto;
     margin-right: auto;

}

.recmdp img{
  width: 100px;
  height: 100px;
  border-radius: 50%;
}
.text-right button{
  margin-right: 10px;
}

#recmd {
  width: 600px;
}

.recmddescip {
text-align:center;
margin: auto;
display: table;
}

.text{
  width:100px;
  height:100px;
  background:#FFF;
  opacity: 0;
}


.pic:hover .text { opacity:0.6; text-align: justify;  vertical-align: middle;color:#000000  ; font-size:20px; font-weight:700; padding:10px; } 


.pic {
    background: url("../pictures/shuai.jpg");
    background-size: 100px 100px;
    background-repeat: no-repeat;
    border-radius: 50%;
}
 </style>
</head>



<body>
<?php
  include("./header.php");
  //$server = mysql_connect("localhost", "root", "1qaz-pl,"); 
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

  $type = $_POST["type"];
  $email = $_POST["email"];
  $month = $_POST["month"];
  $year = $_POST["year"];

  if($type == "stu"){
    $major = $_POST["major"];
    $job_type = $_POST["job-type"];
    $sql = "UPDATE student SET grad_year=".$year.",major='".$major."',job_type = '".$job_type."' WHERE email='".$email."'";
    $result = mysql_query($sql);
    if(!$result){
      print "Error- Update student table failed";
      $error = mysql_error();
      print "<p>". $error . "</p>";
      exit;   
    }
  }
  else{
    $company = $_POST["company"];
    $Linkedin = $_POST["Linkedin"];
    $sql = "UPDATE employer SET grad_year=".$year.",company='".$company."',Linkedin = '".$Linkedin."' WHERE email='".$email."'";
    $result = mysql_query($sql);
    if(!$result){
      print "Error- Update employer table failed";
      $error = mysql_error();
      print "<p>". $error . "</p>";
      exit;
    }
  }
?>


<form action = "homepage.php" method = "POST">
  <div id="recmd" class="center">
  <div>
    Click to establish the connections...
  </div>

  <div class="recmdp">
  <div class="pic">
    <div class="text">
      Get
      Connect
    </div>
  </div>
  <span class="recmddescip">
    Ab Cd EE
  </span>
  <span class="recmddescip">
    Company
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
    Ab Cd EE
  </span>
  <span class="recmddescip">
    Company
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
    Ab Cd EE
  </span>
  <span class="recmddescip">
    Company
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
    Ab Cd EE
  </span>
  <span class="recmddescip">
    Company
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
    Ab Cd EE
  </span>
  <span class="recmddescip">
    Company
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
    Ab Cd EE
  </span>
  <span class="recmddescip">
    Company
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
    Ab Cd EE
  </span>
  <span class="recmddescip">
    Company
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
    Ab Cd EE
  </span>
  <span class="recmddescip">
    Company
  </span>
  </div>
  

  <div class = "text-right">
  <button type="submit" class="btn btn-default" >Skip</button>
  <button type="submit" class="btn btn-default" >Next -></button>
  </div>
  <div class = "text-right">
  </div>


  </div>
</form>


<?php
  include("./footer.php");
?>
</body>