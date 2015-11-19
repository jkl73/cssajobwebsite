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
			document.getElementById("JiaCom").innerHTML = "Company: " + document.getElementById("InCom").value;
			document.getElementById("JiaPos").innerHTML = "Job position: " + document.getElementById("InPos").value;
			document.getElementById("JiaEma").innerHTML = "Email: " + document.getElementById("InEma").value;
			document.getElementById("JiaDea").innerHTML = "Time: " + document.getElementById("InDea").value;
			document.getElementById("JiaInf").innerHTML = "" + document.getElementById("InInf").value;
			document.getElementById('light').style.display='block'; 
			document.getElementById('fade').style.display='block';
		}

		function hidepreview() {
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

  if (isset($_POST["edit"])) {
  	$postid = $_POST["edit"];
  	edit_page($postid);
  }
  else if(isset($_POST["mode"])){
	$mode = $_POST["mode"];

	if ($mode == "submit") {
		$post_id = $_POST["postid"];	
		if(update_post($_POST["postid"],$myemail,$_POST["email"], $_POST["company_name"], $_POST["position"], $_POST["description"], $_POST["job_content"], $_POST['job_type'], $_POST['major'], $_POST['date'], $_POST['url'], $_POST['visa'],$_POST["visit"])== 1)
		{
    		if($_FILES["file"]["error"] > 0){
    			if($_FILES["file"]["error"] != 4){
    					echo "Error:" . $_FILES["file"]["error"] ."</br/>";
    			}
    		}
    		
    		if($_FILES["file"]["error"] != 4){
    				$filename = (string)$post_id . "-" .(string)$_FILES["file"]["name"];
    				$path = "../upload-file/post/". $filename;
    				
    				move_uploaded_file($_FILES["file"]["tmp_name"], $path);
					update_post_file($post_id, $path, $_FILES["file"]["name"]);
    				
				}
			}
			//echo $_POST["job_content"];
			echo "<h2 align=center>Your job has successfully modified</h2>";
			echo "<h3 align=center><a href='homepage.php' class='btn'>My homepage</a></h3>";
		}
		else {
			echo "<h2 align=center>Something went wrong... Please try again</h2>";
			echo "<h3 align=center><a  href='homepage.php' class='btn'>My homepage</a></h3>";
		}
		/*if ($post_id >= 0) {
    			if($_FILES["file"]["error"] > 0){
    				if($_FILES["file"]["error"] != 4){
    					echo "Error:" . $_FILES["file"]["error"] ."</br/>";
    				}
    			}
    			//  改了sql函数的返回文件
    			if($_FILES["file"]["name"] != NULL){
    				$filename = (string)$post_id . "-" .(string)$_FILES["file"]["name"];
    				$path = "../upload-file/post/". $filename;
    				//$newfile = "../upload-file/post";
    				
    				move_uploaded_file($_FILES["file"]["tmp_name"], $path);
					update_post_file($post_id, $path, $_FILES["file"]["name"]);
    				
				}

				echo "<h2 align=center>Your job posting is successful</h2>";
				echo "<h3 align=center><a  href='homepage.php' class='btn'>My homepage</a></h3>";
		}*/
		
	}
	/*if ($mode == "submit") {	
		if (update_post($_POST["postid"],$myemail,$_POST["email"], $_POST["company_name"], $_POST["position"], $_POST["description"], $_POST["job_content"], $_POST['job_type'], $_POST['major'], $_POST['date'],$_POST["visit"]) ) {
				echo "<h2 align=center>Your job has successfully modified</h2>";
				echo "<h3 align=center><a href='homepage.php' class='btn'>My homepage</a></h3>";
		}
		else {
			echo "<h2 align=center>Something went wrong... Please try again</h2>";
			echo "<h3 align=center><a  href='homepage.php' class='btn'>My homepage</a></h3>";
		}
	}*/
  }

  include("footer.php");

