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
  
	if (sql_is_verified($myemail, $_SESSION['type'])) {

	} else {
		echo "<h3>Please verify your email</h3>";
		return;
	}
	echo '<div class = "container">';



	if (isset($_GET['module']) && $_GET['module'] == 'refer') {
		echo "<h2>Refer Board</h2>";
		echo '<div class = "row">';
	} else {
		echo "<h2>Job Board</h2>";
		echo '<div class = "row">';
?>

<div class="searchbox col-xs-12 col-sm-6 col-md-8">
	<form action='homepage.php' method='get'>
		<input type='hidden' name='mode' value='search'></input>
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


		<div style="float:right; padding: 0px" class="col-xs-3 col-sm-3 col-md-3">
			<h5>&nbsp</h5>
			<button style="width:100%" type="submit" class="btn btn-info" >Search!</button>
		</div>
	</form>
</div>


<?php
}
?>



</div>
<div class="row" >
<div class="col-xs-12 col-sm-6 col-md-8">
	
<?php
	if (isset($_GET['module']) && $_GET['module'] == 'refer') {
		echo '<form action ="homepage.php?module=refer" method = POST>';
	} else {
		echo '<form action ="homepage.php?module=job" method = POST>';
	}

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

	if(isset($_POST["deletePost"]))
	{
		$postid = $_POST["deletePost"];
		sql_delete_post_byPostId($postid);
		exit;
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
			$result =  searchPost(array($_GET['major'], $_GET['job_type']));
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

		if (isset($_GET['module']) && $_GET['module'] == 'refer') {
			$stmt = $conn->prepare("select * from post_info where post_type = 1 and time<now() order by time DESC;");
		} else {
			$stmt = $conn->prepare("select * from post_info where post_type = 0 and time<now() order by time DESC;");
		}

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
<?php
	if(admin_byEmail($myemail))
	{
	  echo '<h2>Welcome Admin</h2>';
	  echo '<h3><a href="adminUsr.php">Manage User</a></h3>';
	}
	$myuid = sql_get_uid_byEmail($myemail);
	display_profile($myuid);



	echo '<div>';

	if (isset($_GET['module']) && $_GET['module'] == 'refer') {
		echo '<a style="width:100%;" class="btn btn-warning" href="postrefer.php">Post New Refer!</a> ';
	} else {
		echo '<a style="width:100%;" class="btn btn-warning" href="postjob.php">Post New Job!</a> ';
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
		   	$query = "select * from post_info p, user u
		   	where p.company like '%".$token."%' or p.position like '%".$token."%' or p.title like '%".$token."%' or 
		   	(p.user_email=u.email and u.name='".$token."') order by time DESC;";
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
	$jobType = $tag_array[1];

	$query = "select postid from post_tags where (".$majorClass." = 0 or major_class = ".$majorClass.") and (".$jobType." = 0 or job_type = ".$jobType.")";
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