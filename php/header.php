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
<?php
 // session_start();

  if (isset($_SESSION['email'])) {

    echo '<div class="nav navbar-nav navbar-right">';
    echo '<button class="dropdown-toggle" type="button" data-toggle="dropdown">';
    echo '<span class="caret"></span></button>';
    echo '<ul class="dropdown-menu">';
    echo '<li><a href="settings.php">Settings</a></li>';
    echo '<li><a href="notification-center.php">Notification Center</a></li>';
    echo '<li><a href="print-history.php">Post History</a></li>';
    echo '<li><a href="logout.php">Logout</a></li>';
    echo '</ul>';
    echo "</div>";

    echo '<div class="usrlogininfo nav navbar-nav navbar-right">';
    echo "<div>";
    echo $_SESSION["email"];
    echo "</div>";

    echo "</div>";
    echo '<div class="navbarpic nav navbar-nav navbar-right">';
    echo '<img src="../pictures/shuai.jpg">';
    echo '</div>';

    echo '<div class="col-sm-3 col-md-6 pull-left">';
    echo '<form class="navbar-form" role="search" action = "homepage.php">';
    echo '<div class="input-group">';
    echo '<input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">';
    echo '<div class="input-group-btn">';
    echo '<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>';
    echo '</div>';
    echo '</div>';
    echo '</form>';
    echo '</div>';
  }
  else {
    echo '<div class="loginsignup nav navbar-nav navbar-right">';
    echo '<a href="sign-in.php" id="loginbutton" class="btn btn-warning">Login</a>';
    echo '<a href="sign-up.php" class="btn btn-info">Sign Up</a>';
    echo '</div>';
  }
?>
    </div>      
    </div>
  </div>
</nav>