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
			Job Type:
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
			Major:
			<select name="major" id="" class="form-control">
				<option value="0">Please Select</option>
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
		<div class="col-xs-3 col-sm-2 col-md-3">
			Company:
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
		<div id="btndiv" class="col-xs-3 col-sm-2 col-md-3">
			<button type="submit" class="btn btn-default btn-lg" >Search!</button>
		</div>
	</form>
</div>


<div class="row" >
<div class="col-xs-12 col-sm-6 col-md-8" style = "overflow:scroll; height:450px">
  	<h2>Job Posts</h2>
  


  <?php

	
	//$server = mysql_connect("localhost","root","1qaz-pl,");
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
	if(!isset($_SESSION['email']))
	{
		header('Location: index.php');
		exit;
	}

	$myemail = $_SESSION["email"];

	if(isset($_GET["srch-term"]))
	{
		print_text_search($_GET["srch-term"]);
	}
	else if (isset($_GET["mode"]))
	{
		if ($_GET['mode'] == 'search') {
			$result =  searchPost(array($_GET['major'], $_GET['company'], $_GET['job_type']));
			foreach ($result as $key => $value) {
				echo $value;
			}


			echo "</div>";
		}
	}
	else
	{
		Display_all_query();
  	}



 ?>








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


<?php
function print_text_search($SRCH)
{
	echo '<ul class="list-group">';
		$token = strtok($SRCH, " \t\n");
  
	 	$stop_words = array("a", "about", "above", "after", "again", "against", "all", "am", "an", "and", "any", "are", 
	 		"aren't", "as", "at", "be", "because", "been", "before", "being", "below", "between", "both", "but", "by", 
	 		"can't", "cannot", "could", "couldn't", "did", "didn't", "do", "does", "doesn't", "doing", "don't", "down", 
	 		"during", "each", "few", "for", "from", "further", "had", "hadn't", "has", "hasn't", "have", "haven't", 
	 		"having", "he", "he'd", "he'll", "he's", "her", "here", "here's", "hers", "herself", "him", "himself", "his", 
	 		"how", "how's", "i", "i'd", "i'll", "i'm", "i've", "if", "in", "into", "is", "isn't", "it", "it's", "its",
	 		"itself", "let's", "me", "more", "most", "mustn't", "my", "myself", "no", "nor", "not", "of", "off", "on", 
	 		"once", "only", "or", "other", "ought", "our", "ours", "ourselves", "out", "over", "own", "same", "shan't", 
	 		"she", "she'd", "she'll", "she's", "should", "shouldn't", "so", "some", "such", "than", "that", "that's", 
	 		"the", "their", "theirs", "them", "themselves", "then", "there", "there's", "these", "they", "they'd", 
	 		"they'll", "they're", "they've", "this", "those", "through", "to", "too", "under", "until", "up", "very", 
	 		"was", "wasn't", "we", "we'd", "we'll", "we're", "we've", "were", "weren't", "what", "what's", "when", 
	 		"when's", "where", "where's", "which", "while", "who", "who's", "whom", "why", "why's", "with", "won't", 
	 		"would", "wouldn't", "you", "you'd", "you'll", "you're", "you've", "your", "yours", "yourself", 
	 		"yourselves", 
			);
	 	$res_id = array();
		while ($token !== false)
	   {
	   	$token = strtolower($token);
	   	if (in_array($token, $stop_words)) 
	   	{
	   		$token = strtok(" \t\n");
	   		continue;
	   	}
	   	$query = "select tags,company,postid,email,position,visit from post_info 
	   	where company like '%".$token."%' or position like '%".$token."%' or tags like '%".$token."%' order by visit DESC;";
			$result = mysql_query($query);
			if(!$result){
				print "Error- Get info from post_info failed";
				$error = mysql_error();
				print "<p>". $error . "</p>";
				//exit;		
			}
			
			while($row = mysql_fetch_array($result)){
				if(in_array($row["postid"], $res_id)) {
					reset($row);
					continue;
				} 
				$info = $row["tags"]." ".$row["company"]." ".$row["position"];
				$info = strtolower($info);
				$info_token = explode(" ", $info);
				if (!in_array($token, $info_token) && eregi("[^\x80-\xff]", $token)) {
					reset($row);
					continue;
				}
				array_push($res_id, $row["postid"]);
				$num_fields = sizeof($row);
				reset($row); 

				echo "<li class=\"list-group-item\">";
				echo "<span class=\"badge\">".$row["visit"]."</span>";
				echo '<a href="show-article.php?postid='. $row["postid"] .'">'.$row["company"].' is looking for '.$row["position"].", please contact ".$row["email"].'</a>';
				echo "</li> "; 
			} 
			$token = strtok(" \t\n");
	   }
	   echo '</div>';
}


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

function Display_all_query()
{
	echo '<div class="panel-group">';
    	echo '<div class="panel panel-default">';
      	echo '<div class="panel-heading">';
        echo '<h4 class="panel-title">';
        echo '<a data-toggle="collapse" href="#collapse1">This week</a>';
        echo '</h4>';
      	echo '</div>';
      	echo '<div id="collapse1" class="panel-collapse collapse in">';
  	 	echo '<ul class="list-group">';
		$query = "select * from post_info order by time DESC;";
	
		$result = mysql_query($query);
		if(!$result)
		{
			print "Error- Get info from post_info failed";
			$error = mysql_error();
			print "<p>". $error . "</p>";
			//exit;		
		}

		$cnt = 0;
		$row;
		while($row = mysql_fetch_array($result))
		{
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

		echo '</div>';
	  	echo '</div>';
	  	echo '<div class="panel panel-default">';
	    echo '<div class="panel-heading">';
	    echo '<h4 class="panel-title">';
	    echo '<a data-toggle="collapse" href="#collapse2">One week ago</a>';
	    echo '</h4>';
	    echo '</div>';
	    echo '<div id="collapse2" class="panel-collapse collapse">';
	  	echo '<ul class="list-group">';


		reset($row); 
		if($cnt % 2 == 0)echo "<li class=\"list-group-item\">";
		else echo "<li class=\"list-group-item list-group-item-info\">";
		echo "<span class=\"badge\">".$row["visit"]." views</span>";
		echo '<a href="show-article.php?postid='. $row["postid"] .'">'.$row["company"].' is looking for '.$row["position"].", please contact ".$row["email"].'</a>';
		echo "</li>"; 

		while($row = mysql_fetch_array($result))
		{
			$cnt = $cnt+1;
			reset($row); 
			if($cnt % 2 == 0)echo "<li class=\"list-group-item\">";
			else echo "<li class=\"list-group-item list-group-item-info\">";
			echo "<span class=\"badge\">".$row["visit"]." views</span>";
			echo '<a href="show-article.php?postid='. $row["postid"] .'">'.$row["company"].' is looking for '.$row["position"].", please contact ".$row["email"].'</a>';
			echo "</li>"; 
		}


	  	echo '</div>';
	  	echo '</div>';
	  	echo '</div>';
	  	echo '</div>';
}
?>