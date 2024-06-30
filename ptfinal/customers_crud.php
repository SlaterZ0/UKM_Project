<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_customers_a187103(Customer_ID, Customer_Name,
    fld_customer_gender, Customer_Phone_Number,fld_customer_address) VALUES(:cid, :name,
      :gender, :phone, :address)");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
       
    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $gender =  $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
       
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
   
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_customers_a187103 SET Customer_ID = :cid,
      Customer_Name = :name,fld_customer_gender = :gender, Customer_Phone_Number = :phone, fld_customer_address = :address
      WHERE Customer_ID = :oldcid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
    
    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $gender =  $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $oldcid = $_POST['oldcid'];
       
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_customers_a187103 WHERE Customer_ID = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: customers.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}


//Edit
if (isset($_GET['edit'])) {
   
  try {
 
    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a187103 WHERE Customer_ID = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
       
    $cid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
 
?>

