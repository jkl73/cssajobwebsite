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
	<?php
	//$server = mysql_connect("localhost", "root", "1qaz-pl,"); 
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

	$type = $_POST["alumni"];
	$name = $_POST["username"];
	$email = $_POST["email"];
	$pwd = $_POST["pwd"];

	$query = "select * from employer E,student S where S.email ='". $email. "' || E.email ='". $email. "';";
	$result = mysql_query($query);
	if(!$result){
		print "Error- Judge failed";
		$error = mysql_error();
		print "<p>". $error . "</p>";
		exit;		
	}

	$row = mysql_fetch_array($result);
	if($row){
		print "Email used";
		exit;
	}

	$hash = md5(rand(0,1000));

	if($type == 'alu'){
			$query = "INSERT INTO employer(name, email, password) VALUES('".$name."','".$email. "','".$pwd."')";
	}
	else if($type == 'stu'){
			$query = "INSERT INTO student(name, email, password) VALUES('".$name."','".$email. "','".$pwd."')";
	}

	/*==== send email verifi ====*/
	/*===========================*/
	// to user email
	$to = "jl3387@cornell.edu"; // Send email to our user

	require('./PHPMailer/PHPMailerAutoload.php');
	$mail=new PHPMailer();
	$mail->CharSet = 'UTF-8';

	$body = 'Hello ' . $name . ',<br><br>

	Thank you for sign up CSSA job website!<br>
	Please Click the link to verfiy your email:<br><br>
	http://localhost/cssajobwebsite/php/verify.php?email='.$email.'&hash='.$hash.'<br><br>
	--CSSA team';

	try {
		$mail->IsSMTP();
		$mail->Host       = 'smtp.ecloudpanel.com';

		$mail->SMTPSecure = 'tls';
		$mail->Port       = 587;
		$mail->SMTPDebug  = 1;
		$mail->SMTPAuth   = true;

		$mail->Username   = 'no-reply@jiankun.lu';
		$mail->Password   = 'charles309226';

		$mail->SetFrom('me.sender@gmail.com', 'no-reply');

		$mail->AddReplyTo('no-reply@mycomp.com','no-reply');
		$mail->Subject    = 'Verifiy your Email';

		$mail->MsgHTML($body);
		$mail->SMTPDebug = false;
		$mail->AddAddress($to, 'title1');

		//$mail->AddAttachment($fileName);
		$mail->send();
		echo "<div class='container'>Verification email sent! Please check your mailbox</div>";
	}catch (phpmailerException $e) {
		echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
		echo $e->getMessage(); //Boring error messages from anything else!
	}
	/*=============================*/
	/*=============================*/

	$query = stripslashes($query);
	$result = mysql_query($query);
	if(!$result){
		print "Error- Inserting into student/employer failed";
		$error = mysql_error();
		print "<p>". $error . "</p>";
		exit;		
	}
    $_SESSION["email"] = $email;

	if ($type == 'alu'){
		include("alup.php");
	    $_SESSION["type"] = "alu";
	}
	else{
		include("stup.php");
		$_SESSION["type"] = "stu";
	}
	$hidden_form = "<input type=\"hidden\" name=\"email\" value=\"".$email."\">";
	echo $hidden_form;
	/*
	$query = "select * from user_info";
	$result = mysql_query($query);
	print "<table border = 1><caption> <h2> All User Info </h2> </caption>"; 
	print "<tr align = 'center'>";


	print "<tr align = 'center'><th>email</th><th>username</th><th>password</th></tr>";
	while($row = mysql_fetch_array($result)){
		$num_fields = sizeof($row);
		reset($row); 
		print "<tr align = 'center'>"; 
		for ($field_num = 0; $field_num < $num_fields/2 ; $field_num++) 
			print "<td>" . $row[$field_num] . "</td> "; 
		print "</tr>"; 
	} 
	print "</table>";*/
	?>

			</form>
		</div>
	</div>


<?php
  include("footer.php");
?>

</body>
</html>