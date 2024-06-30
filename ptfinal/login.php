<?php

include_once 'database.php';
session_start();
if (isset($_SESSION["staffid"])) {
     header("location:index.php");
}

try {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     if (isset($_POST["login"])) {
          if (empty($_POST["staffid"]) || empty($_POST["password"])) {
               $message = '<label>All fields are required</label>';
          } else {
               $query = "SELECT * FROM tbl_staffs_a187103 WHERE Staff_ID = :staffid AND fld_pass = :password";
               $stmt = $conn->prepare($query);
               $stmt->execute(
                    array(
                         'staffid'     =>     $_POST["staffid"],
                         'password'     =>     $_POST["password"]
                    )
               );
               $count = $stmt->rowCount();
               if ($count > 0) {

                    $_SESSION["staffid"] = $_POST["staffid"];



                    header("location:login_success.php");
               } else {
                    $message = '<label>Wrong Password</label>';
               }
          }
     }
} catch (PDOException $error) {
     $message = $error->getMessage();
}
?>


<!DOCTYPE html>
<html>

<head>
     <?php include_once 'nav_bar_login.php' ?>
     <title> TC Empire | Login</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <script src="js/bootstrap.min.js"></script>


</head>

<body>
     <br />
     <div class="container" style="width:500px;">
          <?php
          if (isset($message)) {
               echo '<label class="text-danger">' . $message . '</label>';
          }
          ?>

          <center><img src="logo.png" width="60%" height="60%"></center>


          <form method="post">
               <label>
                    <font face="">Username</font>
               </label>
               <input type="text" name="staffid" class="form-control" />
               <br />
               <label>
                    <font face="">Password</font>
               </label>
               <input type="password" name="password" class="form-control" />
               <br />
               <input type="submit" name="login" class="btn btn-info" value="Log in" style="background-color:#E9967A" />
          </form>
     </div>
     <br />
</body>

</html>