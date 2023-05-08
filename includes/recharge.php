<?php
session_start();

$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}


$userID = $_SESSION['userID'];
$recharge = $_GET['recharge'];

$sql = "SELECT * FROM user WHERE userID = '$userID'";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
    $account = $row['account'] + $recharge;
    if($account > 999999999999) echo '账户金额已充足，充值失败！';
    else{
        $update_user = "UPDATE user SET account = '$account' WHERE userID = '$userID'";
        $run_user = mysqli_query($con, $update_user);
        echo '充值成功！';
    }
}
