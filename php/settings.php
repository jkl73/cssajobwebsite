<!DOCTYPE HTML>
<head>
	<title>Settings</title>
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
	echo '<div style="width:700px; margin:auto" class = "container">';

	if(isset($_POST['submit']))
	{
   		display();
	} 
?>

	<div class="row">
		<h2 class="col-xs-4 col-sm-4 col-md-4 setting-item">Settings</h2>
	</div>
<?php
	function update($key, $val, $email)
	{
		
    	$conn = getconn();

    	if ($_SESSION["type"]=="stu") {
    		if ($key == "name")
    			$stmt = $conn->prepare("update user, student set user.name='".$val."', student.name='".$val."' where user.email=:myemail and user.email=student.email");
        	else 
        		$stmt = $conn->prepare("update student set ".$key."='".$val."' where email=:myemail");
    	} else {
    		if ($key == "name")
    			$stmt = $conn->prepare("update user, employer set user.name='".$val."', employer.name='".$val."' where user.email=:myemail and user.email=employer.email");
    		else
        		$stmt = $conn->prepare("update employer set ".$key."='".$val."' where email=:myemail");
    	}

    	$stmt->bindParam(":myemail",$email);

    	$result = $stmt->execute();
    	if (!$result)
        	pdo_die($stmt);

	}

	if(isset($_POST['submit_name']))
	{
		if ($_POST['name'] != "") 
		{
   			update("name", $_POST['name'], $myemail);
   		}
	} else if(isset($_POST['submit_major'])) {
		if ($_POST['major'] != "")
		{
			update("major", $_POST['major'], $myemail);
		}
	} else if(isset($_POST['submit_year'])) {
		if ($_POST['year'] != "")
		{
			update("grad_year", $_POST['year'], $myemail);
		}
	} else if(isset($_POST['submit_degree'])) {
		if ($_POST['degree'] != "")
		{
			update("degree", $_POST['degree'], $myemail);
		}
	} else if(isset($_POST['submit_job'])) {
		if ($_POST['job'] != "")
		{
			update("job_type", $_POST['job'], $myemail);
		}
	} else if(isset($_POST['submit_company'])) {
		if ($_POST['company'] != "")
		{
			update("company", $_POST['company'], $myemail);
		}
	} else if(isset($_POST['submit_position'])) {
		if ($_POST['position'] != "")
		{
			update("position", $_POST['position'], $myemail);
		}
	} else if(isset($_POST['submit_linkedin'])) {
		if ($_POST['Linkedin'] != "")
		{
			update("Linkedin", $_POST['Linkedin'], $myemail);
		}
	} 
?>

<?php
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
	if ($_SESSION["type"]=="stu") {
		echo '<div>';

		echo '<div class="row setting-row"><form class="form-inline" role="form" method="post" action="settings.php">

			<div class="col-xs-4 col-sm-4 col-md-4 setting-item"><h5>Name:</h5></div>

    		<div class="col-xs-4 col-sm-4 col-md-4 form-group">
      			<input name="name" class="form-control" id="name" value="'.$row["name"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_name">Edit</button>
  		 </form></div>';

  		echo '<div class="row setting-row"><form class="form-inline" role="form" method="post" action="settings.php">
  					<div class="col-xs-4 col-sm-4 col-md-4 setting-item"><h5>Major:</h5></div>

    		<div class="col-xs-4 col-sm-4 col-md-4 form-group">
      			<input name="major" class="form-control" id="major" value="'.$row["major"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_major">Edit</button>
  		 </form></div>';

  		echo '<div class="row setting-row"><form class="form-inline" role="form" method="post" action="settings.php">
  					<div class="col-xs-4 col-sm-4 col-md-4 setting-item"><h5>Graduate Year:</h5></div>

    		<div class="col-xs-4 col-sm-4 col-md-4 form-group">
      			<input name="year" class="form-control" id="year" value="'.$row["grad_year"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_year">Edit</button>
  		 </form></div>';

  		echo '<div class="row setting-row"><form class="form-inline" role="form" method="post" action="settings.php">
  					<div class="col-xs-4 col-sm-4 col-md-4 setting-item"><h5>Degree:</h5></div>

    		<div class="col-xs-4 col-sm-4 col-md-4 form-group">
      			<input name="degree" class="form-control" id="degree" value="'.$row["degree"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_degree">Edit</button>
  		 </form></div>';

  		echo '<div class="row setting-row"><form class="form-inline" role="form" method="post" action="settings.php">
  					<div class="col-xs-4 col-sm-4 col-md-4 setting-item"><h5>Searching Job:</h5></div>

    		<div class="col-xs-4 col-sm-4 col-md-4 form-group">
      			<select name="job" id="job" class="form-control">
	                    <option value="">---Please select---</option>
	                    <option value="1">Full-time job</option>
	                    <option value="2">Part-time job</option>
	                    <option value="3">Internship</option>
	            </select>
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_job">Edit</button>
  		 </form></div>';
  	}
  	else
  	{
  		echo '<div>';

		echo '<div class="row setting-row"><form class="form-inline" role="form" method="post" action="settings.php">
			<div class="col-xs-4 col-sm-4 col-md-4 setting-item"><h5>Name:</h5></div>

    		<div class="col-xs-4 col-sm-4 col-md-4 form-group">
      			<input name="name" class="form-control" id="name" value="'.$row["name"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_name">Edit</button>
  		 </form></div>';

  		echo '<div class="row setting-row"><form class="form-inline" role="form" method="post" action="settings.php">
  					<div class="col-xs-4 col-sm-4 col-md-4 setting-item"><h5>Company:</h5></div>

    		<div class="col-xs-4 col-sm-4 col-md-4 form-group">
      			<input name="company" class="form-control" id="company" value="'.$row["company"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_company">Edit</button>
  		 </form></div>';
  		
  		echo '<div class="row setting-row"><form class="form-inline" role="form" method="post" action="settings.php">
  					<div class="col-xs-4 col-sm-4 col-md-4 setting-item"><h5>Position:</h5></div>

    		<div class="col-xs-4 col-sm-4 col-md-4 form-group">
      			<input name="position" class="form-control" id="position" value="'.$row["position"].'"">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_position">Edit</button>
  		 </form></div>';

  		echo '<div class="row setting-row"><form class="form-inline" role="form" method="post" action="settings.php">
  					<div class="col-xs-4 col-sm-4 col-md-4 setting-item"><h5>Linkedin:</h5></div>

    		<div class="col-xs-4 col-sm-4 col-md-4 form-group">
      			<input name="Linkedin" class="form-control" id="Linkedin" value="'.$row["Linkedin"].'"">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_linkedin">Edit</button>
  		 </form></div>';

  		 echo '<div class="row setting-row"><form class="form-inline" role="form" method="post" action="settings.php">
  		 			<div class="col-xs-4 col-sm-4 col-md-4 setting-item"><h5>Graduate Year:</h5></div>

    		<div class="col-xs-4 col-sm-4 col-md-4 form-group">
      			<input name="year" class="form-control" id="year" value="'.$row["grad_year"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_year">Edit</button>
  		 </form></div>';
  	}
  	
?>
</div>

<?	

	echo '</div>';



  	include_once("footer.php");
?>

</body>
</html>