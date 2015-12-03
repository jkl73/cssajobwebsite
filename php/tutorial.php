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
	.tutorial_p {
		/*height: 68px;
*/		line-height:20px; /* Height / no. of lines to display */
		overflow:hidden;
	}
	</style>

	<script>

	

	function changeHeight(id) {
		
		if ($('#' + id).css('height') == '29px') {
			$('#'+id).animate({height: '100%'});
		} else {
			$('#'+id).animate({height: '29px'});
		}




// $height = $('div').height();






	}

	</script>



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

	if (admin_byEmail($_SESSION["email"]) == true && isset($_POST["submit"])) {


		if ($_POST["submit"] == 'delete') {
			if (delete_tutorial($_POST['id'])){
				echo "delete success<br>";
			}
		} else {
			$tutorial_id = sql_add_tutoial($_POST["title"], $_SESSION["email"], $_POST["description"]);

			if($_FILES["file"]["error"] > 0){
				echo "Error:" . $_FILES["file"]["error"] ."</br/>";
			}
			else{
				$filename = (string)$tutorial_id  . "-" .(string)$_FILES["file"]["name"];
				$path = "../upload-file/tutorial/". $filename;  				
				move_uploaded_file($_FILES["file"]["tmp_name"], $path);
				update_tutorial($tutorial_id, $path, $_FILES["file"]["name"]);	
			}
		}
	}
?>

<div class="container">

<div class="row">

	<ul>
	<li style='list-style-type: none;'>
		<h1 style='width: 70%; margin: auto; list-style-type: none;'>Tutorials</h1>
		<h5 style='width: 70%; margin: auto; list-style-type: none;'>(Click the Description box to show more)</h5>
	</li>
<?php
	$alltutorial = sql_get_all_tutorial();

	foreach ($alltutorial as $entry) {
		echo "<li style='list-style-type: none;'>";
		echo "<div style='width: 70%; margin: auto; margin-bottom: 8px; border-top: 1px black solid'>";
		echo '<h3>'.$entry['name'].'</h3>';

		echo "<h6>Upload time: ".$entry['time']."</h6>";
		// echo '<p id='.$entry['id'].' onclick=changeDisplay('. $entry['id'] .') class="tutorial_p" style="background-color: rgba(255, 208, 208, 0.47); border-radius: 5px; padding: 5px 8px 5px 8px">'.'<b>Description:</b><br>'.$entry['descriptions'];
		echo '<p onclick="changeHeight('.$entry['id'].')" id='.$entry['id'].' class="tutorial_p" style="height: 29px; background-color: rgba(255, 208, 208, 0.47); border-radius: 5px; padding: 5px 8px 5px 8px">'.'<b>Description:</b>&nbsp;'.$entry['descriptions'];
		echo '</p>';

		if ($entry['filename'] != NULL) {
			echo '<a target=something href='.'../upload-file/tutorial/'.$entry['id'].'-'.rawurlencode($entry["filename"]).'>'.'View Document'.'</a>';
		}

		echo "&nbsp";

		if (admin_byEmail($_SESSION["email"]) == true) {
			echo '<form action="tutorial.php" method="post">';
			echo '<input type=hidden name=id value='.$entry['id'].'>';
			echo '<input type=submit name=submit value=delete>';
			echo '</form>';
		}

		echo "</div>";
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
		echo "<textarea class='form-control' type=text name=description></textarea>";
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
<script> 


function changeDisplay(id)
{
	if ($('#'+id).css('height') == '68px') {
		$('#'+id).animate({ height: "100%"});
	} else {
		$('#'+id).animate({ height: "68px"});
	}
}

</script>
</html>