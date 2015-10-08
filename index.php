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





<?php
  include("php/footer.php");
?>
</body>
