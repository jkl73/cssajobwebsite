<!DOCTYPE HTML>
<head>
	<title>Homepage</title>
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

	// if (sql_is_verified($myemail, $_SESSION['type'])) {

	// } else {
	// 	echo "<h3>Please verify your email</h3>";
	// 	return;
	// }

	if (isset($_POST["submit"])) {

		$tutorial_id = sql_add_tutoial($_POST["title"], $_SESSION["email"]);

		if($_FILES["file"]["error"] > 0){
			echo "Error:" . $_FILES["file"]["error"] ."</br/>";
		}
		else{
			$filename = (string)$tutorial_id  . "-" .(string)$_FILES["file"]["name"];
			$path = "../upload-file/tutorial/". $filename;  				
			move_uploaded_file($_FILES["file"]["tmp_name"], $path);
			update_tutorial($tutorial_id, $path, $filename);	
		}
	}
?>

<div class="container">

<div class="row">
	<h1>Tutorial</h1>


	<ul>
<?php
	$alltutorial = sql_get_all_tutorial();

	foreach ($alltutorial as $entry) {
		echo "<li>";
		echo '<h5>'.$entry['name'].'<br>';

		echo '<p>'.$entry['descriptions'].'</p>';
		if ($entry['filename'] != NULL) {
			echo '<a target=something href='.'../upload-file/tutorial/'.rawurlencode($entry['filename']).'>'.'View Attachment'.'</a>';
		}

		echo "&nbsp";
		echo "<br>Upload time: ";
		echo $entry['time'];
		echo "</h5>";

		echo "</li>";
	}
?>
	</ul>

</div>

<?php
	if (admin_byEmail($_SESSION["email"]) == true) {
		echo "<h3>Add New tutorial</h3>";
		echo "<form enctype = multipart/form-data method=post action=tutorial.php>";

		echo "Tutorial title : ";
		echo "<input class='form-control' type=text name='title'>";
		echo "<input type=hidden name='' value=''>";

		echo "Short Descriptions: ";
		echo "<textarea class='form-control' type=text name='Descriptions'></textarea>";
		echo "<input type=hidden name='' value=''>";

		echo "<lable for = 'file'> File Upload: </lable>";
		echo "<input name='file' type='file' class='form-control'>";

		echo "<input type=submit name=submit value=submit>";
		echo "</form>";
	}	
?>
</div>
</div>
<?php
  	include_once("footer.php");
?>

</body>
</html>