<!DOCTYPE HTML>
<head>
	<title>Alumni Profile</title>
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
  include("header.php");
?>

	<div class="profile">
		<div class="container">
			<form class="form" role="form">
				<label for="major">Your major:</label>
		  		<div class="form-group">
		    		<select name="major" id="major" class="form-control">
	                    <option value="">---Please select your major---</option>
	                    <option value="cs">Computer Science</option>
	                    <option value="ece">Electrical and Computer Engineering</option>
	                    <option value="is">Information Science</option>
	                </select> 
		  		</div>
		  		<label for="graduation-year">Graduation Year:</label>
			  	<div class="form-group">
			  		<div class="col-sm-6 month">
				  		<select name="job-type" id="job-type" class="form-control">
				  			<option value="">---Month---</option>
	                        <option value="january">January</option>
						    <option value="february">February</option>
						    <option value="march">March</option>
						    <option value="april">April</option>
						    <option value="may">May</option>
						    <option value="june">June</option>
						    <option value="july">July</option>
						    <option value="august">August</option>
						    <option value="september">September</option>
						    <option value="october">October</option>
						    <option value="november">November</option>
						    <option value="december">December</option>
	                    </select>
	            	</div>
	            	<div class="col-sm-6 year">
	                    <select name="job-type" id="job-type" class="form-control">
				  			<option value="">---Year---</option>
	                        <option value="2015">2015</option>
	                        <option value="2016">2016</option>
	                        <option value="2017">2017</option>
	                    </select>
	            	</div>
			  	</div>
			  	<button type="submit" class="btn">Cancel</button>
			  	<button type="submit" class="btn">Update</button>
	 		</form>
	  	</div>
  	</div>
<?php
  include("footer.php");
?>

</body>
</html>
