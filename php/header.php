<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="three_circles.php">Cornell CSSA Jobs Link</a>
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
  include_once("./sqlfuncs.php");
  if (isset($_SESSION['email'])) {

    echo '<div class="nav navbar-nav navbar-right">';
    

    echo '<a class="dropdown-toggle" type="button" data-toggle="dropdown">';
    echo $_SESSION["email"];

    echo '&nbsp<span class="caret"></span></a>';


    echo '<ul class="dropdown-menu">';
    echo '<li><a href="settings.php">Preferences Setting</a></li>';
    echo '<li><a href="setpwd.php">Set Password</a></li>';

    echo '<li class="divider"></li>';

    echo '<li><a href="print-history.php">My Post History</a></li>';
    echo '<li><a href="myfavourate.php">My Favourite</a></li>';
    echo '<li><a href="notification-center.php">Notification Center</a></li>';

    echo '<li class="divider"></li>';

    echo '<li><a href="logout.php">Logout</a></li>';
    echo '</ul>';
    echo "</div>";

    echo '<div class="usrlogininfo nav navbar-nav navbar-right">';
    echo "<div>";
    echo "</div>";

    echo "</div>";
    echo '<div class="navbarpic nav navbar-nav navbar-right">';

    $conn = getconn();
    $stmt = $conn->prepare("select count(*) as num from notification where replyedemail='".$_SESSION['email']."' and readtag=0");
    $result = $stmt->execute();
    if (!$result)
        pdo_die($stmt);
    $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $cnt = $rset[0]["num"];
    if ($cnt > 0) {
      echo '<a id="notficenter" href="notification-center.php" class="glyphicon hasNotify glyphicon-envelope"></a>';
      echo '<ul class="dropdown">';
      echo '<li><a href="notification-center.php">Notification Center<span class="badge" style="float:right">'.$cnt.'</span></a></li>';  
      echo '</ul>';
    }
    else {
      echo '<a id="notficenter" href="notification-center.php" class="glyphicon glyphicon-envelope"></a>';
      echo '<ul class="dropdown">';
      echo '<li><a href="notification-center.php">Notification Center</a></li>';
      echo '</ul>';
    }

    echo '</div>';

    echo '<div class="col-sm-6 col-md-6 pull-left">';
    echo '<form class="navbar-form" role="search" action = "homepage.php">';
    echo '<div class="input-group">';
    echo '<input type="text" class="form-control" placeholder="Search Company, or other keywords here..." name="srch-term" id="srch-term">';
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