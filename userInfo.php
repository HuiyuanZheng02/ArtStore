<!DOCTYPE html>

<?php
session_start();
if(!isset($_SESSION['userID'])){
    header("Location: index.php?action=-1");
}
include ('includes/db_connect.php');
global $con;

//include ('includes/function.php');
$myItemArr = [];
$footArr = [];

if(isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];

    $sql = "SELECT * FROM user WHERE userID = '$userID'";
    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result)){
        $userName = $row['userName'];
        $phoneNumber = $row['phoneNumber'];
        $email = $row['email'];
        $address = $row['address'];
        $account = number_format($row['account']);
    }
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
    <link rel="stylesheet" href="css/jumbotron.css" />
    <link rel="stylesheet" href="css/productCard.css" />
    <link rel="stylesheet" href="css/userInfo.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Asul:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Long+Cang&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zhi+Mang+Xing&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/c20011b147.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

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
                    <li class = "nav_right"><a class="nav_right_a" href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a></li>
                    <li class="nav_right" style="z-index: 3">
                        <i class="fa-solid fa-user fa-xl"></i>
                        <ul>
                            <li><a href="myProduct.php">发布</a></li>
                            <li><a href="includes\logout.php">退出</a></li>
                        </ul>
                    </li>
                    <li style="margin: -5px -20px auto -50px">
                        <a href="userInfo.php" class="userInfo" style="color: var(--main_color)"><span style="font-family: 'Long Cang', cursive">&ensp;&ensp;&ensp;Hi! </span><?php echo $userName ?></a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="bg-container">
        <div id="jumbotron-ol"></div>
        <!-- <div class="Imageslider"> -->
            <!-- <img src=".\image\cart-bg.png" height=auto width=100% > -->
        <!-- </div> -->
        <div class="jumbotron jumbotron-bg" style="background-image: url('image/userInfo-bg.jpg');background-size:100% 100%;">
            <div class="container">
                <h1>
                    Personal Information
                </h1>
                <p>
                    Enjoy your art travel
                </p>
            </div>
        </div>
    </div>

    <div class="container" style="width: 70%;font-size: 23px">
        <div class="section-header" style="margin-top:50px">个人信息</div>
        <div class="row" style="margin-top: 50px;">
            <div class="col">
                <strong>用户名：</strong><?php echo isset($userName)?$userName:'<grey>暂无</grey>' ?>
            </div>
            <div class="col price">
                <strong>余额：</strong> &#165 <strong class="price" style="font-size: 23px"><?php echo isset($account)?$account:'<grey>暂无</grey>' ?></strong>
            </div>
            <div class="col text-right">
                <input type="text" name="recharge" class="form-input" placeholder="充值金额" id = "recharge" required>
                <button id="handleRecharge" class="btn  btn-submit" style="width: 100px" onclick="handleRecharge()">确&ensp;定</button>
                <button class="btn  btn-submit" style="width: 100px" onclick="recharge()" id = 'toRecharge'>充&ensp;值</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <strong>邮箱：</strong><?php echo isset($email)?$email:'<grey>暂无</grey>' ?>
            </div>
            <div class="col">
                <strong>电话：</strong><?php echo isset($phoneNumber)?$phoneNumber:'<grey>暂无</grey>' ?>
            </div>
            <div class="col">
                <strong>住址：</strong><?php echo isset($address)?$address:'<grey>暂无</grey>' ?>
            </div>
        </div>
    </div>

    <!-- 全部订单 -->
    <div class="container">
        <div class="section" style="width: 80%">
            <div class="section-header">全部订单</div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th width="8%"></th>
                                <th width="10%" ><strong>商品</strong></th>
                                <th></th>
                                <th></th>
                                <th width="22%" ><strong>订单详情</strong></th>
                                <th width="10%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><td style="padding: 5px"></td></tr>
                            <?php
                            $result_order = mysqli_query($con, "SELECT * FROM purchase WHERE buyer_userID = '$userID'");
                            if(mysqli_num_rows($result_order) > 0){
                                while ($row_order = mysqli_fetch_array($result_order)){
                                    $orderNum = $row_order['orderNum'];
                                    $itemID = $row_order['itemID'];
                                    $result_item = mysqli_query($con, "SELECT * FROM item WHERE itemID = '$itemID'");
                                    $row_item = mysqli_fetch_array($result_item)
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td style="padding: 10px">
                                                <div class="order-img-container">
                                                    <img class="order-img" src="<?php echo isset($row_item['itemImg'])?'data:image/jpeg;base64, '.base64_encode($row_item['itemImg']):'' ?>"/>
                                                </div>

                                            </td>
                                            <td style="text-align: left;">
                                                <a class="order-img-container" href="detail_product.php?item_ID=<?php echo $itemID?>" style="color: var(--txt_color);text-decoration-line: none;margin-left: 30px" >
                                                    <span class="product-name"><?php echo isset($row_item['itemName'])?$row_item['itemName']:'<grey>暂无名称</grey>' ?></span>
                                                </a>
                                            </td>
                                            <td class="price">
                                                &#165 <strong class="price" style="font-size: 23px">
                                                    <?php echo isset($row_item['price'])?number_format($row_item['price']):'<grey>暂无价格</grey>';?>
                                                </strong>
                                            </td>
                                            <td class="remarks text-left">
                                                订单编号：<?php echo isset($row_order['orderNum'])?$row_order['orderNum']:'<grey>暂无</grey>' ?>
                                                <br><br>
                                                交易时间：<?php echo isset($row_order['orderDate'])?$row_order['orderDate']:'<grey>暂无</grey>' ?>
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    <?php        }
                            }else{
                                echo "<tr><td></td><td style='text-align: left'><grey>暂无订单</grey></td><td></td><td></td></tr>";
                            }
                            ?>
                            <tr><td style="padding: 5px"></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 我发布的 -->
    <div class="container"">
        <div class="section">
            <div class="section-header">我发布的</div>
            <div class="swiper swiper-paginations product-slider">
                <div class="swiper-wrapper" style="margin-bottom: 30px">
                    <?php
                    $result_myItem = mysqli_query($con, "SELECT * FROM item WHERE publisher = '$userID' ORDER BY publish_date DESC");
                    while($row_myItem = mysqli_fetch_array($result_myItem)){
                        $myItemArr[] = $row_myItem['itemID'];
                        ?>
                    <div class="swiper-slide">
                            <div class="product-card">
                                <a href="detail_product.php?item_ID=<?php echo $row_myItem['itemID'] ?>" style="color: black;text-decoration: none">
                                    <div class="product-card-img">
                                        <div class="ratio ratio-1-1">
                                            <div class="ratio-content bg-img" style="background-image:url(data:image/jpeg;base64,<?php echo isset($row_myItem['itemImg'])?base64_encode($row_myItem['itemImg']):'' ?>);"></div>
        <!--                                    <img class="ratio-content bg-img"  src="--><?php //echo isset($row_myItem['itemImg'])?'data:image/jpeg;base64, '.base64_encode($row_myItem['itemImg']):'' ?><!--"/>-->
                                        </div>
                                    </div>
                                    <div class="product-card-name">
                                        <div class="product-name" style="font-size: 35px;"><?php echo isset($row_myItem['itemName'])?$row_myItem['itemName']:'<grey>暂无名称</grey>' ?></div>
                                        <div class="remarks text-right">
                                            <span class="remarks" style="font-family: var(--font_chinese_family);font-size: 10px">发布于&nbsp;</span>
                                            <grey style="font-size: 18px"><?php echo isset($row_myItem['publish_date'])?date("Y-m-d",strtotime($row_myItem['publish_date'])):'暂无发布日期';?></grey>
                                        </div>
                                    </div>
                                </a>
                                <div class="product-card-footer">
                                    <div class="product-card-footer__price price" style="margin-left: -10px">
                                        &#165 <strong class="price" style="font-size: 23px">
                                        <?php echo isset($row_myItem['price'])?number_format($row_myItem['price']):'<grey>暂无价格</grey>';?></strong>
                                    </div>
                                    <div class="product-card-footer__btn" style="display: <?php echo isset($row_myItem['buyer'])?'none':'block' ?>">
                                        <button class="product-card-btn" style="height: 20px;" onclick="editProduct(<?php echo $row_myItem['itemID'] ?>)">
                                            <span class="material-icons-outlined">edit</span>
                                        </button>
                                         <button class="product-card-btn" style="height: 20px" onclick="handleDelete(<?php echo $row_myItem['itemID'] ?>)">
                                            <span class="material-icons-outlined">delete</span>
                                         </button>
                                    </div>
                                    <div class="product-card-footer" style="display: <?php echo isset($row_myItem['buyer'])?'block':'none' ?>" ><grey>已售</grey></div>
                                </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="swiper-slide">
                        <div class="product-card" id="none_item">
                            <div class="product-card-img">
                                <div class="ratio ratio-1-1">
                                    <img class="ratio-content bg-img" style="border: 1px solid var(--border_color)"/>
                                </div>
                            </div>
                            <div style="text-align: center;font-family: var(--font_chinese_family);margin: 40px auto">
                                <grey>暂无更多</grey>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <!-- 我卖出的 -->
    <div class="container" >
        <div class="section">
            <div class="section-header">我卖出的</div>
            <div class="swiper swiper-paginations product-slider">
                <div class="swiper-wrapper" style="margin-bottom: 30px">
                    <?php
                    foreach($myItemArr as $itemID){
                        $result_myItem = mysqli_query($con, "SELECT * FROM item WHERE itemID = '$itemID'");
                        $row_myItem = mysqli_fetch_array($result_myItem);
                        if(!isset($row_myItem['buyer'])) continue;
                        $buyer = $row_myItem['buyer'];
                        $result_order = mysqli_query($con, "SELECT * FROM purchase WHERE itemID = '$itemID'");
                        $row_order = mysqli_fetch_array($result_order);
                        $result_buyer = mysqli_query($con, "SELECT * FROM user WHERE userID = '$buyer'");
                        $row_buyer = mysqli_fetch_array($result_buyer);
                        ?>
                        <div class="swiper-slide">
                            <a href="detail_product.php?item_ID=<?php echo $row_myItem['itemID'] ?>" style="color: black;text-decoration: none">
                                <div class="product-card">
                                <div class="product-card-img">
                                    <div class="ratio ratio-1-1">
                                        <div class="ratio-content bg-img" style="background-image:url(data:image/jpeg;base64,<?php echo isset($row_myItem['itemImg'])?base64_encode($row_myItem['itemImg']):'' ?>);"></div>
<!--                                        <img class="ratio-content bg-img"  src="--><?php //echo isset($row_myItem['itemImg'])?'data:image/jpeg;base64, '.base64_encode($row_myItem['itemImg']):'' ?><!--"/>-->
                                    </div>
                                </div>
                                <div class="product-card-name">
                                    <div class="product-name" style="font-size: 35px;"><?php echo isset($row_myItem['itemName'])?$row_myItem['itemName']:'<grey>暂无名称</grey>' ?></div>
                                </div>
                                <div class="product-card-footer" style="margin-bottom: 0">
                                    <div class="product-card-footer__price price" style="margin-left: -10px">
                                        &#165 <strong class="price" style="font-size: 23px">
                                            <?php echo isset($row_myItem['price'])?number_format($row_myItem['price']):'<grey>暂无价格</grey>';?></strong>
                                    </div>
                                </div>
                                <div class="product-card-detail remarks" >
                                    <div class="row" style="margin-top: 0;">
                                        <div class="col" style="font-family: var(--font_chinese_family);line-height: 17px;margin-left: 0;">
                                            买家姓名：<?php echo isset($row_buyer['userName'])?$row_buyer['userName']:'<grey>暂无</grey>' ?><br>
                                            买家电话：<?php echo isset($row_buyer['phoneNumber'])?$row_buyer['phoneNumber']:'<grey>暂无</grey>' ?><br>
                                            买家邮箱：<?php echo isset($row_buyer['email'])?$row_buyer['email']:'<grey>暂无</grey>' ?>
                                        </div>
                                        <div class="col-tb text-right">
                                            <span class="remarks" style="font-family: var(--font_chinese_family);font-size: 10px">交易于<br><br></span>
                                            <grey style="font-size: 18px"><?php echo isset($row_order['orderDate'])?date("Y-m-d",strtotime($row_order['orderDate'])):'暂无交易日期';?></grey>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 0">
                                        <div class="col" style="font-family: var(--font_chinese_family);margin-left: 0;">
                                            买家地址：<?php echo isset($row_buyer['address'])?$row_buyer['address']:'<grey>暂无</grey>' ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="swiper-slide">
                        <div class="product-card" id="none_item">
                            <div class="product-card-img">
                                <div class="ratio ratio-1-1">
                                    <img class="ratio-content bg-img" style="border: 1px solid var(--border_color)"/>
                                </div>
                            </div>
                            <div style="text-align: center;font-family: var(--font_chinese_family);margin: 40px auto">
                                <grey>暂无更多</grey>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-bottom: 120px">
        <div class="section">
            <div class="section-header" style="font-size: 30px;margin-bottom: 20px">我的足迹</div>
            <div class="row">
                <?php
                $result_foot = mysqli_query($con, "SELECT * FROM footPrint WHERE userID = '$userID' ORDER BY foottime DESC ");
                while($row_root = mysqli_fetch_array($result_foot)) {
                    $footArr [] = $row_root['itemID'];
                }
                foreach($footArr as $footPrint){
                    $result_footItem = mysqli_query($con, "SELECT * FROM item WHERE itemID = '$footPrint'");
                    $row_footItem = mysqli_fetch_array($result_footItem);
                    ?>
                    <div class="col" style="margin-top: 0">
                        <a href="detail_product.php?item_ID=<?php echo $row_footItem['itemID'] ?>" style="color: black;text-decoration: none">
                            <div class="product-card">
                                <div class="product-card-img">
                                    <div class="ratio ratio-1-1">
                                        <div class="ratio-content bg-img" style="background-image:url(data:image/jpeg;base64,<?php echo isset($row_footItem['itemImg'])?base64_encode($row_footItem['itemImg']):'' ?>);"></div>
                                    </div>
                                </div>
                                <div class="product-card-name" style="padding:10px 0">
                                    <div class="product-name" style="font-size: 35px;text-align: center"><?php echo isset($row_footItem['itemName'])?$row_footItem['itemName']:'<grey>暂无名称</grey>' ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                $num = 4 - sizeof($footArr);
                if($num >= 0){
                ?>
                <div class="col" style="margin-top: 0">
                    <div class="product-card" id="none_item">
                        <div class="product-card-img">
                            <div class="ratio ratio-1-1">
                                <img class="ratio-content bg-img" style="border: 1px solid var(--border_color)"/>
                            </div>
                        </div>
                        <div style="text-align: center;font-family: var(--font_chinese_family);margin: 20px auto">
                            <grey>暂无更多</grey>
                        </div>
                    </div>
                </div>
                <?php
                    for($i = 0; $i < $num;$i++){
                        echo '<div class="col"></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <footer>
        &copy 2022 ArtStore | Made with<i style="color: #fd4b4b;font-style: normal">&nbsp; &#9829; &nbsp;</i>in China by Grace
    </footer>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="JavaScript/userInfo.js"></script>
    <script src="JavaScript/header.js"></script>
<!--    <script src="JavaScript/jumbotron.js"></script>-->

    <script>
    const productSwiper = new Swiper ('.product-slider', {
    slidesPerView: 1,
    spaceBetween: 30,
    pagination: {
        el: '.swiper-pagination',
        clickable: true
    },
    breakpoints: {
        640: {
            slidesPerView: 1
        },
        768: {
            slidesPerView: 2
        },
        1024: {
            slidesPerView: 3
        }
    }
})
</script>

</body>
</html>
