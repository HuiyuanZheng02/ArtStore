<?php

session_start();

$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}


$userID = $_GET['user_ID'];
$itemID = $_GET['item_ID'];

$inCart = mysqli_query($con, "SELECT * FROM likes WHERE userID = '$userID' AND itemID = '$itemID'");
if (mysqli_num_rows($inCart) == 0) {
    $sql = "INSERT INTO likes (userID, itemID) VALUES ('$userID', '$itemID')";
    $result = mysqli_query($con, $sql);
}

