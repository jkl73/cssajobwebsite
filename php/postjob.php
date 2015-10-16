<!DOCTYPE HTML>
<head>
	<title>Profile</title>
	<meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
	 <link rel="stylesheet" href="http://localhost/cssajobwebsite/css/main.css">
	 <link rel="stylesheet" href="../css/profile.css">

	 <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
	 <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
	 <script src="js/main.js"></script>


  	<style>
  	</style>

</head>

<body>

<?php
  session_start();
  include("sqlfuncs.php");
  include("header.php");

  if (!isset($_POST["mode"])) {
  	write_add_new_page();
  }
  else {
    $mode = $_POST["mode"];

  	if ($mode == "add") {
		if (sql_add_post($_POST["email"], $_POST["company_name"], $_POST["position"], $_POST["description"], $_POST["job_content"]) == 1) {
			echo "<h2 align=center>Your job posting is successful</h2>";
			echo "<h3 align=center><a  href='homepage.php' class='btn'>My homepage</a></h3>";
		}
		else {
			echo "<h2 align=center>Something went wrong... Please try again</h2>";
			echo "<h3 align=center><a  href='homepage.php' class='btn'>My homepage</a></h3>";
		}
    }
  }

  include("footer.php");

function write_add_new_page() {
	echo "<div class=\"jobpostform center\">";
	echo "<h2 align=\"center\">Post a new job</h2>";
	echo "<form  method=post action=postjob.php>";
	echo "<input type=hidden name=mode value=add>";
	
	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Short Description:</div>';
	echo '<div class="col-md-6"><input class="form-control"  name=description type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Email:</div>';
	echo '<div class="col-md-6"><input class="form-control"  name=email type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Company Name:</div>';
	echo '<div class="col-md-6"><input class="form-control"  name=company_name type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Position Title:</div>';
	echo '<div class="col-md-6"><input class="form-control"  name=position type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Date:</div>';
	echo '<div class="col-md-6"><input class="form-control" name=date type=date required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Please input job information here:</div>';
	echo '<div class="col-md-6"><textarea class="form-control" name=job_content style="margin: 0px; width: 100%; height: 140px;" required></textarea></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Tags:</div>';
	echo '<div class="col-md-6">';

	echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="internship" data-off="internship" data-onstyle="success" data-offstyle="danger"></span>';
	echo '&nbsp';
	echo '&nbsp';
	echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="software" data-off="software" data-onstyle="success" data-offstyle="danger"></span>';
	echo '&nbsp';
	echo '&nbsp';
	echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="fulltime" data-off="fulltime" data-onstyle="success" data-offstyle="danger"></span>';
	echo '&nbsp';
	echo '&nbsp';
	echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="front-end" data-off="front-end" data-onstyle="success" data-offstyle="danger"></span>';
	echo '&nbsp';
	echo '&nbsp';
	echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="fullstack" data-off="fullstack" data-onstyle="success" data-offstyle="danger"></span>';
	echo '&nbsp';
	echo '&nbsp';
	echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="java" data-off="java" data-onstyle="success" data-offstyle="danger"></span>';
	echo '&nbsp';
	echo '&nbsp';
	echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="python" data-off="python" data-onstyle="success" data-offstyle="danger"></span>';
	echo '&nbsp';
	echo '&nbsp';
	echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="web" data-off="web" data-onstyle="success" data-offstyle="danger"></span>';
	echo '&nbsp';
	echo '&nbsp';

	echo '</div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4"></div>';
	echo '<div class="col-md-6">';
	echo "<a id=\"loginbutton\" class=\"btn\" href=\"homepage-alu.php\" >Cancel</a>";
	echo "<input id=\"loginbutton\" class=\"btn\" type=submit name=submit value=Submit>";
	echo '</div>';
	echo '</div>';

//	$known_tags = get_known_tags($entries);
//	echo "<div>";
//	foreach ($known_tags as $t)
//	{
//		$t_withnbsp = str_replace("-", "&#8209", $t);
//		$t_withnbsp = str_replace(" ", "&nbsp", $t_withnbsp);
//		echo " <span style=\"display: inline-block\"><input type=checkbox name=tags[] value='{$t}'>&NoBreak;$t_withnbsp</span>";
//	}
//	echo "</div>";
//	echo "<div style=\"width: 600px; margin: 5px auto;\"><span style=\"float: left\">New tag(s):&nbsp;</span><input name=newtags type=text size=60><span>(separate with commas)</span></div>";

	echo "</form>";
	echo "</div>";
}
?>

</body>
</html>