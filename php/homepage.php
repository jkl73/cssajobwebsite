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
  	<script>
  		$(document).ready(function(){
  			$("a.deletePost").click(function(e){
	          e.preventDefault();
	          var thiss = $(this);
	          var parent = $(this).parent()
	          var whole_list = parent.parent();
	          $.ajax({
	            type: 'post',
	            url: 'homepage.php',
	            data: 'deletePost=' + thiss.attr('data-email'),
	            beforeSend: function() {
	              whole_list.animate({opacity:'0.5'},50);
	            },
	            success: function() {
	              whole_list.slideUp(50,function() {
	                whole_list.remove();
	              });
	            }
	          });
	      });
  		})
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
  if(admin_byEmail($myemail))
  {
    header('Location: admin.php');
    return;
  }
	if (sql_is_verified($myemail, $_SESSION['type'])) {

	} else {
		echo "<h3>Please verify your email</h3>";
		return;
	}


	echo '<div class = "container">';
?>
<div class = "row">
<div class="searchbox col-xs-12 col-sm-6 col-md-8">
	<form action='homepage.php' method='get'>
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
		<div class="col-xs-3 col-sm-3 col-md-3">
			<h5>Job Type:</h5>
			<select name="job_type" id="" class="form-control">
				<option value="0">Please Select</option>
				<option value="1">Full-time</option>
				<option value="2">Internship</option>
				<option value="3">Part-time</option>
				<option value="4">Co-op</option>
				<option value="5">Other</option>
			</select>
		</div>
		<div class="col-xs-3 col-sm-3 col-md-3">
			<h5>Major:</h5>
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
		<div class="col-xs-3 col-sm-3 col-md-3">
			<h5>Company:</h5>
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

		<div style="float:right" class="col-xs-3 col-sm-3 col-md-3">
			<h5>&nbsp</h5>
			<button style="width:100%" type="submit" class="btn btn-info" >Search!</button>
		</div>
<!-- 		<div class="row">
			<div style="float:right" class="col-xs-4 col-sm-4 col-md-4">
				<button style="margin: 5px 0px; width:100%" type="submit" class="btn btn-info" >Search!</button>
			</div>
		</div> -->
	</form>
</div>

</div>
<div class="row" >
<div class="col-xs-12 col-sm-6 col-md-8">
	<form action ="homepage.php" method = POST>
