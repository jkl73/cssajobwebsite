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
  }
  else {
    echo '<div class="loginsignup nav navbar-nav navbar-right">';
    echo '<a href="sign-in.php" id="loginbutton" class="btn btn-warning">Login</a>';
    echo '<a href="sign-up.php" class="btn btn-info">Sign Up</a>';
    echo '</div>';
  }
?>
      <div class="col-sm-3 col-md-6 pull-left">
        <form class="navbar-form" role="search" action = "homepage.php">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
        </form>
        </div>
    </div>      
    </div>
  </div>
</nav>