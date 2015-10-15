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
	 <script src="js/main.js"></script>
  	<style>
  	</style>

</head>

<body>
	<?php
	  include("header.php");
	?>

<?php

	$server = mysql_connect("cssadbinstance.ccmgeu2ghiy1.us-east-1.rds.amazonaws.com", "cssaadmin", "cssaadmin123"); 
	if (!$server) { 
		print "Error - Could not connect to MySQL"; 
		exit; 
	}
	$db = mysql_select_db("user_student");

	$sql = "
			CREATE TABLE `admin` (
			  `name` varchar(64) NOT NULL,
			  `email` varchar(64) NOT NULL,
			  `password` varchar(32) NOT NULL,
			  PRIMARY KEY (`email`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	
	if (mysql_query($sql) == TRUE){
		echo "Create table admin successfully<br>";
	} else {
		echo "Error with creating table admin";
	}

	$sql = "
			CREATE TABLE `employer` (
			  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
			  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
			  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
			  `grad_year` date DEFAULT NULL,
			  `company` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `position` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `Linkedin` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `type` int(2) DEFAULT NULL,
			  PRIMARY KEY (`email`),
			  UNIQUE KEY `email` (`email`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
	if (mysql_query($sql) == TRUE){
		echo "Create table employer successfully<br>";
	} else{
		die("Error with creating table employer<br>");
	}

	$sql = "
			CREATE TABLE `student` (
			  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
			  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
			  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
			  `grad_year` date DEFAULT NULL,
			  `major` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `job_type` int(2) DEFAULT NULL,
			  `degree` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
			  PRIMARY KEY (`email`),
			  UNIQUE KEY `email` (`email`),
			  KEY `student_name` (`name`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
	if (mysql_query($sql) == TRUE){
		echo "Create table student successfully<br>";
	} else{
		die("Error with creating table student<br>");
	}

	$sql = "
			CREATE TABLE `post_content` (
			  `postid` int(11) NOT NULL,
			  `content` varchar(4096) NOT NULL,
			  PRIMARY KEY (`postid`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	if (mysql_query($sql) == TRUE){
		echo "Create table post_content successfully<br>";
	} else{
		die("Error with creating table post_content<br>");
	}

	$sql = "
			CREATE TABLE `reply` (
			  `postid` int(11) NOT NULL,
			  `email` varchar(64) NOT NULL,
			  `content` varchar(1024) NOT NULL,
			  `time` datetime NOT NULL,
			  PRIMARY KEY (`postid`,`email`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	if (mysql_query($sql) == TRUE){
		echo "Create table reply successfully<br>";
	} else{
		die("Error with creating table reply<br>");
	}

	$sql = "
			CREATE TABLE `post_info` (
			  `postid` int(11) NOT NULL,
			  `email` varchar(64) NOT NULL,
			  `comapny` varchar(64) NOT NULL,
			  `position` varchar(65) DEFAULT NULL,
			  `tags` varchar(255) DEFAULT NULL,
			  `time` datetime NOT NULL,
			  `visit` int(10) unsigned DEFAULT NULL,
			  `like` int(10) unsigned DEFAULT NULL,
			  PRIMARY KEY (`postid`),
			  UNIQUE KEY `postid_UNIQUE` (`postid`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	if (mysql_query($sql) == TRUE){
		echo "Create table post_info successfully<br>";
	} else{
		die("Error with creating table post_info<br>");
	}

?>

<?php
  include("footer.php");
?>

</body>
</html>