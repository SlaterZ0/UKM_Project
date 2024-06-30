<?php

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {

    try {

        $stmt = $conn->prepare("INSERT INTO PRODUCTS_ID, PRODUCTS_NAME, PRICE, TYPE, RARITY, SETS, QUANTITY) VALUES(:pid, :name, :price, :type, :genre, :sets, :quantity)");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':genre', $rarity, PDO::PARAM_STR);
        $stmt->bindParam(':set', $sets, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type =  $_POST['type'];
        $rarity = $_POST['genre'];
        $sets = $_POST['set'];
        $quantity = $_POST['quantity'];

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Update
if (isset($_POST['update'])) {

    try {

        $stmt = $conn->prepare("UPDATE tbl_products_a187103 SET PRODUCTS_ID = :pid,
        PRODUCTS_NAME = :name, PRICE = :price, TYPE = :type,
        RARITY = :rarity, SETS = :set, QUANTITY = :quantity
        WHERE PRODUCTS_ID = :oldpid");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':rarity', $rarity, PDO::PARAM_STR);
        $stmt->bindParam(':set', $set, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type =  $_POST['type'];
        $rarity = $_POST['rarity'];
        $set = $_POST['set'];
        $quantity = $_POST['quantity'];
        $oldpid = $_POST['oldpid'];

        $stmt->execute();

        header("Location: products.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Delete
if (isset($_GET['delete'])) {

    try {

        $stmt = $conn->prepare("DELETE FROM tbl_products_a187103 WHERE PRODUCTS_ID = :pid");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

        $pid = $_GET['delete'];

        $stmt->execute();

        header("Location: products.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

//Edit
if (isset($_GET['edit'])) {

    try {

        $stmt = $conn->prepare("SELECT * FROM tbl_products_a187103 WHERE PRODUCTS_ID = :pid");

        $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

        $pid = $_GET['edit'];

        $stmt->execute();

        $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
