<?php
session_start();

$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}


$userID = $_SESSION['userID'];
$commentID = $_GET['comment_ID'];

$result_comment = mysqli_query($con, "SELECT * FROM comment WHERE commentID = '$commentID'");
$row = mysqli_fetch_array($result_comment);
if($row['userID'] == $userID){
    $sql = "DELETE FROM comment WHERE commentID = '$commentID'";
    $result = mysqli_query($con, $sql);
//    $sql_like = "DELETE FROM likes WHERE itemID = '$itemID'";
//    $result = mysqli_query($con, $sql_like);
    echo '删除成功';
}else echo '不是您的评论，不能删除！';