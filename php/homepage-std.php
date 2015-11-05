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
	 <script src="js/main.js"></script>
  	<style>
  	</style>
</head>

<body>
<?php
  session_start();

  include("header.php");
?>
<div class = "container">
<<<<<<< Updated upstream
<div class="row" >
  <div class="col-xs-12 col-sm-6 col-md-8" style = "overflow:scroll; height:450px">
  	<h2>Job Post</h2>
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">This week</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse in">
=======

<div class="searchbox col-xs-12 col-sm-6 col-md-8">
	<form action='homepage-std.php' method='get'>
		<input type='hidden' name='mode' value='search'></input>
<!-- 		<div class="col-xs-3 col-sm-2 col-md-3">
			<select name="year" id="" class="form-control">
				<option value="0">Please Select</option>
				<option value="2020">2020</option>
				<option value="2019">2019</option>
				<option value="2018">2018</option>
				<option value="2017">2017</option>
				<option value="2016">2016</option>
				<option value="2015">2015</option>
				<option value="2014">2014</option>
				<option value="2013">2013</option>
				<option value="2012">2012</option>
				<option value="2011">2011</option>				
			</select>
		</div> -->
		<div class="col-xs-3 col-sm-2 col-md-3">
			<select name="job_type" id="" class="form-control">
				<option value="0">Please Select</option>
				<option value="1">Full-time</option>
				<option value="2">Internship</option>
				<option value="3">Part-time</option>
				<option value="4">Co-op</option>
				<option value="5">Other</option>
			</select>
		</div>
		<div class="col-xs-3 col-sm-2 col-md-3">
			<select name="major" id="" class="form-control">
				<option value="0">Please Select</option>
				<option value="CS">CS</option>
				<option value="EE">EE</option>
				<option value="Statistic">Statistic</option>
				<option value="Analysis/Data Science">Analysis/Data Science</option>
				<option value="MFE" >MFE</option>
				<option value="Engineer">Engineer</option>
				<option value="PM">PM</option>
				<option value="Othe">Other</option>
			</select>
		</div>
		<div class="col-xs-3 col-sm-2 col-md-3">
			<select name="company" id="" class="form-control">
				<option value="0">Please Select</option>
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
				<option value="200" ></option>
			</select>
		</div>

		<div class="col-xs-3 col-sm-2 col-md-3">
			<button type="submit" class="btn btn-default" >Search</button>
		</div>
	</form>
</div>


<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-8">
>>>>>>> Stashed changes
  	 <ul class="list-group">

<?php
	//$server = mysql_connect("localhost","root","1qaz-pl,");

	if(!isset($_SESSION['email']))
	{
		header('Location: index.php');
		exit;
	}
<<<<<<< Updated upstream
	$myemail = $_SESSION["email"];
	if(isset($_GET["srch-term"]))
	{
		$query = "select * from post_info where company = '".$_GET["srch-term"]."' order by time DESC;";
	}
	else
	{
		$query = "select * from post_info order by time DESC;";
	}
	
	$result = mysql_query($query);
	if(!$result){
		print "Error- Get info from post_info failed";
		$error = mysql_error();
		print "<p>". $error . "</p>";
		//exit;		
	}

	$cnt = 0;
	$row;
	while($row = mysql_fetch_array($result)){
		$cnt = $cnt+1;
		if( strtotime($row['time']) < strtotime('-7 day'))
			break;

		reset($row); 
		if($cnt % 2 == 0)echo "<li class=\"list-group-item\">";
		else echo "<li class=\"list-group-item list-group-item-info\">";
		echo "<span class=\"badge\">".$row["visit"]." views</span>";
		echo '<a href="show-article.php?postid='. $row["postid"] .'">'.$row["company"].' is looking for '.$row["position"].", please contact ".$row["email"].'</a>';
		echo "</li>"; 
	} 
	
	print "</ul>";
