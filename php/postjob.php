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
	 <script>
		function showPreview() {
		    document.getElementById('light').style.display='block'; 
		    document.getElementById('fade').style.display='block';
		    
		}
		function hidepreview(){
			document.getElementById('light').style.display='none'; 
		    document.getElementById('fade').style.display='none';
		}
	</script>


  	<style>
  	.black_overlay{
        display: none;
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: absolute;
        top: 25%;
        left: 25%;
        width: 50%;
        height: 50%;
        padding: 16px;
        border: 16px solid orange;
        background-color: white;
        z-index:1002;
        overflow: auto;
    }
  	</style>

</head>

<body>

<?php
  session_start();
  include("sqlfuncs.php");
  include("header.php");

  if (!isset($_POST["submit"])) {
  	write_add_new_page();
  }
  else {
	$mode = $_POST["submit"];

	if ($mode == "preview") {

		echo '<div class="showarticle">';
 	 	echo '<h3>'. $_POST["description"] .'</h3>';
   		echo '<h4>Company: '. $_POST["company_name"] .'</h4>';
		echo '<h4>Job position: '. $_POST["position"] .'</h4>';
		echo '<h4>Deadline: '. $_POST["date"] .'</h4>';
		echo '<h4>Email: '. $_POST["email"] .'</h4>';
		echo '<h6>This job has been viewed '. '0' .' times</h6>';
		echo '<p>'.$_POST["job_content"].'</p>';
	
		echo "<form method=post action=postjob.php>";
		echo '<input type="hidden" name=description value="'. $_POST["description"] .'">';
		echo '<input type="hidden" name=company_name value="'. $_POST["company_name"] .'">';
		echo '<input type="hidden" name=position value="'. $_POST["position"] .'">';
		echo '<input type="hidden" name=date value="'. $_POST["date"] .'">';
		echo '<input type="hidden" name=email value="'. $_POST["email"] .'">';
		echo '<input type="hidden" name=job_content value="'. $_POST["job_content"] .'">';
		echo "<input id=\"loginbutton\" class=\"btn\" type=submit name=submit value=back>";
		echo "<input id=\"loginbutton\" class=\"btn\" type=submit name=submit value=add>";
		echo '</form>';
		echo '</div>';
	}

	if ($mode == "back") {
		edit_add_new_page($_POST["description"], $_POST["company_name"], $_POST["position"] , $_POST["date"], $_POST["email"], $_POST["job_content"]);
	}

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


function edit_add_new_page($des, $cname, $pos, $date, $email, $content) {
	echo "<div class=\"jobpostform center\">";
	echo "<h2 align=\"center\">Post a new job</h2>";
	echo "<form method=post action=postjob.php>";
	echo "<input type=hidden name=mode value=preview>";
	
	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Short Description:</div>';
	echo '<div class="col-md-6"><input class="form-control" value="'.$des.'" name=description type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Email:</div>';
	echo '<div class="col-md-6"><input class="form-control" value="'.$email.'" name=email type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Company Name:</div>';
	echo '<div class="col-md-6"><input class="form-control" value="'.$cname.'" name=company_name type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Position Title:</div>';
	echo '<div class="col-md-6"><input class="form-control" value="'.$pos.'" name=position type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Deadline:</div>';
	echo '<div class="col-md-6"><input class="form-control" value="'.$date.'" name=date type=date required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4">Please input job information here:</div>';
	echo '<div class="col-md-6"><textarea class="form-control" name=job_content style="margin: 0px; width: 100%; height: 140px;" required>'.$content.'</textarea></div>';
	echo '</div>';

	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4"></div>';
	echo '<div class="col-md-6">';
	echo "<a id=\"loginbutton\" class=\"btn\" href=\"homepage-alu.php\" >Cancel</a>";
	echo "<input id=\"loginbutton\" class=\"btn\" type=submit name=submit value=preview>";
	echo '</div>';
	echo '</div>';

	echo "</form>";
	echo "</div>";
}


function write_add_new_page() {
	echo "<div class=\"jobpostform center\">";
	echo "<h2 align=\"center\">Post a new job</h2>";
	echo "<form method=post action=postjob.php>";
	echo "<input type=hidden name=mode value=preview>";
	
	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Short Description:</div>';
	echo '<div class="col-md-6 col-xs-10"><input class="form-control"  name=description type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Email:</div>';
	echo '<div class="col-md-6 col-xs-10"><input class="form-control" name=email type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Company Name:</div>';
	echo '<div class="col-md-6 col-xs-10"><input class="form-control"  name=company_name type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Position Title:</div>';
	echo '<div class="col-md-6 col-xs-10"><input class="form-control"  name=position type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Deadline:</div>';
	echo '<div class="col-md-6 col-xs-10"><input class="form-control" name=date type=date required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Please input job information here:</div>';
	echo '<div class="col-md-6 col-xs-10"><textarea class="form-control" name=job_content style="margin: 0px; width: 100%; height: 140px;" required></textarea></div>';
	echo '</div>';


	// echo '<div class="row">';
	// echo '<div align="right" class="col-md-4">Tags:</div>';
	// echo '<div class="col-md-6">';

	// echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="internship" data-off="internship" data-onstyle="success" data-offstyle="danger"></span>';
	// echo '&nbsp';
	// echo '&nbsp';
	// echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="software" data-off="software" data-onstyle="success" data-offstyle="danger"></span>';
	// echo '&nbsp';
	// echo '&nbsp';
	// echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="fulltime" data-off="fulltime" data-onstyle="success" data-offstyle="danger"></span>';
	// echo '&nbsp';
	// echo '&nbsp';
	// echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="front-end" data-off="front-end" data-onstyle="success" data-offstyle="danger"></span>';
	// echo '&nbsp';
	// echo '&nbsp';
	// echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="fullstack" data-off="fullstack" data-onstyle="success" data-offstyle="danger"></span>';
	// echo '&nbsp';
	// echo '&nbsp';
	// echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="java" data-off="java" data-onstyle="success" data-offstyle="danger"></span>';
	// echo '&nbsp';
	// echo '&nbsp';
	// echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="python" data-off="python" data-onstyle="success" data-offstyle="danger"></span>';
	// echo '&nbsp';
	// echo '&nbsp';
	// echo '<span><input class ="tag" type="checkbox"  data-toggle="toggle" data-on="web" data-off="web" data-onstyle="success" data-offstyle="danger"></span>';
	// echo '&nbsp';
	// echo '&nbsp';

	// echo '</div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-4"></div>';
	echo '<div class="col-md-6">';
	echo "<a id=\"loginbutton\" class=\"btn\" href=\"homepage-alu.php\" >Cancel</a>";
	echo "<input id=\"loginbutton\" class=\"btn\" type=submit name=submit value=preview>";
	echo '</div>';
	echo '</div>';

	//Jia Pop-Up Window
    echo '<p>Preview Here:';
    echo '<a href = "javascript:void(0)" onclick = "showPreview()">';
    echo 'Preview';
    echo '</a>';
    echo '</p>';

    echo '<div id="light" class="white_content">'; 
    echo '<a href = "javascript:void(0)" onclick = "hidepreview()">';
    echo 'Close';
    echo '</a>';
    echo '<h4 id="JiaDes">Description:</h4>';
    echo '<h4 id="JiaEma">Email:</h4>';
    echo '<h4 id="JiaCom">Company:</h4>';
    echo '<h4 id="JiaPos">Position:</h4>';
    echo '<h4 id="JiaDea">Deadline:</h4>';
    echo '<h4 id="JiaInf">Information:</h4>';
    echo '</div>';

    echo '<div id="fade" class="black_overlay">';
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