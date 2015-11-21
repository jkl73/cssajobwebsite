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
  echo '<h1>Profile Page</h1>';
  $myInfo = sql_get_userInfo_byEmail($myemail);

	if(isset($_GET['uid']))
	{
   	display_profile($_GET['uid']);
    if($_GET['uid'] == $myInfo[0]['uid'])
    {
      ?>
      <p><a href='settings.php'>Edit your profile</a>
      <?php
    }
	}
  else
  {
    display_profile($myInfo[0]['uid']);
    ?>
      <p><a href='settings.php'>Edit your profile</a>
    <?php
  }

?>
</div>
<?php
  	include_once("footer.php");
    function display_profile($uid)
    {
      $result = sql_get_profile_byID($uid);
      if(count($result)==0)
      {
        echo '<h2><b>No such user!!</b></h2>';
        return;
      }
      if($result[0]['type'] == 0)
      {
        echo '<h2><b>Admin don\'t have a profile!!!</b></h2>';
        return;
      }
      else if($result[0]['type'] == 2)
      {
        $res = sql_get_stuInfo_byEmail($result[0]['email']);
        Display_stu($res);
      }
      else if($result[0]['type'] == 1)
      {
        $res = sql_get_empInfo_byEmail($result[0]['email']);
        Display_emp($res);
      }
    }

    function sql_get_profile_byID($uid)
    {
      $conn = getconn();
      $stmt = $conn->prepare("select * from user where uid = ".$uid);

      $result = $stmt->execute();
      if (!$result)
          pdo_die($stmt);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    function Display_stu($res)
    {
      $row = $res[0];
      $code = decode_public($res[0]['code']);
      $isAdmin = admin_byEmail($_SESSION['email']);
      $myEmail = ($res[0]['email']==$_SESSION['email']);
      echo '<ul class="list-group">';
      echo '<li class="list-group-item"><b>Name</b>: '.$row["first_name"].' '.$row["last_name"].'</li>';
      echo '<li class="list-group-item"><b>Username</b>: '.$row["name"].'</li>';
      if($myEmail || $isAdmin || $code[0]==1)echo '<li class="list-group-item"><b>Phone number</b>: '.$row["phone_number"].'</li>';
      if($myEmail || $isAdmin || $code[1]==1)echo '<li class="list-group-item"><b>Address</b>: '.$row["address"].'</li>';
      if($myEmail || $isAdmin || $code[2]==1)echo '<li class="list-group-item"><b>LinkedIn hompage</b>: '.$row["Linkedin"].'</li>';
      if($myEmail || $isAdmin || $code[3]==1)echo '<li class="list-group-item"><b>Expected Graduation Year</b>: '.substr($row["grad_year"], 0, 7).'</li>';
      if($myEmail || $isAdmin || $code[4]==1)echo '<li class="list-group-item"><b>Major</b>: '.$row["major"].'</li>';
      echo '</ul>';
    }

    function Display_emp($res)
    {
      $row = $res[0];
      $code = decode_public($res[0]['code']);
      $isAdmin = admin_byEmail($_SESSION['email']);
      $myEmail = ($res[0]['email']==$_SESSION['email']);
      echo '<ul class="list-group">';
      echo '<li class="list-group-item"><b>Name</b>: '.$row["first_name"].' '.$row["last_name"].'</li>';
      echo '<li class="list-group-item"><b>Username</b>: '.$row["name"].'</li>';
      if($myEmail || $isAdmin || $code[0]==1)echo '<li class="list-group-item"><b>Phone number</b>: '.$row["phone_number"].'</li>';
      if($myEmail || $isAdmin || $code[1]==1)echo '<li class="list-group-item"><b>Address</b>: '.$row["address"].'</li>';
      if($myEmail || $isAdmin || $code[2]==1)echo '<li class="list-group-item"><b>LinkedIn hompage</b>: '.$row["Linkedin"].'</li>';
      if($myEmail || $isAdmin || $code[3]==1)echo '<li class="list-group-item"><b>Company Name</b>: '.$row["company"].'</li>';
      if($myEmail || $isAdmin || $code[4]==1)echo '<li class="list-group-item"><b>Position</b>: '.$row["position"].'</li>';
      echo '</ul>';
    }

    function encode_public($array)
    {
      $num = 5;//count($array);
      $res = 0;
      for($i=0;i<$num;$i++)
      {
        $res = ($res<<1)&$array[$i];
      }
      return $res;
    }

    function decode_public($code)
    {
      $num = 5;
      $array = array();
      for($i=0;$i<$num;$i++)
      {
        $array[$num-1-$i] = $code & 1;
        $code >>= 1;
      }
      return $array;
    }
?>

</body>
</html>