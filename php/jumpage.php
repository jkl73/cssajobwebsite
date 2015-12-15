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
	$type = $_POST["user_type"];
	$name = $_POST["username"];
	$email = $_POST["email"];
	$pwd = $_POST["pwd"];
	
	
	include_once("header.php");

	$stu_res = sql_get_stuInfo_byEmail($email);
	$emp_res = sql_get_empInfo_byEmail($email);

	if($stu_res || $emp_res){	//check if email already used
		print "Email used";
		exit;
	}
	session_start();
	$_SESSION["email"] = $email;

	$_SESSION["type"] = $type;
	$hash = md5(rand(0,1000));


	/*==== send email verifi ====*/
	/*===========================*/
	
	// to user email
	$to = $email; // Send email to our user

	require('./PHPMailer/PHPMailerAutoload.php');
	require_once('./PHPMailer/class.smtp.php');
	
	$mail=new PHPMailer();
	$mail->IsSMTP();

	$mail->CharSet = 'UTF-8';

	$body = 'Hello ' . $name . ',<br><br>
	Thank you for sign up CSSA job website!<br>
	Please Click the link to verfiy your email:<br><br>
	<a href="http://54.164.107.204/php/verify.php?email='.$email.'&hash='.$hash.'">http://54.164.107.204/php/verify.php?email='.$email.'&hash='.$hash.'</a><br><br>
	--CSSA team';

	$email_login_info = parse_ini_file("email_login.ini");

	try {
		// now its unsecure
		$mail->SMTPSecure = 'tls';

		$mail->Port       = $email_login_info['port'];
		$mail->SMTPDebug  = 1;
		$mail->SMTPAuth   = true;
		$mail->Host       = $email_login_info['host'];

		$mail->Username   = $email_login_info['login'];
		$mail->Password   = $email_login_info['password'];

		$mail->SetFrom('superseteam@gmail.com', 'no-reply');

		$mail->AddReplyTo('superseteam@gmail.com','no-reply');
		$mail->Subject    = 'Verifiy your Email - CSSA Career';

		$mail->MsgHTML($body);
		$mail->SMTPDebug = false;
		$mail->AddAddress($to);

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

	//Insert information
	if($type == 'emp'){
		sql_insert_userInfo($email,$name,$pwd,1, $hash);
		sql_insert_empInfo($email,$name,$hash,$pwd);
		include_once("empp.php");
			//$query = "INSERT INTO employer(name, email, hash, verified, password) VALUES('".$name."','".$email. "', '".$hash."', 0, '".$pwd."')";
	}
	else if($type == 'stu'){
		sql_insert_userInfo($email,$name,$pwd,2, $hash);
		sql_insert_stuInfo($email,$name,$hash,$pwd,$type);
		include_once("stup.php");
			//$query = "INSERT INTO student(name, email, hash, verified, password) VALUES('".$name."','".$email. "','".$hash."', 0 ,'".$pwd."')";
	}
	$hidden_form = '<input type="hidden" name="email" value="'.$email.'">';
	echo $hidden_form;
	
	?>

			</form>
		</div>
	</div>


<?php
  include_once("footer.php");
?>

</body>
</html>