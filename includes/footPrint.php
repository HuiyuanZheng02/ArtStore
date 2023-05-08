<?php
session_start();

$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}


$userID = $_GET['user_ID'];
$itemID = $_GET['item_ID'];

$resultItem = mysqli_query($con, "SELECT * FROM footPrint WHERE (userID = '$userID' AND itemID = '$itemID') ORDER BY foottime DESC ");
if(mysqli_num_rows($resultItem) != 0){
    $update_foot = "UPDATE footPrint SET foottime = CURRENT_TIMESTAMP WHERE (userID = '$userID' AND itemID = '$itemID')";
    $footPrint = mysqli_query($con, $update_foot);
}else{
    $result = mysqli_query($con, "SELECT * FROM footPrint WHERE userID = '$userID' ORDER BY foottime ");
    if(mysqli_num_rows($result) == 5){
        $row = mysqli_fetch_array($result);
        $oldItemID = $row['itemID'];
        $update_foot = "UPDATE footPrint SET foottime = CURRENT_TIMESTAMP,itemID = '$itemID' WHERE (userID = '$userID' AND itemID = '$oldItemID')";
        $footPrint = mysqli_query($con, $update_foot);
    }else $footPrint = mysqli_query($con, "INSERT INTO footPrint (userID, itemID) VALUES ('$userID', '$itemID')");
}
