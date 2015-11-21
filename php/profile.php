<!DOCTYPE HTML>
<head>
	<title>Settings</title>
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
  if(!isset($_SESSION['email']))
	{
		header('Location: index.php');
		exit;
	}
  $myemail = $_SESSION["email"];

	if (sql_is_verified($myemail, $_SESSION['type'])) {

	} else {
		echo "<h3>Please verify your email</h3>";
		return;
	}
	echo '<div style="width:700px; margin:auto" class = "container">';
  echo '<h1>Profile Page</h1>';
  $myUid = sql_get_uid_byEmail($myemail);

	if(isset($_GET['uid']))
	{
   	display_profile($_GET['uid']);
    if($_GET['uid'] == $myUid)
    {
      ?>
      <p><a href='settings.php'>Edit your profile</a>
      <?php
    }
	}
  else
  {
    display_profile($myUid);
    ?>
      <p><a href='settings.php'>Edit your profile</a>
    <?php
  }

?>
</div>
<?php
  	include_once("footer.php");
?>

</body>
</html>