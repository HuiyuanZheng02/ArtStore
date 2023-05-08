<?php
session_start();

//include("includes/db_connect.php");
$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}

$itemName = $_POST['itemName'];
$authorName = $_POST['authorName'];
$itemYear = $_POST['itemYear'];
$genre = $_POST['genre'];
$length = $_POST['length'];
$width = $_POST['width'];
$price = $_POST['price'];
$itemDesc = $_POST['itemDesc'];
$publisher = $_SESSION['userID'];
$itemImage = addslashes (file_get_contents($_FILES['itemImage']['tmp_name']));
//$itemImage = $_FILES['itemImage']['name'];

$sql = "INSERT INTO item (itemName, authorName, itemYear, genre, length, width, price, itemDesc, publisher, itemImg) 
VALUES ('$itemName', '$authorName', '$itemYear', '$genre', '$length', '$width', '$price', '$itemDesc', '$publisher', '$itemImage')";
if ($con->query($sql) === TRUE) {
    echo "<script>alert('添加成功！');location='/userInfo.php'</script>";
}
else echo "Error: " . $sql . "<br>" . $con->error;