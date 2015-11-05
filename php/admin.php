<!DOCTYPE HTML>
<head>
	<title>Profile</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
	 <link rel="stylesheet" href="../css/main.css">
	 <link rel="stylesheet" href="../css/profile.css">

	 <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
	 <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
	 <script src="js/main.js"></script>

</head>

<body>

<?php
  session_start();
  include("sqlfuncs.php");
  include("header.php");

  if (isset($_POST["submit"])) {
  	$query = $_POST["content"];
  	$conn = getconn();
  	$result = $conn->query($query);
  	foreach ($result->fetchALL(PDO::FETCH_ASSOC) as $row) {
  		foreach ($row as $key => $value) {
  			echo "[Key: ".$key." value: ".$value."]";
  		}
  		echo "<br>";
  	}
  }
  else
  {
  	echo '<form method=post action=admin.php>';
  	echo '<textarea class="form-control" name=content></textarea>';
  	echo '<input type=submit name="submit" value = submit>';
  	echo '</form>';
  }
  include("footer.php");
?>
</body>
</html>