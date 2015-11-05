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
    if(isset($_POST["submit"]))
    {
        sql_add_reply($_SESSION["email"],$_POST["reply_content"],$_GET['postid']);
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
    echo '<h4>Time:'.$rset[0]['time'].'</h4>';

    echo '<h6>This job has been viewed '. $rset[0]['visit'] .' times</h6>';


    $stmt = $conn->prepare("select * from post_content where postid=:id");
    $stmt->bindParam(":id", $_GET['postid']);

    $result = $stmt->execute();
    
    if (!$result)
        pdo_die($stmt);

    $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<div class="panel panel-default">';
    echo '<div class="panel-heading">content</div>';
    echo '<div class="panel-body">'.$rset[0]['content'].'</div>';
    echo '</div>';


    $rset = sql_get_reply($_GET['postid']);
    $cnt = 0;
    foreach ($rset as $row) {
        $cnt = $cnt+1;
        if($cnt == 1)
            echo "<h4>Reply List</h4>";

        echo '<div class="panel panel-default">';
        echo '<div class="panel-heading">Floor '.$cnt.'</div>';
        echo '<div class="panel-body">';
        echo '<a href="#">'.$row['email'].'</a>:'.$row['content'].'</div>';
        echo '<p style="font-size : 70%">Time:'.$row['time'].'</p>';
        echo '</div>';
        
    }
    /*while($row = $rset->fetch_assoc()) {
        echo '<hr style="width: 100%; color: black; height: 1px; background-color:black;" />';
        echo '<p>'.$row['content'].'</p>';
        echo '<p style="fontsize = %50">Time:'.$row['time'].'</p>';
    }*/

    echo "<div class=\"jobpostform\">";
    echo "<h3 align=\"center\">Post a reply</h2>";
    echo '<form method=post action=show-article.php?postid='. $_GET["postid"].'>';
    echo '<div class="row">';
    echo '<div align="right" class="col-md-2 col-xs-2">Reply:</div>';
    echo '<div class="col-md-8 col-xs-10"><textarea class="form-control" name=reply_content style="margin: 0px; width: 100%; height: 140px;" required></textarea>';
    
    echo '<input id="loginbutton" class="btn btn-primary btn-lg" type=submit name=submit value=reply></div>';
    echo '</div>';
    echo '</form>';
    echo '</div>';

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