function edit_page($postid) {
	$idlist = "(".$postid.")";
	$result = sql_get_post_by_ids($idlist);
	$row = $result[0];
	echo "<div class=\"jobpostform center\">";
	echo "<h2 align=\"center\">Post a new job</h2>";

	echo "<form method=post action=editpost.php id=\"frm1\">";
	echo "<input type=hidden name=mode value=submit>";
	
	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Short Description<span style="font-size:120%; color:red;">*</span>: </div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InDes" class="form-control" name=description type=text size=40 required value = '.$row["title"].'></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Email<span style="font-size:120%; color:red;">*</span>:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InEma" class="form-control" name=email type=text size=40 required value='.$row["email"].'></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Company Name<span style="font-size:120%; color:red;">*</span>:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InCom" class="form-control"  name=company_name type=text size=40 required value='.$row["company"].'></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Position Title<span style="font-size:120%; color:red;">*</span>:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InPos" class="form-control"  name=position type=text size=40 required value = '.$row["position"].'></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Deadline<span style="font-size:120%; color:red;"></span>:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InDea" class="form-control" name=date type=date></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">URL<span style="font-size:120%; color:red;"></span>:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InDea" class="form-control" name=url type=text value = '.$row["url"].'></div>';
	echo '</div>';

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Location<span style="font-size:120%; color:red;"></span>:</div>';
	echo '<div class="col-md-6 col-xs-10"><input id="InDea" class="form-control" name=location type=text></div>';
	echo '</div>';

	$content = sql_get_post_content_byID($postid);
	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-2">Please input detail here<span style="font-size:120%; color:red;">*</span>:<br>(URL, Qualification...)</div>';
	echo '<div class="col-md-6 col-xs-10"><textarea id="InInf" class="form-control" name=job_content style="margin: 0px; width: 100%; height: 140px;" required >'.$content[0]["content"].'</textarea></div>';
	echo '</div>';

?>
	<div class="row">
		<div align="right" class="col-md-4 col-xs-2">
			Job Type<span style="font-size:120%; color:red;">*</span>:
		</div>
		<div class="col-md-6 col-xs-10">
			<select name="job_type" id="" class="form-control">
				<option value="0">Not Specified</option>
				<option value="1">Full-time</option>
				<option value="2">Internship</option>
				<option value="3">Part-time</option>
				<option value="4">Co-op</option>
				<option value="5">Other</option>
			</select>
		</div>
	</div>

	<div class="row">
		<div align="right" class="col-md-4 col-xs-2">
			Major<span style="font-size:120%; color:red;">*</span>:
		</div>
		<div class="col-md-6 col-xs-10">	
			<select name="major" id="" class="form-control">
				<option value="0">Not Specified</option>
				<option value="1">CS</option>
				<option value="2">EE</option>
				<option value="3">Statistic</option>
				<option value="3">Analysis/Data Science</option>
				<option value="4" >MFE</option>
				<option value="5">Engineer</option>
				<option value="6">PM</option>
				<option value="7">Other</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div align="right" class="col-md-4 col-xs-2">
			Visa Sponsorship<span style="font-size:120%; color:red;">*</span>:
		</div>
		<div class="col-md-6 col-xs-10">	
			<select name="visa" class="form-control">
				<option value="0">No Visa Sponsorship</option>
				<option value="1">Visa Sponsorship will be provided</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div align="right" class="col-md-4 col-xs-2">
			<lable for = "file"> File Upload: </lable>
		</div>
		<div class="col-md-6 col-xs-10">
		    <input name = "file" type = "file" class = "form-control">				
		</div>
	</div>
	<input type = "hidden" name="visit" value=<?php echo $row["visit"];?>>
	<input type = "hidden" name="postid" value=<?php echo $row["postid"];?>>
<!-- 
	<div class="row">
		<div align="right" class="col-md-4 col-xs-2">
			Company<span style="font-size:120%; color:red;">*</span>:
		</div>
		<div class="col-md-6 col-xs-10">
				<select name="company" id="" class="form-control">
				<option value="0">Not Specified</option>
				<option value="1" >Google</option>
				<option value="2" >Facebook</option>
				<option value="3" >Microsoft</option>
				<option value="4" >Apple</option>
				<option value="5" >Amazon</option>
				<option value="6" >Linkedin</option>
				<option value="7" >Oracle</option>
				<option value="8" >Nvidia</option>
				<option value="9" >Intel</option>
				<option value="10" >Qualcomm</option>
				<option value="11" >Zynga</option>
				<option value="12" >EMC</option>
				<option value="13" >Big Four</option>
				<option value="14" >Bloomberg</option>
				<option value="15" >NetApp</option>
				<option value="16" >eBay</option>
				<option value="17" >SalesForce</option>
				<option value="18" >Yahoo</option>
				<option value="19" >Epic</option>
				<option value="20" >Twitter</option>
				<option value="21" >Snapchat</option>
				<option value="22" >Uber</option>
				<option value="23" >Expedia</option>
				<option value="24" >Quora</option>
				<option value="25" >Dropbox</option>
				<option value="26" >Indeed</option>
				<option value="27" >Cisco</option>
				<option value="28" >LiveRamp</option>
				<option value="29" >Marvell</option>
				<option value="30" >Factset</option>
				<option value="31" >Zillow</option>
				<option value="32" >Palantir</option>
				<option value="33" >Pinterest</option>
				<option value="34" >TwoSigma</option>
				<option value="35" >TripAdvisor</option>
				<option value="36" >Yelp</option>
				<option value="37" >Airbnb</option>
				<option value="38" >Medallia</option>
				<option value="39" >PoketGem</option>
			</select>
		</div>
	</div> -->
<?php

	echo '<div class="row">';
	echo '<div align="right" class="col-md-4 col-xs-4"></div>';
	echo '<div class="col-md-6">';
	echo "<a id=\"loginbutton\" class=\"btn\" href=\"homepage-alu.php\" >Cancel</a>";
	echo "<a id=\"login\" class=\"btn\" onclick = \"showPreview()\">Preview</a>";
	echo '<input class="btn" type="submit" value="Submit">';
	echo '</div>';
	echo '</div>';

	echo '<div id="light" class="white_content">'; 
	echo '<h3 id="JiaDes"></h3>';
	echo '<h4 id="JiaCom"></h5>';
	echo '<h4 id="JiaPos"></h5>';
	echo '<h4 id="JiaEma"></h5>';
	echo '<h4 id="JiaDea"></h5>';
	echo '<h6 id="view"></h6>';
	echo '<h6>This job has been viewed '.$row["visit"].' times</h6>';
	echo '<div class="panel panel-primary">';
	echo '<div class="panel-heading" style="font-size:100%">Detailed Information</div>';
	echo '<div id="JiaInf" class="panel-body">xxx</div></div>';



	echo '<br>';

	echo '<div style="bottom: 5%; position: absolute; left: 5%;">';
	echo '<a href = "javascript:void(0)" class="btn" onclick = "hidepreview()" >';
	echo 'Close';
	echo '</a>';
	echo '</div>';
	echo '</div>';

	echo '<div id="fade" class="black_overlay">';
	echo '</div>';

	echo "</form>";
	echo "</div>";

}
?>

</body>
</html>