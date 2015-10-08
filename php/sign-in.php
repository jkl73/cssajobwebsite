<!DOCTYPE html>
<html lang="en">
<head>
  <title>CSSA sign in page</title>
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

	<div class = "container" >
		<div class="col-sm-8">
			<div class="row">
				<img src="../image/haha.jpg">
			</div>
		</div>
		<div class = "col-sm-4">
			<div class = "text-center">
				<h1 >Sign in</h1>
			</div>
			
			<form role="form" action = "index.php">
			  <div class="form-group">
			    <label for="email">Username or Email</label>
			    <input type="email" class="form-control" id="email">
			  </div>
			  <div class="form-group">
			    <label for="pwd">Password</label>
			    <input type="password" class="form-control" id="pwd">
			  </div>
			  <div class="checkbox">
			    <label><input type="checkbox"> Remember me</label>
			  </div>
			  <div class = "text-right">
				<button type="submit" class="btn btn-default" >Sign In</button>
			  </div>

			</form>
		</div>		
	</div>

<?php
  include("footer.php");
?>
</body>
</html>