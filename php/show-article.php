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
 <script type="text/javascript">

function changeDisplay(id)
{
    if (document.getElementById("show"+id).style.display == "none") {
        document.getElementById("show"+id).style.display = "inline";
        document.getElementById("packup"+id).style.display = "none";
    }
    else {
        document.getElementById("show"+id).style.display = "none";
        document.getElementById("packup"+id).style.display = "inline";
    }
}

</script>
 <style>
 </style>
</head>

<body>
<?php
  session_start();
  include_once("./header.php");
	include_once("./sqlfuncs.php");
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
	if (!isset($_GET['postid'])) {
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
		echo "<h2 align=center>No such article found</h2>";
		exit();
	}
    if(isset($_POST["submit"]))
    {
        sql_add_reply($_SESSION["email"],$_POST["reply_content"],$_GET['postid'],$_POST['parentid']);
        // add a message to notification center
        if ($_POST["replyedemail"] != $_SESSION["email"]) {
            sql_insert_notification($_POST["replyedemail"], $_GET['postid'], 0, $_SESSION["email"], $_POST["title"]);
        }
    }

	$conn = getconn();

    $stmt = $conn->prepare("update notification set readtag=1 where replyedemail='".$_SESSION['email']."' and postid=".$_GET['postid']);
    $result = $stmt->execute();    
    if (!$result)
        pdo_die($stmt);
    
    $stmt = $conn->prepare("select * from post_info where postid=:id");
    $stmt->bindParam(":id", $_GET['postid']);

    $result = $stmt->execute();
    
    if (!$result)
        pdo_die($stmt);

    $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);
    


    echo '<div class="showarticle">';
    $postEmail = $rset[0]["user_email"];
    $postTitle = $rset[0]['title'];
    if ($postTitle == NULL) {
        $postTitle = "No title";
    }
    if($myemail == $postEmail || admin_byEmail($myemail))
            echo '<form action = "editpost.php" method = post><button class="btn btn-primary" type=submit name="edit" value ='.$rset[0]["postid"].'>Edit</button></form>';
    echo '<h3>'. $rset[0]['title'] .'</h3>';
    echo '<h4>Company: '. $rset[0]['company'] .'</h4>';
    echo '<h4>Job position: '. $rset[0]['position'] .'</h4>';
    echo '<h4>Email: '. $rset[0]['email'] .'</h4>';
    echo '<h4>Time: '.$rset[0]['time'].'</h4>';
    if($rset[0]['filename'] != NULL){
        echo '<h5><a target=something href="../upload-file/post/'.rawurlencode($rset[0]['filename']).'">File:'.$rset[0]['filename'].'</a></h5>';
    }

    echo '<h6>This job has been viewed '. $rset[0]['visit'] .' times</h6>';


    $stmt = $conn->prepare("select * from post_content where postid=:id");
    $stmt->bindParam(":id", $_GET['postid']);

    $result = $stmt->execute();
    
    if (!$result)
        pdo_die($stmt);

    $rset = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<div class="panel panel-primary">';
    echo '<div class="panel-heading" style="font-size:100%">Detailed Information</div>';
    echo '<div class="panel-body">'.$rset[0]['content'].'</div>';
    echo '</div>';

    // echo '<p><i>people you may want to connect...</i></p>';
    // echo '<div class = "container">';
    // echo '<div class="recmdp">';
    // echo '<div class="pic">';
    // echo '<div class="text">';
    // echo 'Get<br>';
    // echo 'Connect';
    // echo '</div>';
    // echo '</div>';
    // echo '<span class="recmddescip">';
    // echo 'Mike';
    // echo '</span>';
    // echo '<span class="recmddescip">';
    // echo 'google';
    // echo '</span>';
    // echo '</div>';
    
    // echo '<div class="recmdp">';
    // echo '<div class="pic">';
    // echo '<div class="text">';
    // echo 'Get<br>';
    // echo 'Connect';
    // echo '</div>';
    // echo '</div>';
    // echo '<span class="recmddescip">';
    // echo 'Jay';
    // echo '</span>';
    // echo '<span class="recmddescip">';
    // echo 'google';
    // echo '</span>';
    // echo '</div>';
    // echo '</div>';

    $rset = sql_get_reply($_GET['postid']);
    $replyCnt = 0;
    $replyArr = array();
    $subreplyMat = array(); // key: parentid, value: subreply array
    /*
     * Separate the query result into first-level replies and sub-replies.
     * Replies whose parentid = 0 are frist-level replies; replies whose 
     * parentid > 0 are sub-replies.
    */
    foreach ($rset as $row) {
        if ($row['parentid'] == 0) {
            $replyCnt = $replyCnt + 1;
            $replyArr[$replyCnt] = $row;
            $subreplyMat[$row['id']] = array();
        }
        else {
            array_push($subreplyMat[$row['parentid']], $row);
        }
    }
    // display the replies if there are any
    if($replyCnt > 0) {
        echo "<h4>Reply List</h4>";
        for ($i = 1; $i <= $replyCnt; $i++) {
            echo '<div class="panel panel-info">';
            echo '<div class="panel-heading">Followup '.$i.'</div>';
            echo '<div class="panel-body">';
            $replyUid = sql_get_uid_byEmail($replyArr[$i]['email']);
            echo '<a href="profile.php?uid='.$replyUid.'">'.sql_get_username_byEmail($replyArr[$i]['email']).'</a>:'.$replyArr[$i]['content'];
            echo '<div>';
            echo '<small>Time: '.$replyArr[$i]['time'].'</small>';
            echo '<a href="#subreply'.$i.'" id="show'.$i.'" class="btn btn-info pull-right" data-toggle="collapse" style="display: inline; width:120px;" onclick="changeDisplay('.$i.')">Replies&nbsp('.count($subreplyMat[$replyArr[$i]['id']]).')</a>';
            echo '<a href="#subreply'.$i.'" id="packup'.$i.'" class="btn btn-info pull-right" data-toggle="collapse" style="display: none; width:120px;" onclick="changeDisplay('.$i.')">Packup Replies</a>';
            echo '</div>';

            echo '<div id="subreply'.$i.'" class="subreply collapse">';
            foreach ($subreplyMat[$replyArr[$i]['id']] as $subrow) {
                $reppllyUid = sql_get_uid_byEmail($subrow['email']);
                echo '<a href="profile.php?uid='.$reppllyUid.'">'.sql_get_username_byEmail($subrow['email']).'</a>:'.$subrow['content'];
                echo '<div>';
                echo '<small>Time: '.$subrow['time'].'</small>';
                echo '</div>';
            }

            // form for submitting sub-replies
            echo '<form method=post action=show-article.php?postid='. $_GET["postid"].'>';
            echo '<input type=hidden name="parentid" value='.$replyArr[$i]['id'].'>';
            echo '<input type=hidden name="replyedemail" value='.$replyArr[$i]['email'].'>';
            echo '<input type=hidden name="title" value='.$postTitle.'>';
            echo '<div align="right" class="col-md-2 col-xs-2">Reply:</div>';
            echo '<div class="col-md-8 col-xs-10"><textarea class="form-control" name=reply_content style="margin: 0px; width: 100%; height: 140px;" required></textarea>';
            echo '<input id="replybutton" class="btn btn-primary" type=submit name=submit value=reply>';
            echo '</div>';
            echo '</form>';

            echo '</div>';

            echo '</div>';
            echo '</div>';
        }
    }
    

    /*while($row = $rset->fetch_assoc()) {
        echo '<hr style="width: 100%; color: black; height: 1px; background-color:black;" />';
        echo '<p>'.$row['content'].'</p>';
        echo '<p style="fontsize = %50">Time:'.$row['time'].'</p>';
    }*/

    // form for submitting replies
    echo "<div class=\"jobpostform\">";
    echo "<h3 align=\"center\">Post a reply</h2>";
    echo '<form method=post action=show-article.php?postid='. $_GET["postid"].'>';
    echo '<input type="hidden" name="parentid" value=0>';
    echo '<input type=hidden name="replyedemail" value='.$postEmail.'>';
    echo '<input type=hidden name="title" value='.$postTitle.'>';
    echo '<div class="postreplybox row">';
    echo '<div align="right" class="col-md-2 col-xs-2">Reply:</div>';
    echo '<div class="col-md-8 col-xs-8"><textarea class="form-control" name=reply_content style="margin: 0px; width: 100%; height: 140px;" required></textarea>';
    
    echo '<input id="replybutton" class="btn btn-primary" type=submit name=submit value=reply></div>';
    echo '</div>';
    echo '</form>';
    echo '</div>';

    echo '</div>';
    sql_update_visit($_GET['postid']);

?>
<?php
  include_once("./footer.php");
?>
</body>