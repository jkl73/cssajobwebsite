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
  include("sqlfuncs.php");
  include("header.php");
  $active_pos = 0;
  if(isset($_POST["delete"]))
    $active_pos = 1;
  else if(isset($_POST["submit"]))
    $active_pos = 2;
?>
<div class="container">
  <h2>Welcome Admin!!</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Manage User</a></li>
    <li><a data-toggle="tab" href="#menu2">Manage Post</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade <?php if($active_pos<2)echo 'in active';?>">
      <h3>Manage User</h3>
      <?php
          $conn = getconn();
          if(isset($_POST["delete"]))
          {
            $rowCount = count($_POST["users"]);
            for($i=0;$i<$rowCount;$i++) {
              $stmt = $conn->prepare("DELETE FROM student WHERE email='" . $_POST["users"][$i] . "'");
              $stmt->execute();
              $stmt = $conn->prepare("DELETE FROM employer WHERE email='" . $_POST["users"][$i] . "'");
              $stmt->execute();
            }
          }
          $stmt = $conn->prepare("select * from student");
          $result = $stmt->execute();
          if (!$result)
            pdo_die($stmt);

          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          ?>
          <form action ="admin.php" method = POST>
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
            echo '<td><input type="checkbox" name="users[]" value="'.$row["email"].'" ></td>';
            echo '<td>Student</td>';
            echo '<td>'.$row["name"].'</td>';
            echo '<td>'.$row["email"].'</td>';
            $verified = "yes";
            if($row["verified"] == 0)$verified = "no";
            echo '<td>'.$verified.'</td>';
            echo '</tr>';
          }
          $stmt = $conn->prepare("select * from employer");
          $result = $stmt->execute();
          if (!$result)
            pdo_die($stmt);

          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as $row) {
            echo '<tr>';
            echo '<td><input type="checkbox" name="users[]" value="'.$row["email"].'" ></td>';
            echo '<td>Employer</td>';
            echo '<td>'.$row["name"].'</td>';
            echo '<td>'.$row["email"].'</td>';
            $verified = "yes";
            if($row["verified"] == 0)$verified = "no";
            echo '<td>'.$verified.'</td>';
            echo '</tr>';
          }
          ?>
            </tbody>
          </table>
          <input type=submit name="delete" value = "delete">
        </form>
    </div>
    <div id="menu1" class="tab-pane fade <?php if($active_pos>=2)echo 'in active';?>">
      <?php
        if (isset($_POST["submit"])) {
          $query = $_POST["content"];
          $conn = getconn();
          $result = $conn->query($query);
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
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
</div>
<?php include("footer.php");?>
</body>
</html>