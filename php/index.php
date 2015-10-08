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
  include("php/header.php");
?>


  <div class="jiang" style="position:fixed;
    width:80px;
    height:80px;
    color: red;
 
    background:red;
    background-image: url(pictures/shuai.jpg);
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

  <div class="container">
    <div class = "col-sm-8">
        <div class = "jumbotron">
            <div class = "row">
                <p>Dear Cornellians,</p>
                <p>Chinese Students and Scholars Association (CSSA) is a voluntary, non-profit organization whose members are students and scholars coming from China. It is the ONLY Chinese student organization officially supported by Embassy of People's Republic of China at Cornell University. Cornell CSSA’s primary mission is to enhance happiness, harmony and unity among members; foster acquaintance and good fellowship through information, activities and mutual assistance; introduce Chinese culture and facilitate international culture exchange; and we also strive for opportunities to spread awareness and appreciation of Chinese arts and culture in an environment that increasingly welcomes our presence.</p>
            </div>
        </div>
    </div>
    <div class = "col-sm-4" >
        <h1 class="text-center">Join us today!</h1>
        <form class = "form-horizontal" role="form">
          <div class="form-group">
            <input type="username" class="form-control input-lg" id="username" placeholder = "Pick a username"> 
          </div>
          <div class="form-group">
            <input type="email" class="form-control input-lg" id="email" placeholder = "Your E-mail">
          </div>
          <div class="form-group">
            <input type="password" class="form-control input-lg" id="pwd" placeholder="Create a password">
          </div>
          <button type="submit" class="btn btn-lg" >Sign Up for CSSA</button>
        </form>
    </div>
  </div>

<?php
  include("php/footer.php");
?>
</body>
