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
			// document.getElementById("inForm").submit();
			// document.getElementById("frm1").submit();
			document.getElementById("JiaDes").innerHTML = "<strong>" + document.getElementById("InDes").value + "</strong>";
			document.getElementById("JiaCom").innerHTML = "<strong>Company: </strong>" + document.getElementById("InCom").value;
			document.getElementById("JiaPos").innerHTML = "<strong>Position: </strong>" + document.getElementById("InPos").value;
			document.getElementById("JiaEma").innerHTML = "<strong>Email: </strong>" + document.getElementById("InEma").value;
			document.getElementById("JiaDea").innerHTML = "<strong>Time: </strong>" + document.getElementById("InDea").value;
			document.getElementById("JiaInf").innerHTML = "<strong>Content:<br><br></strong>" + document.getElementById("InInf").value;
		    document.getElementById('light').style.display='block'; 
		    document.getElementById('fade').style.display='block';
		}

		function hidepreview() {
			document.getElementById('light').style.display='none'; 
		    document.getElementById('fade').style.display='none';
		}

		function submit() {
			// hidepreview();
			document.getElementById("frm1").submit();
			// Add Submit Function
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
    	color: black;
        display: none;
        position: absolute;
        top: 10%;
        left: 10%;
        width: 80%;
        height: 80%;
        padding: 20px;
        border: 22px solid #980000;
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

  if (!isset($_POST["mode"])) {
  	write_add_new_page();
  }
  else {
	$mode = $_POST["mode"];

	if ($mode == "submit") {

		// echo "fgdfgsg";
		// echo '<div class="showarticle">';
 	//  	echo '<h3>'. $_POST["description"] .'</h3>';
  //  		echo '<h4>Company: '. $_POST["company_name"] .'</h4>';
		// echo '<h4>Job position: '. $_POST["position"] .'</h4>';
		// echo '<h4>Deadline: '. $_POST["date"] .'</h4>';
		// echo '<h4>Email: '. $_POST["email"] .'</h4>';
		// echo '<h6>This job has been viewed '. '0' .' times</h6>';
		// echo '<p>'.$_POST["job_content"].'</p>';
	
		// echo "<form method=post action=postjob.php>";
		// echo '<input type="hidden" name=description value="'. $_POST["description"] .'">';
		// echo '<input type="hidden" name=company_name value="'. $_POST["company_name"] .'">';
		// echo '<input type="hidden" name=position value="'. $_POST["position"] .'">';
		// echo '<input type="hidden" name=date value="'. $_POST["date"] .'">';
		// echo '<input type="hidden" name=email value="'. $_POST["email"] .'">';
		// echo '<input type="hidden" name=job_content value="'. $_POST["job_content"] .'">';
		// echo "<input id=\"loginbutton\" class=\"btn\" type=submit name=submit value=back>";
		// echo "<input id=\"loginbutton\" class=\"btn\" type=submit name=submit value=add>";
		// echo '</form>';
		// echo '</div>';
	
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

	echo "<form method=post action=postjob.php id=\"frm1\">";
	echo "<input type=hidden name=mode value=submit>";
	
	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Short Description:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InDes" class="form-control"  name=description type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Email:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InEma" class="form-control" name=email type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Company Name:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InCom" class="form-control"  name=company_name type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Position Title:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InPos" class="form-control"  name=position type=text size=40 required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Deadline:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InDea" class="form-control" name=date type=date required></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Please input job information here:</div>';
	echo '<div class="col-md-6 col-xs-10"><textarea id="InInf" class="form-control" name=job_content style="margin: 0px; width: 100%; height: 140px;" required></textarea></div>';
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
	echo "<a id=\"login\" class=\"btn\" onclick = \"showPreview()\">Preview</a>";
	echo '</div>';
	echo '</div>';

	//Jia Pop-Up Window
    // echo '<p>Preview Here:';
    // echo '<a href = "javascript:void(0)" onclick = "showPreview()">';
    // echo 'Preview';
    // echo '</a>';
    // echo '</p>';

    echo '<div id="light" class="white_content">'; 
    echo '<h4 id="JiaDes">Description:</h4>';
    echo '<h5 id="JiaCom">Company:</h5>';
    echo '<h5 id="JiaPos">Position:</h5>';
    echo '<h5 id="JiaEma">Email:</h5>';
    echo '<h5 id="JiaDea">Deadline:</h5>';
    echo '<h5 id="JiaInf">Information:</h5>';
    echo '<br>';

//
        //
// echo '<ul id="menu">';
// echo '<li><a href="javascript:void(0)" class="btn" onclick = "submit()"><b>Submit</b></a></li>';
// echo '<li><a href="javascript:void(0)"class="btn" onclick = "hidepreview()"><b>Close</b></a></li>';
// echo '</ul>';  
    

    echo '<div style="bottom: 5%; position: absolute; left: 5%;">';
    // echo '<input id="loginbutton" class="btn" type=submit name=submit value=Submit onclick = "hidepreview()">';
    echo '<a href = "javascript:void(0)" class="btn" onclick = "submit()" >';
    echo 'Submit';
    echo '</a>';
    echo '<a href = "javascript:void(0)" class="btn" onclick = "hidepreview()" >';
    echo 'Close';
    echo '</a>';
    echo '</div>';
    

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