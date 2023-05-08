<!DOCTYPE html>
<?php
session_start();
//if(!isset($_SESSION['userID'])){
//    header("Location: index.php?action=-1");
//}
$userID = isset($_SESSION['userID'])?$_SESSION['userID']:'';
include ('includes/db_connect.php');
global $con;
if(isset($_SESSION['userID'])){
    $result = mysqli_query($con, "SELECT * FROM user WHERE userID = '$userID'");
    $userName = mysqli_fetch_array($result)['userName'];
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
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Asul:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Long+Cang&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zhi+Mang+Xing&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/c20011b147.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


    <script src ="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src=".\JavaScript\jQueryDotdotdot\src\jquery.dotdotdot.js"></script>

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
                <li class="nav_right"><a class="nav_right_a active" href="shop.php"><i class="fa-solid fa-magnifying-glass fa-xl"></i></a></li>
                <li class = "nav_right"><a class="nav_right_a" href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a></li>
                <?php
                if($userID == ''){
                    ?>
                    <li class="nav_right">
                        <i class="fa-solid fa-user fa-xl"></i>
                        <ul>
                            <li><a href="index.php?action=signin" id="SignInVis">登录</a></li>
                            <li><a href=index.php?action=signup" id="SignUpVis">注册</a></li>
                        </ul>
                    </li>
                    <?php
                }else{?>
                    <li class="nav_right" style="z-index: 3">
                        <i class="fa-solid fa-user fa-xl"></i>
                        <ul>
                            <li><a href="myProduct.php">发布</a></li>
                            <li><a href="includes\logout.php">退出</a></li>
                        </ul>
                    </li>
                    <li style="margin: -5px -50px auto -50px;">
                        <a href="userInfo.php" class="userInfo"><span style="font-family: 'Long Cang', cursive;">&ensp;&ensp;&ensp;Hi! </span><?php echo $userName ?></a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </nav>
    </div>
</header>

    <div class="bg-container">
        <div id="jumbotron-ol"></div>
        <!-- <div class="Imageslider"> -->
            <!-- <img src=".\image\cart-bg.png" height=auto width=100% > -->
        <!-- </div> -->
        <div class="jumbotron jumbotron-bg" style="background-image: url('image/shop-bg.jpg');background-size:100% 100%;">
            <div class="container">
                <h1  style="margin-top: 0px">
                    Select your favorite product
                </h1>
                <p>
                    Enjoy your art travel
                </p>
                <input class="search" placeholder="搜索艺术品名称或作者" id="search"><button class="btn btn-search" id="search-btn"><i class="fa-solid fa-magnifying-glass fa-xl" id="search-btn-icon"></i></button>
                <form class="sortBy" action="" method="get" name="formName">
                    <span style="font-size: larger"> </span>排序方式：
                    <input type="radio" name="sortBy" value="default" id="default" checked><label for="default">默认</label>
                    <input type="radio" name="sortBy" value="price" id="price" ><label for="price">价格升序</label>
                    <input type="radio" name="sortBy" value="priceDesc" id="priceDesc" ><label for="priceDesc">价格降序</label>
                    <input type="radio" name="sortBy" value="name" id="name" ><label for="name">名称升序</label>
                    <input type="radio" name="sortBy" value="nameDesc" id="nameDesc" ><label for="nameDesc">名称降序</label>
                    <input type="radio" name="sortBy" value="view" id="view" ><label for="view">热度</label>
                    <input type="radio" name="sortBy" value="date" id="date" ><label for="date">最新发布</label>
<!--                    <input type="radio" name="sortBy" value="dateDesc" id="dateDesc" ><label for="dateDesc">最早发布</label>-->
                    <span style="font-size: larger"> </span>
                </form>
            </div>
        </div>
    </div>

    <div class="container" style="margin-bottom: 100px">
        <div class="section">
            <div class="section-header" id="search-header" style="margin-top:50px">所有商品</div>
            <div class="swiper swiper-paginations all-product-swiper-test">
                <div class="swiper-wrapper">
                </div>
                <div class="swiper-pagination"></div>
<!--                <div class="swiper-button-prev"></div>-->
<!--                <div class="swiper-button-next"></div>-->
                <div class="pagesDiv"></div>
            </div>
        </div>
    </div>
</div>
<footer>
    &copy 2022 ArtStore&nbsp;&nbsp;|&nbsp;&nbsp;Made with<i style="color: #fd4b4b;font-style: normal">&nbsp; &#9829; &nbsp;</i>in China&nbsp;&nbsp;|&nbsp;&nbsp;by<span style="font-family: 'Long Cang', cursive;">&nbsp;&nbsp;Grace&nbsp;&nbsp;</span>Fudan 20SS
</footer>

</body>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src=".\JavaScript\header.js"></script>
<script src=".\JavaScript\shop.js"></script>


</html>
