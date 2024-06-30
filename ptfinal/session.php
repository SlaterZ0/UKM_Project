<?php
include_once 'db.php';

session_start();

$sid = $_SESSION['staffid'];

$stmt = $conn->prepare("SELECT * FROM tbl_staffs_a187103 WHERE Staff_ID = '$sid'");

$stmt->execute();

$readrow = $stmt->fetch(PDO::FETCH_ASSOC);
$sid = $readrow['Staff_ID'];
$name = $readrow['Staff_Name'];
$gender = $readrow['fld_staff_gender'];
$phone =  $readrow['fld_staff_phone'];
$pos = $readrow['fld_staff_position'];
$pass = $readrow['fld_pass'];

if ($sid == '') {
	header("location:login.php");
} else {
	header("");
}

?>