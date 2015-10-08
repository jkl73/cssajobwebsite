<!DOCTYPE html>
<html lang="en">
<head>
  <title>CSSA Sign up page</title>
    <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
 <link rel="stylesheet" href="http://localhost/cssajobwebsite/css/main.css">
 <script src="js/main.js"></script>
  <style>
  </style>

</head>

<body>
<?php
  include("header.php");
?>

	<div class = "container col-sm-offset-3 col-sm-6 col-sm-offset-3" >
		<div class = "text-center">
			<h1>Join us Today!</h1>
		</div>
			<form role="form" action = "jumpage.php" method = "POST">
			  <div class="form-group">
			    <label for="username">Username</label>
			    <input type="username" class="form-control" id="email">
			  </div>
			  <div class="form-group">
			    <label for="email">Email Address</label>
			    <input type="email" class="form-control" id="email" placeholder = "netid@cornell.edu">
			  </div>
			  <div class="form-group">
			    <label for="pwd">Password</label>
			    <input type="password" class="form-control" id="pwd">
			  </div>
			  <label for="Alumni">Are you an Alumni or Student?</label>
			  <select class="form-control" id="sel1" name="alumni">
				<option value = "alu">Alumni</option>
				<option value = "stu">Student</option>
			  </select>
			  <br></br>
			  <div class = "col-sm-offset-10 col-sm-2">
				<button type="submit" class="btn btn-default">Create an Account</button>
			  </div>
			</form>
		</div>
		
	</div>
<?php
  include("footer.php");
?>

</body>
</html>