<?php

session_start();

$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}


$itemID = $_GET['item_ID'];
$editTime = $_GET['edit_time'];

$sql = "SELECT * FROM item WHERE itemID = '$itemID' and editTime = '$editTime'";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) == 1){
    echo true;
}else echo false;
