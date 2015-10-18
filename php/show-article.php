<!DOCTYPE HTML>
<head>
 <title>Cornell CSSA Jobs site</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
     <link rel="stylesheet" href="../css/main.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
 <style>
 </style>
</head>

<body>
<?php
  session_start();
  include("./header.php");
?>

<?php
	include("./sqlfuncs.php");

	if (!isset($_GET['postid'])) {
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
		echo "<h2 align=center>No such article found</h2>";
		exit();
	}
	$conn = getconn();

    $stmt = $conn->prepare("select * from post_info where postid=:id");
    $stmt->bindParam(":id", $_GET['postid']);

    $result = $stmt->execute();
    
    if (!$result)
        pdo_die($stmt);

    $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo '<div class="showarticle">';
    echo '<h3>'. $rset[0]['tags'] .'</h3>';
    echo '<h4>Company: '. $rset[0]['company'] .'</h4>';
    echo '<h4>Job position: '. $rset[0]['position'] .'</h4>';
    echo '<h4>Email: '. $rset[0]['email'] .'</h4>';

    echo '<h6>This job has been viewed '. $rset[0]['visit'] .' times</h6>';


    $stmt = $conn->prepare("select * from post_content where postid=:id");
    $stmt->bindParam(":id", $_GET['postid']);

    $result = $stmt->execute();
    
    if (!$result)
        pdo_die($stmt);

    $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<p>'.$rset[0]['content'].'</p>';
    echo '<hr style="width: 100%; color: black; height: 1px; background-color:black;" />';
    echo '<p><i>people you may want to connect...</i></p>';
    echo '<div class="recmdp">';
    echo '<div class="pic">';
    echo '<div class="text">';
    echo 'Get<br>';
    echo 'Connect';
    echo '</div>';
    echo '</div>';
    echo '<span class="recmddescip">';
    echo 'Mike';
    echo '</span>';
    echo '<span class="recmddescip">';
    echo 'google';
    echo '</span>';
    echo '</div>';

    echo '<div class="recmdp">';
    echo '<div class="pic">';
    echo '<div class="text">';
    echo 'Get<br>';
    echo 'Connect';
    echo '</div>';
    echo '</div>';
    echo '<span class="recmddescip">';
    echo 'Jay';
    echo '</span>';
    echo '<span class="recmddescip">';
    echo 'google';
    echo '</span>';
    echo '</div>';

    echo '</div>';
	sql_update_visit($_GET['postid']);

?>

<?php
  include("./footer.php");
?>
</body>