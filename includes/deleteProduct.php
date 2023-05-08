<?php

session_start();

$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}


$userID = $_SESSION['userID'];
$itemID = $_GET['item_ID'];

$result_item = mysqli_query($con, "SELECT * FROM item WHERE itemID = '$itemID'");
$row = mysqli_fetch_array($result_item);
if(!isset($row['buyer'])){
    $sql = "DELETE FROM item WHERE (publisher = '$userID' AND itemID = '$itemID')";
    $result = mysqli_query($con, $sql);
    $sql_like = "DELETE FROM likes WHERE itemID = '$itemID'";
    $result = mysqli_query($con, $sql_like);
    echo '删除成功';
}else echo '该商品已被购买';

