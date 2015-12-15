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
	 <link rel="stylesheet" href="../css/main.css">
 <script src="js/main.js"></script>
  <style>
  </style>

</head>

<body>
<?php
  include_once("header.php");
?>
	<div class = "container col-sm-offset-3 col-sm-6 col-sm-offset-3" >
		<div class = "text-center">
			<h1>Join us Today!</h1>
		</div>
			<form role="form" action = "jumpage.php" onSubmit = "return checkSubmit()" method = "POST">
			  <div class="form-group">
			    <label for="username">Username</label>
			    <input name = "username" type="username" class="form-control" id="username">
			  </div>
			  <div class="form-group">
			    <label for="email">Email Address</label>
			    <input name = "email" type="email" class="form-control" id="email" placeholder = "netid@cornell.edu">
			  </div>
			  <div class="form-group">
			    <label for="pwd">Password</label>
			    <input name = "pwd" type="password" class="form-control" id="pwd">
			  </div>
			  <label for="Employer">Are you an Employer, Student or Alumni?</label>
			  <select class="form-control" id="sel1" name="user_type">
				<option value = "stu">Student</option>
				<option value = "alu">Alumni</option>
				<option value = "emp">Employer/Recruiter/Other</option>
			  </select>
			  <br></br>
			  <div class = "col-sm-offset-10 col-sm-2">
				<button type="submit" class="btn btn-default">Create an Account</button>
			  </div>
			</form>
			<p style = "color: red" id="text-alert"></p>
		</div>
		
	</div>
	<script language="javascript">
     function checkSubmit() {
     	/*
     	functionality: validating input
     	t for alerting message html area,
     	p is the current information area we are checking.
     	*/
       var t = document.getElementById("text-alert");
       var p = document.getElementById("email");
       var type = document.getElementById("sel1");
       if(p.value == "" || p.value == null) //forbid and alert for empty input
       {
        t.innerHTML = "Please input email!";
        return false;
       }
       var patt=/[a-z]+[0-9]+@cornell.edu$/;
	   if (!patt.test(p.value) && type.value != "emp"){ //forbid and alert for non cornell email for stu/alu
	   	t.innerHTML = "Please input a Cornell Email (exp. netID@cornell.edu)";
	   	return false;
	   }
       p = document.getElementById("pwd");
       if(p.value == "" || p.value == null) 
       {
        t.innerHTML = "Please input password!";
        return false;
       }
       p = document.getElementById("username");
       if(p.value == "" || p.value == null) 
       {
        t.innerHTML = "Please input username!";
        return false;
       }
       return true;
    }
   </script>
<?php
  include_once("footer.php");
?>

</body>
</html>