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

   <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
   <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
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
?>

	
<?php

	if(isset($_POST['submit']))
	{
    
		if ($_SESSION["type"]=="stu") {
      
        $conn = getconn();
        $code = "0";
        if (isset($_POST['check1']) || isset($_POST['check2'])) {
          $code = "31";
        }
        $stmt = $conn->prepare("update student as s, user as u set u.name='".$_POST['name']."', s.name='".$_POST['name']."', first_name='".$_POST['first_name']."' ,
          last_name='".$_POST['last_name']."', middle_name='".$_POST['middle_name']."', phone_number='".$_POST['phone_number']."', 
          address='".$_POST['address']."', grad_year='".$_POST['year']."-".$_POST['month']."-00"."', major='".$_POST['major']."', 
          degree='".$_POST['degree']."', Linkedin='".$_POST['Linkedin']."', code='".$code."' where s.email=:myemail and u.email=:myemail");
      
        $stmt->bindParam(":myemail",$myemail);
        $result = $stmt->execute();
        if (!$result) {
          echo "what the hell2!";
          pdo_die($stmt);
        }
      }
      else {
        $conn = getconn();
        $code = "0";
        if (isset($_POST['check1']) || isset($_POST['check2'])) {
          $code = "31";
        }
        $stmt = $conn->prepare("update employer as s, user as u set u.name='".$_POST['name']."', s.name='".$_POST['name']."', first_name='".$_POST['first_name']."' ,
          last_name='".$_POST['last_name']."', middle_name='".$_POST['middle_name']."', phone_number='".$_POST['phone_number']."', 
          address='".$_POST['address']."', position='".$_POST['position']."', 
          company='".$_POST['company']."', Linkedin='".$_POST['Linkedin']."', code='".$code."' where s.email=:myemail and u.email=:myemail");
      
        $stmt->bindParam(":myemail",$myemail);
        $result = $stmt->execute();
        if (!$result) {
          echo "what the hell2!";
          pdo_die($stmt);
        }
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
    echo '<div class="profile">
            <div class="container">';
    echo '<form class="form " role="form" method="post" action="settings.php">
        <div class="form-group">
            <label for="checkbox">Do you want to set your profile public to others?</label>
            <label class="checkbox" name="check1" value="value1">';
    if($row['code'] > 0) {
        echo '<input checked data-toggle="toggle" data-on="Yes" data-off="No" type="checkbox" name="check1" value="value1">';
    } else {
        echo '<input data-toggle="toggle" data-on="Yes" data-off="No" type="checkbox" name="check2" value="value2">';
    }
    echo        '</label>
        </div>
        <div class="form-group">
            <label for="name">User Name:</label>
            <input name="name" value="'.$row["name"].'" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input name="first_name" value="'.$row["first_name"].'" class="form-control" id="first_name">
        </div>
        <div class="form-group">
            <label for="middle_name">Middle Name:</label>
            <input name="middle_name" value="'.$row["middle_name"].'" class="form-control" id="middle_name">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input name="last_name" value="'.$row["last_name"].'" class="form-control" id="last_name">
        </div>
        <div class="form-group ">
            <label for="phone_number">Phone Number:</label>
            <input name="phone_number" value="'.$row["phone_number"].'" class="form-control" id="phone_number">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input name="address" value="'.$row["address"].'" class="form-control" id="address">
        </div>
        
        <label for="graduation-year">Graduation Year: </label>
          <div class="form-group">
            <div class="col-sm-6 month">
              <select name="month" id="month" class="form-control">
                <option value="">---Month---</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
                      </select>
                </div>
                <div class="col-sm-6 year">
              <select name="year" id="year" class="form-control">
                <option value="">---Year---</option>
                          <option value="2015">2015</option>
                          <option value="2016">2016</option>
                          <option value="2017">2017</option>
                      </select>
                </div>
          </div>
        <div class="form-group">
            <label for="major">Major:</label>
            <input name="major" value="'.$row["major"].'" class="form-control" id="major">
        </div>
        <div class="form-group">
            <label for="degree">Degree:</label>
            <input name="degree" value="'.$row["degree"].'" class="form-control" id="degree">
        </div>
        <div class="form-group">
            <label for="Linkedin">Linkedin URL:</label>
            <input name="Linkedin" value="'.$row["Linkedin"].'" class="form-control" id="Linkedin">
        </div>
         
        <button type="submit" class="btn btn-default" name="submit">Update</button>
       </form>';
       echo '</div>
          </div>';

  	}
    
  	else
  	{
  		echo '<div>';

		  echo '<div>';
    echo '<div class="profile">
            <div class="container">';
    echo '<form class="form " role="form" method="post" action="settings.php">
        <div class="form-group">
            <label for="checkbox">Do you want to set your profile public to others?</label>
            <label class="checkbox" name="check1" value="value1">';
    if($row['code'] > 0) {
        echo '<input checked data-toggle="toggle" data-on="Yes" data-off="No" type="checkbox" name="check1" value="value1">';
    } else {
        echo '<input data-toggle="toggle" data-on="Yes" data-off="No" type="checkbox" name="check2" value="value2">';
    }
    echo        '</label>
        </div>
        <div class="form-group">
            <label for="name">User Name:</label>
            <input name="name" value="'.$row["name"].'" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input name="first_name" value="'.$row["first_name"].'" class="form-control" id="first_name">
        </div>
        <div class="form-group">
            <label for="middle_name">Middle Name:</label>
            <input name="middle_name" value="'.$row["middle_name"].'" class="form-control" id="middle_name">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input name="last_name" value="'.$row["last_name"].'" class="form-control" id="last_name">
        </div>
        <div class="form-group ">
            <label for="phone_number">Phone Number:</label>
            <input name="phone_number" value="'.$row["phone_number"].'" class="form-control" id="phone_number">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input name="address" value="'.$row["address"].'" class="form-control" id="address">
        </div>
        
        
        <div class="form-group">
            <label for="company">Company:</label>
            <input name="company" value="'.$row["company"].'" class="form-control" id="company">
        </div>
        <div class="form-group">
            <label for="position">Position:</label>
            <input name="position" value="'.$row["position"].'" class="form-control" id="position">
        </div>
        <div class="form-group">
            <label for="Linkedin">Linkedin URL:</label>
            <input name="Linkedin" value="'.$row["Linkedin"].'" class="form-control" id="Linkedin">
        </div>
         
        <button type="submit" class="btn btn-default" name="submit">Update</button>
       </form>';
       echo '</div></div>
          </div>';
  	}
  	
?>
</div>

<?	

	echo '</div>';



  	include_once("footer.php");
?>

</body>
</html>