<?php

	$conn = getconn();
	if(isset($_POST["deleteFav"]))
	{
		//echo "dffsf".$_POST["deleteFav"];
		$stmt = $conn->prepare("DELETE FROM user_fav WHERE email='".$myemail."' and postid =".$_POST["deleteFav"]."");
		$stmt->execute();
	}
	if(isset($_POST["addFav"]))
	{
		//echo "dffsf".$_POST["addFav"];
		$stmt = $conn->prepare("INSERT into user_fav VALUES ('".$myemail."', ".$_POST["addFav"].");");
		$stmt->execute();
	}
	//$server = mysql_connect("localhost","root","1qaz-pl,");
	/*$server = mysql_connect("cssadbinstance.ccmgeu2ghiy1.us-east-1.rds.amazonaws.com", "cssaadmin", "cssaadmin123"); 
	if (!$server) { 
		print "Error - Could not connect to MySQL"; 
		exit; 
	}
	$db = mysql_select_db("user_student"); 
	if (!$db) { 
		print "Error - Could not select the user_student database"; 
		exit; 
	}
	if(!isset($_SESSION['email'])||!isset($_SESSION['type']))
	{
		header('Location: index.php');
		exit;
	}
	$type = $_SESSION['type'];
	if(isset($_GET["srch-term"]))
	{
		$SRCH = $_GET["srch-term"];
		if($type == 'stu'){
			header('Location: homepage-std.php?srch-term='.$SRCH);
			exit;
		}
		else{
			header('Location: homepage-alu.php?srch-term='.$SRCH);
			exit;
		}
	}
	else
	{
		if($type == 'stu'){
			header('Location: homepage-std.php');
			exit;
		}
		else{
			header('Location: homepage-alu.php');
			exit;
		}
		 <ul class="pagination">
  <li><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
</ul>
	}*/
	if(isset($_POST["deletePost"]))
	{
		$postid = $_POST["deletePost"];
		sql_delete_post_byPostId($postid);
	}
	if(isset($_GET["srch-term"]) && $_GET["srch-term"] != "")
	{
		$res = print_text_search($_GET["srch-term"]);
		$targetstring = "(";
		foreach ($res as $key => $value) {
			$targetstring = $targetstring.$value.',';
		}
		if(count($res) == 0){
			echo "<h5> Sorry, we didn't find any matched result :(</h5>";
		}
		else
		{
			$targetstring[strlen($targetstring) - 1] = ')';
			//echo $targetstring;
			$res_data = sql_get_post_by_ids($targetstring);
				
				//Jia Edit
				$conn = getconn();
				$stmt = $conn->prepare("select * from user_fav as F WHERE F.email = '".$myemail."' order by F.postid;");
				$result2 = $stmt->execute();
				if (!$result2)
			    {
			        echo "What the fuck?";
			        pdo_die($stmt);
			    }
				$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
				//End of Edit
				//Modified
				Print_Fav_Post($res_data,$myemail,0,$result2);
			//Print_Post($res_data,$myemail,0);
		}
	}
	else if (isset($_GET["mode"]))
	{
		if ($_GET['mode'] == 'search') {
			$result =  searchPost(array($_GET['major'], $_GET['company'], $_GET['job_type']));
			$targetstring = "(";
			foreach ($result as $key => $value) {
				$targetstring = $targetstring.$value["postid"].',';
			}

			if (count($result) == 0) {
				echo "<h5>Sorry, didn't find any result :(</h5>";
			}
			else {
				$targetstring[strlen($targetstring) - 1] = ')';
				$res_data = sql_get_post_by_ids($targetstring);

				//Jia Edit
				$conn = getconn();
				$stmt = $conn->prepare("select * from user_fav as F WHERE F.email = '".$myemail."' order by F.postid;");
				$result2 = $stmt->execute();
				if (!$result2)
			    {
			        echo "What the fuck?";
			        pdo_die($stmt);
			    }
				$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
				//End of Edit
				//Modified
				Print_Fav_Post($res_data,$myemail,0,$result2);
			}			
		}
	}
	else
	{
		$conn = getconn();
		$stmt = $conn->prepare("select * from post_info where time<now() order by time DESC;");
		$result = $stmt->execute();
		if (!$result)
	    {
	        echo "What the fuck?";
	        pdo_die($stmt);
	    }
	    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    $num_res = count($result);
		$PageDisplay = 0;
		if(isset($_GET["page"]))$PageDisplay = $_GET["page"];
		$numPerPage = 30;
		$max_page = (int)($num_res/$numPerPage);
		if($PageDisplay>$max_page)$PageDisplay = $max_page;
		else if($PageDisplay<0)$PageDisplay = 0;
		//Jia Edit
				$conn = getconn();
				$stmt = $conn->prepare("select * from user_fav as F WHERE F.email = '".$myemail."' order by F.postid;");
				$result2 = $stmt->execute();
				if (!$result2)
			    {
			        echo "What the fuck?";
			        pdo_die($stmt);
			    }
				$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
				//End of Edit
				//Modified
				Print_Fav_Post($result,$myemail,$PageDisplay,$result2);
	    //Print_Post($result,$myemail,$PageDisplay);
	    if($max_page>0)
		{
			echo '<ul class="pagination">';
			for($i = 0;$i<=$max_page;$i++)
			{
				if($i == $PageDisplay)echo '<li class = "active">';
				else echo '<li>';
				echo '<a href="homepage.php?page='.$i.'">'.($i*$numPerPage+1).'-'.(($i+1)*$numPerPage).'</a>';
			}
			echo '</ul>';
		}
	}
?>
</form>
</div>
<div class="col-xs-6 col-md-4">
  	<ul class="list-group">
