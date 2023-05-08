<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['userID'])){
    header("Location: index.php?action=-1");
}
$userID = $_SESSION["userID"];
//$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');
//if ($con->connect_error) {
////    echo "连接 MySQL 失败: " . mysqli_connect_error();
//    die("连接 MySQL 失败: " . $con->connect_error);
//}
include("includes/db_connect.php");
global $con;
//include ('includes/function.php');
$purchase = 0;
$itemArr = Array();
$editArr = Array();
$sql = "SELECT * FROM user WHERE userID = '$userID'";
$result = mysqli_query($con, $sql);
while ($row_user = mysqli_fetch_array($result)){
    $phoneNumber = $row_user['phoneNumber'];
    $address = $row_user['address'];
    $account = $row_user['account'];
    $userName = $row_user['userName'];
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Store</title>

    <!--Stylesheets-->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/cart.css" />
    <link rel="stylesheet" href="css/jumbotron.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Asul:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Long+Cang&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zhi+Mang+Xing&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/c20011b147.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="main">
        <header id="header">
            <div class="container">
                <nav>
                    <div class="logo">
                        <img src=".\image\logo.png" height=55px width=auto />
                        <span style="margin-left: 5px"> Store</span>
                    </div>
                    <ul class="headermiddle">
                        <li><a href="index.php">首页</a></li>
                        <li><a href="#">商品详情</a></li>
                        <li><a href="#">关于</a></li>
                    </ul>
                    <ul>
                        <li class="nav_right"><a class="nav_right_a" href="shop.php"><i class="fa-solid fa-magnifying-glass fa-xl"></i></a></li>
                        <li class = "nav_right"><a class="nav_right_a active" href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a></li>
                        <li class="nav_right" style="z-index: 3">
                            <i class="fa-solid fa-user fa-xl"></i>
                            <ul>
                                <li><a href="myProduct.php">发布</a></li>
                                <li><a href="includes\logout.php">退出</a></li>
                            </ul>
                        </li>
                        <li style="margin: -5px -20px auto -50px;">
                            <a href="userInfo.php" class="userInfo"><span style="font-family: 'Long Cang', cursive;">&ensp;&ensp;&ensp;Hi! </span><?php echo $userName ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="bg-container">
            <div id="jumbotron-ol"></div>
            <div class="jumbotron jumbotron-bg" style="background-image: url('image/cart-bg.png');background-size:100% 100%;">
                <div class="container">
                    <h1>
                        Your Cart
                    </h1>
                    <p>
                        Enjoy your art travel
                    </p>
                </div>
            </div>
    </div>

        <div class="container" id="cart" style="width: 80%;margin-bottom: 100px">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="15%"></th>
    <!--                                <th width="3%"></th>-->
                                    <th width="60%" style="text-align: left;padding-left: 10px"><strong>商品</strong></th>
                                    <th class="text-right"><strong>价格</strong></th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM likes WHERE userID = '$userID'";
                            $result = mysqli_query($con, $sql);
                            if(mysqli_num_rows($result) > 0){
                                while ($row_like = mysqli_fetch_array($result)){
                                    $itemID = $row_like['itemID'];
                                    $sql_item = "SELECT * FROM item WHERE itemID = '$itemID'";
                                    $result_item = mysqli_query($con, $sql_item);
                                    while ($row = mysqli_fetch_array($result_item)){
                                        if(!isset($row['buyer'])){
                                            $itemArr[] = $itemID;
                                            $editArr[] = $row['editTime'];
                                        }
                                         ?>
                                    <tr class="<?php echo isset($row['buyer'])?'bought':'' ?>" style="height: 200px">
                                        <td>
                                            <a href="detail_product.php?item_ID=<?php echo $itemID?>">
                                                <img src="<?php echo isset($row['itemImg'])?'data:image/jpeg;base64, '.base64_encode($row['itemImg']):'' ?>" style="max-height: 150px;max-width: 100%">
                                            </a>
                                        </td>
                                        <td style="text-align: left;">
                                            <span class="product-name"><?php echo isset($row['itemName'])?$row['itemName']:'<grey>暂无名称</grey>' ?></span>&ensp;&ensp;&ensp;
                                            <small>作者&ensp;/&ensp;<span style="font-size: 20px;font-weight: bold"><?php echo isset($row['authorName'])?$row['authorName']:'<grey>暂无作者</grey>' ?></span>
                                                <span id="attention" style="display: <?php echo isset($row['buyer'])?'inline':'none' ?>">&ensp;&ensp;&ensp;已被购买</span>
                                            <br><br>简介&ensp;/&ensp;<span style="font-size: 17px"><?php echo isset($row['itemDesc'])?$row['itemDesc']:'<grey>暂无简介</grey>' ?></span></small><br><br>
                                            <span class="form-input-err-msg" style="font-family: var(--font_main_family)" data-err-for="checkItem<?php echo $itemID?>"></span>
                                        </td>
                                        <td class="price text-right">
                                            &#165 <strong class="price" style="font-size: 23px">
                                                <?php if(!isset($row['buyer'])) $purchase = $purchase + $row['price'];
                                                echo isset($row['price'])?number_format($row['price']):'<grey>暂无价格</grey>';?>
                                            </strong><br><br>
                                        </td>
                                        <td>
                                            <button class="btn-icon" onclick="deleteFromCart(<?php echo $userID ?>,<?php echo $itemID ?>)"><i class="fa-solid fa-trash-can fa-xl"></i></button>
                                        </td>
                                    </tr>
                       <?php        }
                                }
                            }else{
                                echo "<tr><td></td><td style='text-align: left'><grey>暂无商品</grey></td><td></td><td></td></tr>";
                            }
                            $arr = array_combine($itemArr,$editArr);
//                            $con->close();
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    <div class="col price text-right">
                        <strong style="font-size: 20px">共计</strong>
                        &#165 <strong class="price" style="font-size: 30px"><?php echo number_format($purchase)?></strong>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 100px">
                <div class="col">
                    <button style="margin-bottom: 0" onclick="location.href = 'shop.php'" class="btn btn-default"><i class="fa-solid fa-angles-left"></i> 继续购物</button>
                </div>
                <div class="col text-right">
                    <button class="btn btn-submit" onclick="checkOut()">CheckOut <i class="fa-solid fa-angles-right"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div id="hidden"></div>
    <div id="overlay">
        <div class="section-header" style="margin-top:50px">确认订单</div>
        <div class="container">
            <table class="table" style="font-family: var(--font_chinese_family);">
                <thead>
                <tr>
                </tr>
                </thead>
                <tbody>
                <tr style="height: 50px"></tr>
                <tr>
                    <td class="text-right" width="15%"><strong style="font-size: 20px">共&ensp;计</strong></td>
                    <td width="3%">&ensp;/&ensp;</td>
                    <td class="price text-left" width="30%">&#165 <strong class="price" style="font-size: 30px"><?php echo number_format($purchase)?></strong></td>
                    <td class="text-right" width="15%">账户余额</td>
                    <td width="3%">&ensp;/&ensp;</td>
                    <td class="price text-left" width="34%">&#165 <span class="price" style="font-size: 25px"><?php echo isset($account)?$account:''?></span></td>
                </tr>
                <tr>
                    <td class="text-right" width="15%">电&ensp;话&ensp;</td>
                    <td width="3%">&ensp;/&ensp;</td>
                    <td colspan="4" class="price text-left" style="font-size: 20px;"><?php echo isset($phoneNumber)?$phoneNumber:''?></td>
                </tr>
                <tr>
                    <td class="text-right" width="15%">地&ensp;址&ensp;</td>
                    <td width="3%">&ensp;/&ensp;</td>
                    <td colspan="4" class="price text-left user-text" style="padding-right: 50px;"><?php echo isset($address)?$address:''?></td>
                </tr>
                <tr style="height: 50px"></tr>
                </tbody>
            </table>
            <div class="row" style="margin-top: 80px">
                <div class="col text-right">
                    <button class="btn-icon" onclick="overlayDisable()" style="margin-right: 30px">取&ensp;消</button>
                    <button class="btn btn-submit" onclick="handlePurchase(<?php echo $purchase?>)">确认订单</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="cart-footer">
        &copy 2022 ArtStore | Made with<i style="color: #fd4b4b;font-style: normal">&nbsp; &#9829; &nbsp;</i>in China by Grace
    </footer>

    <script src=".\JavaScript\like.js"></script>
    <script src=".\JavaScript\cart.js"></script>
    <script src=".\JavaScript\header.js"></script>
    <script language="JavaScript">
        async function checkOut(){
            let itemArr = []
            let editArr = []
        <?php
            foreach ($arr as $item_ID => $edit_time) {
            ?>
            itemArr.push(<?php echo $item_ID ?>)
            editArr.push(<?php echo $edit_time ?>)
            <?php
            }
            ?>
            let checkBool = true
            if(itemArr.length === 0){
                alert('请选择可购商品！')
                return
            }
            console.log(itemArr,editArr)
            for(let i = 0; i < itemArr.length; i++){
                checkEdit(itemArr[i], editArr[i])
            }
            await sleep(100)
            for(let i = 0; i < itemArr.length; i++){
                if(document.querySelector(`span[data-err-for="checkItem${itemArr[i]}"]`).innerHTML) checkBool = false
            }
            if( <?php echo isset($account)?$account:0 ?> < <?php echo isset($purchase)?$purchase:0 ?> ){
                alert("余额不足！")
                return
            }
            if(checkBool){
                hidden.style.display = 'block'
                overlay.style.display = 'block'
                overlay.style.top = (document.documentElement.scrollTop + 75) + 'px'
                return
            }
        }
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms))
    }
    </script>

</body>
</html>
