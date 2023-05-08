<?php

$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}

$userName = $_POST['userName'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$register_password = $_POST['password'];
$address = $_POST['address'];


$sqluserName=mysqli_query($con, "SELECT userName FROM user WHERE userName='$userName'");
$sqlEmail=mysqli_query($con, "SELECT email FROM user WHERE email='$email'");

//检查是否已存在邮箱和用户名
if(mysqli_num_rows($sqluserName) != 0){//用户名已存在
    echo "<script>alert('用户名已存在！');history.back();</script>";
} else if(mysqli_num_rows($sqlEmail) != 0) {//邮箱已存在
    echo "<script>alert('邮箱已存在！');history.back();</script>";
}
else {
    $salt = base64_encode(openssl_random_pseudo_bytes(32));
    $password=sha1($register_password.$salt);
    $sql = "INSERT INTO user (userName, phoneNumber, email, password, address,salt) VALUES ('$userName', '$phoneNumber', '$email', '$password', '$address','$salt')";
    if ($con->query($sql) === TRUE) echo "<script>alert('注册成功，请登陆！');location='/index.php?action=signin'</script>";
    else echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();

