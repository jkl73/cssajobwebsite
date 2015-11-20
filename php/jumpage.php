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
	include_once("sqlfuncs.php");
	$type = $_POST["employer"];
	$name = $_POST["username"];
	$email = $_POST["email"];
	$pwd = $_POST["pwd"];
	session_start();
	$_SESSION["email"] = $email;

	if ($type == 'emp'){
		$_SESSION["type"] = "emp";
	}
	else{
		$_SESSION["type"] = "stu";
	}

	include_once("header.php");

	$stu_res = sql_get_stuInfo_byEmail($email);
	$emp_res = sql_get_empInfo_byEmail($email);

	if($stu_res || $emp_res){
		print "Email used";
		exit;
	}

	$hash = md5(rand(0,1000));


	/*==== send email verifi ====*/
	/*===========================*/
	
	// to user email
	$to = $email; // Send email to our user

	require('./PHPMailer/PHPMailerAutoload.php');
	$mail=new PHPMailer();
	$mail->CharSet = 'UTF-8';

	$body = 'Hello ' . $name . ',<br><br>
	Thank you for sign up CSSA job website!<br>
	Please Click the link to verfiy your email:<br><br>
	http://localhost/cssajobwebsite/php/verify.php?email='.$email.'&hash='.$hash.'&type='.$type.'    <br><br>
	--CSSA team';

	// $body = 'Hello ' . $name . ',<br><br>
	// Thank you for sign up CSSA job website!<br>
	// Please Click the link to verfiy your email:<br><br>
	// http://54.164.107.204/cssajobwebsite/php/verify.php?email='.$email.'&hash='.$hash.'&type='.$type.'    <br><br>
	// --CSSA team';

	try {
		$mail->IsSMTP();
		$mail->Host       = 'smtp.ecloudpanel.com';

		// now its unsecure
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


	if($type == 'emp'){
		sql_insert_userInfo($email,$name,$pwd,1);
		sql_insert_empInfo($email,$name,$hash,$pwd);
		include_once("alup.php");
			//$query = "INSERT INTO employer(name, email, hash, verified, password) VALUES('".$name."','".$email. "', '".$hash."', 0, '".$pwd."')";
	}
	else if($type == 'stu'){
		sql_insert_userInfo($email,$name,$pwd,2);
		sql_insert_stuInfo($email,$name,$hash,$pwd);
		include_once("stup.php");
			//$query = "INSERT INTO student(name, email, hash, verified, password) VALUES('".$name."','".$email. "','".$hash."', 0 ,'".$pwd."')";
	}
	

	$hidden_form = '<input type="hidden" name="email" value="'.$email.'">';
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
  include_once("footer.php");
?>

</body>
</html>