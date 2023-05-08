<?php

session_start();


//include("includes/db_connect.php");
//global $con;
$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}

$cost = $_GET['cost'];
$userID = $_SESSION['userID'];
$itemArr = [];
$priceArr = [];
$ownerArr = [];
$editTimeArr = [];
$sold = [];

if(isset($cost) && isset($userID)){
    $totalPrice = 0;
    $sql = "SELECT * FROM likes WHERE userID = '$userID'";
    $result = mysqli_query($con, $sql);

    while ($row_like = mysqli_fetch_array($result)){
        $itemArr[] = $row_like['itemID'];
        $item = $row_like['itemID'];
        $result_item = mysqli_query($con, "SELECT * FROM item WHERE itemID = '$item'");
        $row_item = mysqli_fetch_array($result_item);
        $priceArr[] = $row_item['price'];
        $ownerArr[] = $row_item['publisher'];
        $editTimeArr[] = $row_item['editTime'];
        $sold[] = isset($row_item['buyer']);
//        if(!isset($row_item['buyer']))
        $totalPrice = $totalPrice + $row_item['price'];
    }
    if($totalPrice == $cost){
        $suc = 0;
        for ($i = 0; $i < count($itemArr); ++$i){
            $itemID = $itemArr[$i];
            $price = $priceArr[$i];
            $owner = $ownerArr[$i];
            $editTime = $editTimeArr[$i]+1;

            if(!$sold[$i]){//是否已被购买
                $purchase_item = mysqli_query($con, "UPDATE item SET buyer = '$userID',editTime = '$editTime'WHERE itemID='$itemID'");
                $clearCart = mysqli_query($con, "DELETE FROM likes WHERE (userID = '$userID' AND itemID = '$itemID')");

                //新建订单
                $orderNum = date('Ymd') . substr(microtime(), 2, 5) . sprintf('%02d', rand(10000, 99999));
                $sql_order = "INSERT INTO purchase (orderNum, itemID, buyer_userID) VALUES ('$orderNum', '$itemID', '$userID')";
                if ($con->query($sql_order) === TRUE){
                    //买家账户更新
                    $row_buyer = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM user WHERE userID = '$userID'"));
                    $buyer_newAccount = $row_buyer['account'] - $price;
                    $buyer_account = mysqli_query($con, "UPDATE user SET account = '$buyer_newAccount'WHERE userID='$userID'");

                    //卖家账户更新
                    if(isset($owner)){
                        $row_owner = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM user WHERE userID = '$owner'"));
                        $owner_newAccount = $row_owner['account'] + $price;
                        $owner_account = mysqli_query($con, "UPDATE user SET account = '$owner_newAccount'WHERE userID='$owner'");
                    }
                }else ++$suc;//记录失败产品数
            }else ++$suc;
        }
        if($suc == 0) echo '交易成功';
        else if($suc == count($itemArr)) echo '交易失败';
        else echo '交易部分成功';
    }else echo '价格有变动或有艺术品被删除';
}else echo '系统错误';


