<?php
session_start();

$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}

$userID = $_SESSION['userID'];
$comment = $_GET['comment'];
$itemID = $_GET['item_ID'];

$sql = "INSERT INTO comment (userID, itemID,comment) VALUES ('$userID', '$itemID','$comment')";
$result = mysqli_query($con, $sql);
