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
<div class="row" >
	<div class = "row">
	<div class="addpostbtn col-xs-12 col-sm-6 col-md-8">
		<a class = "btn btn-warning" href="postjob.php">Post New Job!</a> 
	</div>
</div>
  <div class="col-xs-12 col-sm-6 col-md-8" style = "overflow:scroll; height:450px">
  	<h2>Job Post</h2>
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
		echo '<ul class="list-group">';
		$SRCH = $_GET["srch-term"];
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
	}
	else
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
  	} 
 ?>
</div>
  <div class="col-xs-6 col-md-4">
  	<ul class="list-group">
<?php
	$query = 'select name,grad_year,company,position,Linkedin from employer where email = "'.$myemail.'";';
	$result = mysql_query($query);
	if(!$result){
		print "Error- Get info from employer failed";
		$error = mysql_error();
		print "<p>". $error . "</p>";
		exit;		
	}
	$row = mysql_fetch_array($result);
		$num_fields = sizeof($row);
		echo '<li class="list-group-item">Username: '.$row["name"].'</li>';
		echo '<li class="list-group-item">Graduation Year: '.substr($row["grad_year"],0,7).'</li>';
		echo '<li class="list-group-item">Company: '.$row["company"].'</li>';
		echo '<li class="list-group-item">Position: '.$row["position"].'</li>';
		echo '<li class="list-group-item">Linkedin Homepage: '.$row["Linkedin"].'</li>';
	echo "</ul>"
?>
  </div>
</div>
</div>

<?php
  include("footer.php");
?>

</body>
</html>