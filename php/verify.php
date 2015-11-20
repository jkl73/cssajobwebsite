<?php
	include_once("./sqlfuncs.php");

	if (!isset($_GET['email']) || !isset($_GET['hash']) || !isset($_GET['type'])) {
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
		echo "<h2 align=center>BAD REQUEST</h2>";
		exit();
	}


	$conn = getconn();

	if ($_GET['type'] == 'alu') {
		$stmt = $conn->prepare("select * from employer where email=:id");
	} else{
		$stmt = $conn->prepare("select * from student where email=:id");
	}

	$stmt->bindParam(":id", $_GET['email']);

	$result = $stmt -> execute();

	if (!$result) {
		pdo_die($stmt);
	}

	$rset = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if (sizeof($rset) == 1) {
		if ($rset[0]['hash'] == $_GET['hash']) {
			if ($_GET['type'] == 'alu') {
				sql_update_verify($_GET['email'], 'alu');
			} else{
				sql_update_verify($_GET['email'], 'stu');
			}

			echo '<meta http-equiv="refresh" content="1; URL=index.php" charset="utf-8">';
			echo '<h1>You have successfully verified your email, redirect in 1s</h1>';
		} else {
			header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
			echo "<h2 align=center>BAD REQUEST</h2>";
		}
	} else {
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
		echo "<h2 align=center>BAD REQUEST</h2>";
	}
?>