?>
</div>
=======
	$myemail = $_SESSION['email'];


	if (isset($_GET['mode'])) {
		if ($_GET['mode'] == 'search') {
			$result =  searchPost(array($_GET['major'], $_GET['company'], $_GET['job_type']));
			foreach ($result as $key => $value) {
				echo $key;
				echo '<br>';
				echo $value;
				echo '<br>';
			}
		}
	} else {
		showallpost();
	}


	/* 
	tag_array:
	//0 => job_year
	0 => major_class
	1 => company
	2 => job_type
	 */
	function searchPost($tag_array) {
		/*$conn = getconn();*/

		$server = mysql_connect("cssadbinstance.ccmgeu2ghiy1.us-east-1.rds.amazonaws.com", "cssaadmin", "cssaadmin123");
		if (!$server) {
			print "Error - Could not connect to MySQL";
			exit;
		}
		$db = mysql_select_db("user_student");
		if (!$db) {
			print "Error - Could not select the guest database";
			exit;
		}
		$majorClass = $tag_array[0];
		$companyName = $tag_array[1];
		$jobType = $tag_array[2];

		$query = "select postid from post_tags where (".$majorClass." = 0 or major_class = ".$majorClass.") and (".$companyName." = 0 or company = ".$companyName.") and (".$jobType." = 0 or job_type = ".$jobType.")";
		$result = mysql_query($query);
		
		$pid_array = array();


		while ($row = mysql_fetch_array($result)) {
			array_push($pid_array, $row["postid"]);
		}
		return $pid_array;
	}


	function showallpost() {
		$server = mysql_connect("cssadbinstance.ccmgeu2ghiy1.us-east-1.rds.amazonaws.com", "cssaadmin", "cssaadmin123"); 
		if (!$server) { 
			print "Error - Could not connect to MySQL"; 
			exit; 
		}
		$db = mysql_select_db("user_student"); 
		if (!$db) { 
			print "Error - Could not select the user_student database"; 
			exit; 
		}
		if(isset($_GET["srch-term"]))
		{
			$query = "select company,postid,email,position,visit from post_info where company = '".$_GET["srch-term"]."' order by time DESC;";
		}
		else
		{
			$query = "select company,postid,email,position,visit from post_info order by time DESC;";
		}
		$result = mysql_query($query);
		if(!$result){
			print "Error- Get info from post_info failed";
			$error = mysql_error();
			print "<p>". $error . "</p>";
			//exit;		
		}

		while($row = mysql_fetch_array($result)){
			$num_fields = sizeof($row);
			reset($row); 
			echo "<li class=\"list-group-item\">";
			echo "<span class=\"badge\">".$row["visit"]."</span>";
			echo '<a href="show-article.php?postid='. $row["postid"] .'">'.$row["company"].' is looking for '.$row["position"].", please contact ".$row["email"].'</a>';
			echo "</li> "; 
		} 
		print "</ul>";
	}
?>


>>>>>>> Stashed changes
  </div>
  <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse2">One week ago</a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
  	 <ul class="list-group">

<?php
		reset($row); 
		if($cnt % 2 == 0)echo "<li class=\"list-group-item\">";
		else echo "<li class=\"list-group-item list-group-item-info\">";
		echo "<span class=\"badge\">".$row["visit"]." views</span>";
		echo '<a href="show-article.php?postid='. $row["postid"] .'">'.$row["company"].' is looking for '.$row["position"].", please contact ".$row["email"].'</a>';
		echo "</li>"; 
	while($row = mysql_fetch_array($result)){
		$cnt = $cnt+1;
		reset($row); 
		if($cnt % 2 == 0)echo "<li class=\"list-group-item\">";
		else echo "<li class=\"list-group-item list-group-item-info\">";
		echo "<span class=\"badge\">".$row["visit"]." views</span>";
		echo '<a href="show-article.php?postid='. $row["postid"] .'">'.$row["company"].' is looking for '.$row["position"].", please contact ".$row["email"].'</a>';
		echo "</li>"; 
	}

?>
  	 </div>
  	</div>
  </div>
</div>
  <div class="col-xs-6 col-md-4">
  	<ul class="list-group">


<?php

	$query = 'select name,grad_year,major,job_type from student where email = "'.$myemail.'";';
	$result = mysql_query($query);
	if(!$result){
		print "Error- Get info from student failed";
		$error = mysql_error();
		print "<p>". $error . "</p>";
		exit;		
	}
	$row = mysql_fetch_array($result);
		$num_fields = sizeof($row);
		echo '<li class="list-group-item">Username: '.$row["name"].'</li>';
		echo '<li class="list-group-item">Expected Graduation Year: '.substr($row["grad_year"], 0, 7).'</li>';
		echo '<li class="list-group-item">Major: '.$row["major"].'</li>';
		echo '<li class="list-group-item">Looking for ';

		switch ($row["job_type"]) {
		case 1:
			echo "Full-time job";
			break;
		case 2:
			echo "Part-time job";
			break;
		case 3:
			echo "Internship";
			break;
		}

		echo '</li>';
		echo "</ul>";


?>
  </div>
</div>
</div>


<?php
  include("footer.php");
?>

</body>
</html>