<?	
	$conn = getconn();
	if($_SESSION["type"]=="stu")
		$stmt = $conn->prepare("select * from student where email = :myemail;");
	else
		$stmt = $conn->prepare("select * from employer where email = :myemail;");
	$stmt->bindParam(":myemail",$myemail);
	$result = $stmt->execute();
	if (!$result)
    {
        echo "What the fuck?";
        pdo_die($stmt);
    }
        

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$row = $result[0];

	if($_SESSION["type"] == "stu")
	{
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
	}
	else
	{
		echo '<li class="list-group-item">Username: '.$row["name"].'</li>';
		echo '<li class="list-group-item">Graduation Year: '.substr($row["grad_year"],0,7).'</li>';
		echo '<li class="list-group-item">Company: '.$row["company"].'</li>';
		echo '<li class="list-group-item">Position: '.$row["position"].'</li>';
		echo '<li class="list-group-item">Linkedin Homepage: '.$row["Linkedin"].'</li>';
	}
	echo "</ul>";

	if($_SESSION["type"] == "stu");
	else
	{
		echo '<div style=>';
		echo '<a style="width:100%;" class="btn btn-warning" href="postjob.php">Post New Job!</a> ';
		echo '</div>';
	}

	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
  	include_once("footer.php");
?>

</body>
</html>
<?php
/*function print_posts($res_data) {
	foreach ($res_data as $key => $row) {
		echo "<li class=\"list-group-item\">";
		echo "<span class=\"badge\">".$row["visit"]." view</span>";
		echo '<a href="show-article.php?postid='. $row["postid"] .'">'.$row["tags"].'</a>';
		echo '<div>';
		echo '<span class="label label-info">'.$row["company"].'</span>';
		echo '<span class="label label-info">'.$row["position"].'</span>';
		echo '</div>';
		echo "</li> "; 
	}
}*/


function print_text_search($SRCH)
{
	$conn = getconn();

	//echo '<ul class="list-group">';
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
	 		"was", "wasn't", "we", "we'd", "we'll", "we're", "we've", "were", "weren't", "what", "what's", "when", "want", "wants",
	 		"when's", "where", "where's", "which", "while", "who", "who's", "whom", "why", "why's", "with", "won't", 
	 		"wanted", "would", "wouldn't", "you", "you'd", "you'll", "you're", "you've", "your", "yours", "yourself", 
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
		   	$query = "select * from post_info 
		   	where company like '%".$token."%' or position like '%".$token."%' or title like '%".$token."%' order by time DESC;";
			$stmt = $conn->prepare($query);
			$result = $stmt->execute();
			if (!$result)
		    {
		        echo "What the fuck?";
		        pdo_die($stmt);
		    }
		    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach ($result as $row) {
				if(in_array($row["postid"], $res_id)) {
					//reset($row);
					continue;
				} 
				$info = $row["title"]." ".$row["company"]." ".$row["position"];
				$info = strtolower($info);
				$info_token = explode(" ", $info);
				if (!in_array($token, $info_token) && eregi("[^\x80-\xff]", $token)) {
					//reset($row);
					continue;
				}
				array_push($res_id, $row["postid"]);
			} 
			$token = strtok(" \t\n");
	   }
	   return $res_id;
	   //echo '</div>';
}


function searchPost($tag_array) {
	$conn = getconn();

	
	$majorClass = $tag_array[0];
	$companyName = $tag_array[1];
	$jobType = $tag_array[2];

	$query = "select postid from post_tags where (".$majorClass." = 0 or major_class = ".$majorClass.") and (".$companyName." = 0 or company = ".$companyName.") and (".$jobType." = 0 or job_type = ".$jobType.")";
	$stmt = $conn->prepare($query);
	$result = $stmt->execute();
	if (!$result)
    {
        echo "What the fuck?";
        pdo_die($stmt);
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	/*
	$pid_array = array();


	while ($row = mysql_fetch_array($result)) {
		array_push($pid_array, $row["postid"]);
	}
	return $pid_array;*/
	return $result;
}

?>