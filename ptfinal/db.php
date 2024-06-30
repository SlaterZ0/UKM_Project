<?php
 
 $servername = "lrgs.ftsm.ukm.my";
 $username = "a187103";
 $password = "giantwhiterabbit";
 $dbname = "a187103";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
?>