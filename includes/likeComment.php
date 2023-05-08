<?php

session_start();
$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');
if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}


$userID = $_SESSION['userID'];
$commentID = $_GET['comment_ID'];

$result = mysqli_query($con, "INSERT INTO likeComment (userID,commentID) VALUES ('$userID', '$commentID')");

$resultLike = mysqli_query($con, "SELECT * FROM comment WHERE commentID = '$commentID'");
$like = mysqli_fetch_array($resultLike)['liked'] + 1;
$update_like = mysqli_query($con, "UPDATE comment SET liked = '$like' WHERE commentID = '$commentID'");
