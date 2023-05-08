<?php

session_start();

//include("includes/db_connect.php");
//global $con;

$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}

$nameOrEmail = $_POST["nameOrEmail"];
$password_post = $_POST["password"];
$userName = $nameOrEmail;

//$sqlNameOrMail = mysqli_query($con, "SELECT userName FROM user WHERE (userName = '$nameOrEmail' OR Email = '$nameOrEmail')");
//if(mysqli_num_rows($sqlNameOrMail) == 0) header("Location: /index.php?signin_err=1");

$sql = "SELECT * FROM user WHERE userName = '$nameOrEmail' OR Email = '$nameOrEmail'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('用户名或邮箱不存在！');history.back();history.pushState(null,null,location.origin+location.pathname+'/?action=signin')</script>";
    }
else {
    while ($row = mysqli_fetch_array($result)) {
        $userID = $row['userID'];
        $salt = $row['salt'];
        $password = $row['password'];
    }
    if($password == sha1($password_post.$salt)){
        echo "<script>alert('登陆成功！');location='/index.php?'</script>";
        $_SESSION['userID'] = $userID;
    }else{
        echo "<script>alert('密码错误！');history.back();history.pushState(null,null,location.origin+location.pathname+'?action=signin')</script>";
    }
}