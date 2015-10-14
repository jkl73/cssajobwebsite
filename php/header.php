<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Cornell CSSA Jobs Link</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
 <!--       <li class="active"><a href="#">Home</a></li>
        <li><a href="#">oooo</a></li>
        <li><a href="#">9999</a></li> 
        <li><a href="#">About</a></li>
-->
      </ul>
    </div>      

<?php
  setcookie("last_visit", time());

  if (isset($_COOKIE['logininfo'])) {
    echo '<div class="usrlogininfo nav navbar-nav navbar-right">';
    echo "<div>Welcome Student</div>";
    echo "</div>";
    echo '<div class="navbarpic nav navbar-nav navbar-right">';
    echo '<img src="../pictures/shuai.jpg">';
    echo "</div>";
  }
  else {
    echo '<div class="loginsignup nav navbar-nav navbar-right">';
    echo '<a href="sign-in.php" class="btn btn-warning">Login</a>';
    echo '<a href="sign-up.php" class="btn btn-info">Sign Up</a>';
    echo '</div>';
  }
?>
    </div>
  </div>
</nav>