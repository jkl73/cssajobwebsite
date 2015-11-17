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

</head>

<body>
<?php
  session_start();
  $adminEamil = "admin@cornell.com";
  include("sqlfuncs.php");
  include("header.php");
  $active_pos = 0;
  if(isset($_POST["delete"]))
    $active_pos = 1;
  else if(isset($_POST["deletePost"]))
    $active_pos = 2;
  else if(isset($_POST["submit"]))
    $active_pos = 3;
?>
<div class="container">
  <h2>Welcome Admin!!</h2>
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
          <form action ="admin.php" method = POST>
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
          <form action ="admin.php" method = POST>
      <?php
        if(isset($_POST["deletePost"]))
          {
            $postid = $_POST["deletePost"][0];
            sql_delete_post_byPostId($postid);
          }
        $conn = getconn();
        $stmt = $conn->prepare("select * from post_info order by time DESC;");
        $result = $stmt->execute();
        if (!$result)
          {
              echo "What the fuck?";
              pdo_die($stmt);
          }
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          Print_Post($result,$adminEamil);
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
<?php include("footer.php");?>
</body>
</html>