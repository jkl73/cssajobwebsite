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

  include("header.php");
  include("sqlfuncs.php");
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

	if(isset($_POST['submit']))
	{
   		display();
	} 
?>
<div class = "row">

</div>
<div class="row" >
	<h2>Settings</h2>
<div class="col-xs-12 col-sm-6 col-md-8" style = "overflow:scroll; height:450px">
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
		echo '<div class = "container col-sm-offset-2 col-sm-6 col-sm-offset-3" >';
		echo '<div class = "text-center">';
		echo '</div>';
		echo '<form class="form-inline" role="form" method="post" action="settings.php">
    		<div class="form-group">
      			<label for="name">Name:</label>
      			<input name="name" class="form-control" id="name" value="'.$row["name"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_name">Edit</button>
  		 </form>';

  		echo '<form class="form-inline" role="form" method="post" action="settings.php">
    		<div class="form-group">
      			<label for="major">Major:</label>
      			<input name="major" class="form-control" id="major" value="'.$row["major"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_major">Edit</button>
  		 </form>';
  		echo '<form class="form-inline" role="form" method="post" action="settings.php">
    		<div class="form-group">
      			<label for="year">Graduate Year:</label>
      			<input name="year" class="form-control" id="year" value="'.$row["grad_year"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_year">Edit</button>
  		 </form>';
  		echo '<form class="form-inline" role="form" method="post" action="settings.php">
    		<div class="form-group">
      			<label for="degree">Degree:</label>
      			<input name="degree" class="form-control" id="degree" value="'.$row["degree"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_degree">Edit</button>
  		 </form>';
  		echo '<form class="form-inline" role="form" method="post" action="settings.php">
    		<div class="form-group">
    			<label for="job">Searching Job:</label>
      			<select name="job" id="job" class="form-control">
	                    <option value="">---Please select---</option>
	                    <option value="1">Full-time job</option>
	                    <option value="2">Part-time job</option>
	                    <option value="3">Internship</option>
	            </select>
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_job">Edit</button>
  		 </form>';
  	}
  	else
  	{
  		echo '<div class = "container col-sm-offset-2 col-sm-6 col-sm-offset-3" >';
		echo '<div class = "text-center">';
		echo '</div>';
		echo '<form class="form-inline" role="form" method="post" action="settings.php">
    		<div class="form-group">
      			<label for="name">Name:</label>
      			<input name="name" class="form-control" id="name" value="'.$row["name"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_name">Edit</button>
  		 </form>';

  		echo '<form class="form-inline" role="form" method="post" action="settings.php">
    		<div class="form-group">
      			<label for="company">Company:</label>
      			<input name="company" class="form-control" id="company" value="'.$row["company"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_company">Edit</button>
  		 </form>';
  		
  		echo '<form class="form-inline" role="form" method="post" action="settings.php">
    		<div class="form-group">
      			<label for="position">Position:</label>
      			<input name="position" class="form-control" id="position" value="'.$row["position"].'"">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_position">Edit</button>
  		 </form>';
  		echo '<form class="form-inline" role="form" method="post" action="settings.php">
    		<div class="form-group">
      			<label for="Linkedin">Linkedin:</label>
      			<input name="Linkedin" class="form-control" id="Linkedin" value="'.$row["Linkedin"].'"">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_linkedin">Edit</button>
  		 </form>';
  		 echo '<form class="form-inline" role="form" method="post" action="settings.php">
    		<div class="form-group">
      			<label for="year">Graduate Year:</label>
      			<input name="year" class="form-control" id="year" value="'.$row["grad_year"].'">
    		</div>
    	 	<button type="submit" class="btn btn-default" name="submit_year">Edit</button>
  		 </form>';
  	}
  	
?>
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
		echo '<li class="list-group-item">Degree: '.$row["degree"].'</li>';
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
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
  	include("footer.php");
?>

</body>
</html>
<?php
function Display_all_query()
{
	$conn = getconn();
	$stmt = $conn->prepare("select * from post_info order by time DESC;");
	$result = $stmt->execute();
	if (!$result)
    {
        echo "What the fuck?";
        pdo_die($stmt);
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Print_Post($result);
}
?>