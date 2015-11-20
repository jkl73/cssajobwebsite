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
   function delete_alert()
   {
    var r = confirm("Are you sure to delete?");
    if(r == true){
        return true;
      }else {
        return false;
      }
   }
   </script>
   <script>
      $(document).ready(function(){
        $("a.deletePost").click(function(e){
            e.preventDefault();
            var thiss = $(this);
            var parent = $(this).parent()
            var whole_list = parent.parent();
            $.ajax({
              type: 'post',
              url: 'admin.php',
              data: 'deletePost=' + thiss.attr('data-email'),
              beforeSend: function() {
                whole_list.animate({opacity:'0.5'},50);
              },
              success: function() {
                whole_list.slideUp(50,function() {
                  whole_list.remove();
                });
              }
            });
        });
      })
    </script>
</head>

<body>
<?php
  session_start();
  include_once("sqlfuncs.php");
  include_once("header.php");
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
  /*$active_pos = 0;
  if(isset($_POST["delete"]))
    $active_pos = 1;
  else if(isset($_POST["deletePost"]))
    $active_pos = 2;
  else if(isset($_POST["submit"]))
    $active_pos = 3;*/
?>
<div class="container">
  <h2>Welcome Admin!!</h2>
  <h3><a href="adminUsr.php">Manage User</a><h3>

  <?php
    if(isset($_POST["deletePost"]))
    {
      $postid = $_POST["deletePost"];
      sql_delete_post_byPostId($postid);
    }
    $conn = getconn();
    $stmt = $conn->prepare("select * from post_info where time<now() order by time DESC;");
    $result = $stmt->execute();
    if (!$result)
      {
          echo "What the fuck?";
          pdo_die($stmt);
      }
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $num_res = count($result);
      $PageDisplay = 0;
      if(isset($_GET["page"]))$PageDisplay = $_GET["page"];
      $numPerPage = 30;
      $max_page = (int)($num_res/$numPerPage);
      if($PageDisplay>$max_page)$PageDisplay = $max_page;
      else if($PageDisplay<0)$PageDisplay = 0;
    //Jia Edit
        $conn = getconn();
        $stmt = $conn->prepare("select * from user_fav as F WHERE F.email = '".$myemail."' order by F.postid;");
        $result2 = $stmt->execute();
        if (!$result2)
          {
              echo "What the fuck?";
              pdo_die($stmt);
          }
        $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //End of Edit
        //Modified
        Print_Fav_Post($result,$myemail,$PageDisplay,$result2);
      //Print_Post($result,$myemail,$PageDisplay);
      if($max_page>0)
      {
        echo '<ul class="pagination">';
        for($i = 0;$i<=$max_page;$i++)
        {
          if($i == $PageDisplay)echo '<li class = "active">';
          else echo '<li>';
          echo '<a href="homepage.php?page='.$i.'">'.($i*$numPerPage+1).'-'.(($i+1)*$numPerPage).'</a>';
        }
        echo '</ul>';
      }
      echo '</div>';
      include_once("footer.php");
      exit;
  ?>
  <ul class="nav nav-tabs">
    <li <?php if($active_pos == 0)echo 'class = "active"';?>><a data-toggle="tab" href="#home">Home</a></li>
    <li <?php if($active_pos == 1)echo 'class = "active"';?>><a data-toggle="tab" href="#menu1">Manage User</a></li>
    <li <?php if($active_pos == 2)echo 'class = "active"';?>><a data-toggle="tab" href="#menu2">Manage Post</a></li>
    <li <?php if($active_pos == 3)echo 'class = "active"';?>><a data-toggle="tab" href="#menu3">Use query to manipulate</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade <?php if($active_pos == 0)echo 'in active';?>">
      <h3>Home page</h3>
      <p>Useless homepage</p>
    </div>
    <div id="menu1" class="tab-pane fade <?php if($active_pos == 1)echo 'in active';?>">
      <h3>Manage User</h3>
      <?php
          $conn = getconn();
          /*if(isset($_POST["delete"]))
          {
            if(isset($_POST["users"]))
            {
              $rowCount = count($_POST["users"]);
              for($i=0;$i<$rowCount;$i++) 
              {
                $stmt = $conn->prepare("DELETE FROM student WHERE email='" . $_POST["users"][$i] . "'");
                $stmt->execute();
                $stmt = $conn->prepare("DELETE FROM employer WHERE email='" . $_POST["users"][$i] . "'");
                $stmt->execute();
              }
            }
            
          }*/
          if(isset($_POST["delete"]))
          {
            $stmt = $conn->prepare("DELETE FROM student WHERE email='" . $_POST["delete"][0] . "'");
            $stmt->execute();
            $stmt = $conn->prepare("DELETE FROM employer WHERE email='" . $_POST["delete"][0] . "'");
            $stmt->execute();
          }
          $stmt = $conn->prepare("select * from student");
          $result = $stmt->execute();
          if (!$result)
            pdo_die($stmt);

          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <form action ="admin.php" onSubmit = "return delete_alert()" method = POST>
            <div class = "row">
            <div class="alert alert-info fade in col-md-4">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <p>Click on &times; and delete user</p> 
            </div>
            <!--div class = "col-md-8">
              <button class="btn btn-primary btn-lg" type=submit name="delete" value = "davd">dedflete user</button>
            </div-->
            </div>
          <div style = "overflow:scroll; height:450px">
          <table class="table table-striped">
            <thead>
              <tr>
                <th></th>
                <th>User Type</th>
                <th>Username</th>
                <th>email</th>
                <th>verified</th>
              </tr>
            <tbody>
          <?php
          foreach ($result as $row) {
            echo '<tr>';
            echo '<td><button class="btn btn-danger" type=submit name="delete[]" value ='.$row["email"].'>&times;</button></td>';
            //echo '<td><input type="checkbox" name="users[]" value="'.$row["email"].'" ></td>';
            echo '<td>Student</td>';
            echo '<td>'.$row["name"].'</td>';
            echo '<td>'.$row["email"].'</td>';
            echo '<td>';
              echo '<label class="checkbox">';
              if($row["verified"] == 0)
                echo '<input data-toggle="toggle" data-on="Yes" data-off="No" type="checkbox">';
              else
                echo '<input checked data-toggle="toggle" data-on="Yes" data-off="No" type="checkbox">';
              echo '</label>';
            echo '</td>';
            echo '</tr>';
          }
          $stmt = $conn->prepare("select * from employer");
          $result = $stmt->execute();
          if (!$result)
            pdo_die($stmt);

          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as $row) {
            echo '<tr>';
            echo '<td><button class="btn btn-danger" type=submit name="delete[]" value ='.$row["email"].'>&times;</button></td>';
            //echo '<td><input type="checkbox" name="users[]" value="'.$row["email"].'" ></td>';
            echo '<td>Employer</td>';
            echo '<td>'.$row["name"].'</td>';
            echo '<td>'.$row["email"].'</td>';
            echo '<td>';
              echo '<label class="checkbox">';
              if($row["verified"] == 0)
                echo '<input data-toggle="toggle" data-on="Yes" data-off="No" type="checkbox">';
              else
                echo '<input checked data-toggle="toggle" data-on="Yes" data-off="No" type="checkbox">';
              echo '</label>';
            echo '</td>';
            echo '</tr>';
          }
          ?>
            </tbody>
          </table>
        </div>
        </form>
    </div>
    <div id="menu2" class="tab-pane fade <?php if($active_pos == 2)echo 'in active';?>">
      <div class = "container">
        <div style = "overflow:scroll; height:450px">
          <form action ="admin.php" onSubmit = "return delete_alert()" method = POST>
      <?php
        if(isset($_POST["deletePost"]))
          {
            $postid = $_POST["deletePost"][0];
            sql_delete_post_byPostId($postid);
          }
        $conn = getconn();
        $stmt = $conn->prepare("select * from post_info where time<now() order by time DESC;");
        $result = $stmt->execute();
        if (!$result)
          {
              echo "What the fuck?";
              pdo_die($stmt);
          }
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $num_res = count($result);
          $PageDisplay = 0;
          if(isset($_GET["page"]))$PageDisplay = $_GET["page"];
          $numPerPage = 30;
          $max_page = (int)($num_res/$numPerPage);
          if($PageDisplay>$max_page)$PageDisplay = $max_page;
          else if($PageDisplay<0)$PageDisplay = 0;
          Print_Post($result,$adminEamil,$PageDisplay);
          if($max_page>0)
          {
            echo '<ul class="pagination">';
            for($i = 0;$i<=$max_page;$i++)
            {
              if($i == $PageDisplay)echo '<li class = "active">';
              else echo '<li>';
              echo '<a href="admin.php?page='.$i.'">'.($i*$numPerPage+1).'-'.(($i+1)*$numPerPage).'</a>';
            }
            echo '</ul>';
          }
      ?>
          </form>
      </div>
      </div>
    </div>
    <div id="menu3" class="tab-pane fade <?php if($active_pos == 3)echo 'in active';?>">
      <?php
        if (isset($_POST["submit"])) {
          $query = $_POST["content"];
          $conn = getconn();
          $result = $conn->query($query);
          if (!$result)
          {
              echo "What the fuck?";
              pdo_die($stmt);
          }
          foreach ($result->fetchALL(PDO::FETCH_ASSOC) as $row) {
            foreach ($row as $key => $value) {
              echo "[Key: ".$key." value: ".$value."]";
            }
            echo "<br>";
          }
        }
        else
        {
          echo '<form method=post action=admin.php>';
          echo '<textarea class="form-control" name=content></textarea>';
          echo '<input type=submit name="submit" value = submit>';
          echo '</form>';
        }
      ?>
    </div>
  </div>
</div>
<?php include_once("footer.php");?>
</body>
</html>