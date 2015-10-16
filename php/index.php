<?php
  if (isset($_COOKIE['email'])) {
    header('Location: homepage.php');
  }
?>

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
 <script src="js/main.js"></script>

 <style>
 </style>
</head>

<body>
<?php
  include("./header.php");
?>

<!--
  <div class="jiang" style="position:fixed;
    width:80px;
    height:80px;
    color: red;
 
    background:red;
    background-image: url(../pictures/shuai.jpg);
        background-position: 40% 40%;
    left:10px;
    top:100px;"><a  style="color: red" href ='http://p'>点到我有奖</a></div>

<script>
$(document).ready(function() {
    $('.jiang').hover(
            function () { $('.jiang').css("left", Math.random() * 0.8 *$( window ).height());  $('.jiang').css("top", Math.random() * 0.8 *$( window ).height());   },
            function () {}
            )
} )       
</script>
-->
<div class="fullscreen-bg">
    <video loop muted autoplay poster="img/videoframe.jpg" class="fullscreen-bg__video">
              <source src="//cdnsecakmi.kaltura.com/p/537811/sp/53781100/download/entry_id/0_xlka3d02/flavor/0_oe57fo78" type="video/mp4" />
    </video>
</div>


  <div class="container">

    <div class = "overlay col-sm-6"》
                <p>Dear Cornellians,</p>
                <p>Chinese Students and Scholars Association (CSSA) is a voluntary, non-profit organization whose members are students and scholars coming from China. It is the ONLY Chinese student organization officially supported by Embassy of People's Republic of China at Cornell University. Cornell CSSA’s primary mission is to enhance happiness, harmony and unity among members; foster acquaintance and good fellowship through information, activities and mutual assistance; introduce Chinese culture and facilitate international culture exchange; and we also strive for opportunities to spread awareness and appreciation of Chinese arts and culture in an environment that increasingly welcomes our presence.</p>
    </div>
    <div class = "qicksu col-sm-4" >
        <h1 class="jutoday text-center">Join us today!</h1>
        <form action = "jumpage.php" onSubmit = "return checkSubmit()" method = "POST" class = "form-horizontal" role="form">
          <div class="form-group" >
            <input type="username" class="form-control input-lg" id="username" placeholder = "Pick a username" name="username"> 
          </div>
          <div class="form-group">
            <input type="email" class="form-control input-lg" id="email" placeholder = "Your E-mail" name="email">
          </div>
          <div class="form-group">
            <input type="password" class="form-control input-lg" id="pwd" placeholder="Create a password" name="pwd">
          </div>

          <div class="form-group">
          <select class="form-control" id="sel1" name="alumni">
            <option value = "alu">I am an Alumni</option>
            <option value = "stu">I am an Student</option>
          </select>
        </div>
          <div class="form-group">
          <button type="submit" class="btn btn-lg" >Sign Up for CSSA</button>
          </div>
        </form>
        <p style = "color: red" id="text-alert"></p>
    </div>
  </div>
  <script language="javascript">
     function checkSubmit() {
       var t = document.getElementById("text-alert");
       var p = document.getElementById("email");
       if(p.value == "" || p.value == null) 
       {
        t.innerHTML = "Please input email!";
        return false;
       }
       var patt=/[a-z]+[0-9]+@cornell.edu$/;
         if (!patt.test(p.value)){
          t.innerHTML = "Please input a Cornell Email (exp. netID@cornell.edu)";
          return false;
         }
       p = document.getElementById("pwd");
       if(p.value == "" || p.value == null) 
       {
        t.innerHTML = "Please input password!";
        return false;
       }
       p = document.getElementById("username");
       if(p.value == "" || p.value == null) 
       {
        t.innerHTML = "Please input username!";
        return false;
       }
       return true;
    }
   </script>

<?php
  include("./footer.php");
?>
</body>
