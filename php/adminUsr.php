<!DOCTYPE HTML>
<head>
	<title>Admin</title>
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
   <script>
    $(document).ready(function(){
      $("a.verify").click(function(e){
          e.preventDefault();
          var parent = $(this).parent();
          var thiss = $(this);
          $.ajax({
            type: 'post',
            url: 'adminUsr.php',
            data: 'verifyUsr=' + parent.attr('id').replace('record-','')+'&verifyVal=' + thiss.text(),
            beforeSend: function() {
              parent.animate({opacity:'0.5'},200);
            },
            success: function() {
              thiss.text(function(){
                if(thiss.text() == 'yes')return 'no';
                else return 'yes';
              });
              parent.animate({opacity:'1'},200);
            }
          });
      });
      $("a.verify").mouseover(function(){
        $(this).next("span").text("click to change verified status").show()
      })
      $("a.verify").mouseout(function(){
        $(this).next("span").text("").hide()
      })

      $("a.deleteUsr").click(function(e){
          e.preventDefault();
          var parent = $(this).parent()
          var grandparent = parent.parent();
          $.ajax({
            type: 'post',
            url: 'adminUsr.php',
            data: 'deleteUsr=' + parent.attr('id').replace('record-',''),
            beforeSend: function() {
              grandparent.animate({opacity:'0.5'},200);
            },
            success: function() {
              grandparent.slideUp(300,function() {
                grandparent.remove();
              });
            }
          });
      });
    });
   </script>
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

  if(!admin_byEmail($myemail))
  {
    echo '<h3>You have no authentication to visit admin pages</h3>';
    return;
  }
  
?>

  <div class="container">
    <h2>Welcome Admin!!</h2>
    <h3><a href="three_circles.php">Home</a>/Manage User Page</h3>
    <?php
        $conn = getconn();
        if(isset($_POST['verifyUsr'])) {
          if($_POST['verifyVal'] == 'yes')$stmt = $conn->prepare('update user set verify = 0 where email = :email');
          else $stmt = $conn->prepare('update user set verify = 1 where email = :email');
          $stmt->bindParam(':email',$_POST['verifyUsr']);
          $res = $stmt->execute();
          if(!$res)
            pdo_die($stmt);
          exit;
        }
        if(isset($_POST['deleteUsr']))
        {
          $stmt = $conn->prepare('delete from user where email=:email');
          $stmt->bindParam(':email',$_POST['deleteUsr']);
          $res = $stmt->execute();
          if(!$res)
            pdo_die($stmt);
          exit;
        }
        $stmt = $conn->prepare('select * from user order by uid ASC');
        $result = $stmt->execute();
        if (!$result)
          pdo_die($stmt);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class = "row">
      <div style = "overflow:scroll; height:450px">
          <table class="table table-striped">
            <thead>
              <tr>
                <th></th>
                <th>User Type</th>
                <th>User ID</th>
                <th>Username</th>
                <th>email</th>
                <th>verified</th>
              </tr>
            </thead>
            <tbody>
              
              <?php
              foreach ($result as $row) 
              {
                echo '<tr>';
                echo '<td id="record-'.$row["email"].'">';
                echo '<a href = "#" class = "deleteUsr">&times;</a>';
                echo '</td>';
                //echo '<td><input type="checkbox" name="users[]" value="'.$row["email"].'" ></td>';
                echo '<td>';
                if($row['type'] == 0)echo 'Admin';
                else if($row['type'] == 1)echo 'Employer';
                else if($row['type'] == 2)echo 'Student';
                echo '</td>';
                echo '<td>'.$row['uid'].'</td>';
                echo '<td><a href=profile.php?uid='.$row['uid'].'>'.$row["name"].'</a></td>';
                echo '<td><a href=profile.php?uid='.$row['uid'].'>'.$row["email"].'</a></td>';
                echo '<td>';
                echo '<div style="position:relative;" class="record" id="record-'.$row['email'].'">
                        <a href="#" class="verify">';
                if($row['verify'] == 0)echo 'no'; 
                else echo 'yes';
                echo '</a><span style="display:none;background-color:white;border:1px solid #ccc;padding:10px;position:absolute;top:10px;left:20px"></span>';
                echo '</td>';
                echo '</tr>';
              }
              ?>
              
            </tbody>
          </table>
  </div></div></div>
  <?php
  include_once("./footer.php");
?>
</body>