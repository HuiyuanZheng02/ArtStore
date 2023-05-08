<!DOCTYPE html>
<?php
    error_reporting(0);

session_start();
$userID = $_SESSION['userID'];
include ('includes/db_connect.php');
global $con;
if(isset($userID)) {
    $result = mysqli_query($con, "SELECT * FROM user WHERE userID = '$userID'");
    $userName = mysqli_fetch_array($result)['userName'];
}
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Store</title>

    <!--Stylesheets-->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/login.css" />
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
            <li><a href="index.php" class="active">首页</a></li>
            <li><a href="#">商品详情</a></li>
            <li><a href="#">关于</a></li>
        </ul>
        <ul>
            <li class="nav_right"><a class="nav_right_a" href="shop.php"><i class="fa-solid fa-magnifying-glass fa-xl"></i></a></li>
            <li class = "nav_right"><a class="nav_right_a" href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a></li>
            <?php
            if(!isset($userID)){
                ?>
            <li class="nav_right">
                <i class="fa-solid fa-user fa-xl"></i>
                <ul>
                    <li><a href="#" id="SignInVis">登录</a></li>
                    <li><a href="#" id="SignUpVis">注册</a></li>
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

     <!-- 幻灯片轮播  -->

    <div class="container" style="padding: 0">
        <div class="swiper swiper-paginations show-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="show-overlay slogans">Welcome</div>
                    <div class="ratio ratio-16-9">
                        <div class="ratio-content bg-img"
                             style="background-image: url(image/Slideshow1.jpg);"></div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="ratio ratio-16-9">
                        <div class="show-overlay slogans" style="line-height: 220px">
                            <div style="margin-top: 70px">
                                Enjoy&nbsp;&nbsp;<br><img src=".\image\logo.png" height=300px width=auto style="margin-top: 150px" />
                                <span style="margin-left: -50px">travel</span>
                            </div>
                        </div>
                        <div class="ratio-content bg-img slogans"
                             style="background-image: url(image/Slideshow3.jpg);"></div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="ratio ratio-16-9">
                        <div class="show-overlay slogans" style="line-height: 270px">
                            <div style="margin-top: 120px">
                                vi<span style="color: var(--main_color);">su</span>al&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;fe<span style="color: var(--main_color)">as</span>t
                            </div>
                        </div>
                        <div class="ratio-content bg-img slogans"
                             style="background-image: url(image/Slideshow2.jpg);"></div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="ratio ratio-16-9">
                        <div class="show-overlay slogans " style="line-height: 230px">
                            <div style="margin-top: 120px">
                                keep&nbsp;&nbsp;&nbsp;&nbsp;<br><span style="color: var(--main_color)">&nbsp;&nbsp;shop</span>ping
                            </div>
                        </div>
                        <div class="ratio-content bg-img slogans"
                             style="background-image: url(image/Slideshow4.jpg);"></div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="ratio ratio-16-9">
                        <div class="show-overlay slogans" style="line-height: 230px">
                            <div style="margin-top: 120px">
                                select&nbsp;&nbsp;&nbsp;&nbsp;<br>&nbsp;&nbsp;f<span style="color: var(--main_color)">a</span>vo<span style="color: var(--main_color)">r</span>i<span style="color: var(--main_color)">t</span>e
                            </div>
                        </div>
                        <div class="ratio-content bg-img slogans"
                             style="background-image: url(image/Slideshow5.jpg);"></div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <!-- 热门商品 -->
    <div class="container">
        <div class="section">
            <a href="shop.php" class="more"><grey>更 多</grey></a>
            <div class="section-header">热门商品</div>
            <div class="swiper swiper-paginations product-slider">
                <div class="swiper-wrapper" style="margin-bottom: 30px">
                    <?php
                    include ('includes/db_connect.php');
                    global $con;

                    $sql_view = "SELECT * FROM item ORDER BY view desc ";
                    $result_view = mysqli_query($con, $sql_view);
                    $i = 0;
                    while ($row_view = mysqli_fetch_array($result_view)){
                        $itemID = $row_view['itemID'];
                        if($i > 4) break;
                        ++$i;
                        ?>

                    <div class="swiper-slide">
                        <a href="detail_product.php?item_ID=<?php echo $row_view['itemID'] ?>" style="color: black;text-decoration: none">
                            <div class="product-card">
                            <div class="product-card-img">
                                <div class="ratio ratio-1-1">
                                    <div class="ratio-content bg-img"
                                         style="background-image:url(data:image/jpeg;base64,<?php echo base64_encode($row_view['itemImg']) ?>);"></div>
                                </div>
                            </div>
                            <div class="product-card-name">
                                <div class="product-name" style="font-size: 35px;">
                                    <?php echo isset($row_view['itemName'])?$row_view['itemName']:'<grey>暂无名称</grey>' ?>
                                </div>
                                <div class="text-right" style="margin-bottom: 5px;font-family: var(--font_chinese_family)">
                                    <strong>作者</strong>&ensp;/&ensp;<?php echo isset($row_view['authorName'])?$row_view['authorName']:'<grey>暂无作者</grey>' ?>
                                </div>
                            </div>
                            <div class="product-card-footer">
                                <div class="product-card-footer__price price" style="margin-left: -10px">
                                    &#165 <strong class="price" style="font-size: 23px">
                                        <?php echo isset($row_view['price'])?number_format($row_view['price']):'<grey>暂无价格</grey>';?></strong>
                                </div>
                                <div class="product-card-footer__btn">
                                    <?php
                                    $result_like = mysqli_query($con, "SELECT * FROM likes WHERE (userID = '$userID' AND itemID = '$itemID')");
                                    if(mysqli_num_rows($result_like) == 0){
                                    ?>
                                    <button class="product-card-btn" style="height: 20px;" onclick="addToCart(<?php echo $_SESSION['userID']?>,<?php echo $row_view['itemID'] ?>)">
                                        <span class="material-icons-outlined">add_shopping_cart</span>
                                    </button>
                                    <?php
                                    }else { ?>
                                    <button class="product-card-btn" style="height: 20px;" onclick="deleteFromCart(<?php echo $_SESSION['userID']?>,<?php echo $row_view['itemID'] ?>)">
                                        <span class="material-icons-outlined">remove_shopping_cart</span>
                                    </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="remarks row" style="margin-top: 20px">
                                <div class="col">
                                    <span class="remarks" style="font-family: var(--font_chinese_family);font-size: 10px">发布于&nbsp;</span>
                                    <grey style="font-size: 19px"><?php echo isset($row_view['publish_date'])?date("Y-m-d",strtotime($row_view['publish_date'])):'暂无发布日期';?></grey>
                                </div>
                                <div class="col  text-right">
                                    <i class="fa-solid fa-eye"></i>  <?php echo isset($row_view['view'])?$row_view['view']:'0' ?>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                    </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <!-- END HOT PRODUCT -->
    <!-- 最新商品 -->
    <div class="container">
        <div class="section">
            <a href="shop.php" class="more"><grey>更 多</grey></a>
            <div class="section-header">最新商品</div>
            <div class="swiper swiper-paginations product-slider">
                <div class="swiper-wrapper" style="margin-bottom: 30px">
                    <?php

                    $sql_date = "SELECT * FROM item ORDER BY publish_date DESC";
                    $result_date = mysqli_query($con, $sql_date);
                    $i = 0;
                    while ($row_date = mysqli_fetch_array($result_date)){
                        $itemID = $row_date['itemID'];
                        if($i > 4) break;
                        ++$i;
                        ?>
                        <div class="swiper-slide">
                            <a href="detail_product.php?item_ID=<?php echo $row_date['itemID'] ?>" style="color: black;text-decoration: none">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <div class="ratio ratio-1-1">
                                            <div class="ratio-content bg-img"
                                                 style="background-image:url(data:image/jpeg;base64,<?php echo base64_encode($row_date['itemImg']) ?>);">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-card-name">
                                        <div class="product-name" style="font-size: 35px;">
                                            <?php echo isset($row_date['itemName'])?$row_date['itemName']:'<grey>暂无名称</grey>' ?>
                                        </div>
                                        <div class="text-right" style="margin-bottom: 5px;font-family: var(--font_chinese_family)">
                                            <strong>作者</strong>&ensp;/&ensp;<?php echo isset($row_date['authorName'])?$row_date['authorName']:'<grey>暂无作者</grey>' ?>
                                        </div>
                                    </div>
                                    <div class="product-card-footer">
                                        <div class="product-card-footer__price price" style="margin-left: -10px">
                                            &#165 <strong class="price" style="font-size: 23px">
                                                <?php echo isset($row_date['price'])?number_format($row_date['price']):'<grey>暂无价格</grey>';?></strong>
                                        </div>
                                        <div class="product-card-footer__btn">
                                            <?php
                                            $result_like = mysqli_query($con, "SELECT * FROM likes WHERE (userID = '$userID' AND itemID = '$itemID')");
                                            if(mysqli_num_rows($result_like) == 0){
                                                ?>
                                                <button class="product-card-btn" style="height: 20px;" onclick="addToCart(<?php echo $_SESSION['userID']?>,<?php echo $row_date['itemID'] ?>)">
                                                    <span class="material-icons-outlined">add_shopping_cart</span>
                                                </button>
                                                <?php
                                            }else { ?>
                                                <button class="product-card-btn" style="height: 20px;" onclick="deleteFromCart(<?php echo $_SESSION['userID']?>,<?php echo $row_date['itemID'] ?>)">
                                                    <span class="material-icons-outlined">remove_shopping_cart</span>
                                                </button>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="remarks row" style="margin-top: 20px">
                                        <div class="col">
                                            <span class="remarks" style="font-family: var(--font_chinese_family);font-size: 10px">发布于&nbsp;</span>
                                            <grey style="font-size: 19px"><?php echo isset($row_date['publish_date'])?date("Y-m-d",strtotime($row_date['publish_date'])):'暂无发布日期';?></grey>
                                        </div>
                                        <div class="col  text-right">
                                            <i class="fa-solid fa-eye"></i>  <?php echo isset($row_date['view'])?$row_date['view']:'0' ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <!-- END NEW PRODUCT -->

    <!-- 弹出容器 -->
    <div class = "popup-container" id = "popup-container">
        <!-- SignUp Form -->
        <div class="form-container sign-up-container" id="signup-form">
            <form action="includes/signup.php" class="form-signUp" method="POST" onsubmit="return checkSignupForm()">
                <h1 style="color:#ffc773; margin-bottom: 5px; margin-top: -5px;" >Create Account</h1>
                <div class="form-group">
                    <input type="text" name="userName" class="form-input" placeholder="用户名" id = "signup-name" required>
                    <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                    <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span class="form-input-err-msg" data-err-for="signup-name"></span>
                </div>
                <div class="form-group">
                    <input type="text" name="phoneNumber" class="form-input" placeholder="电话" id = "signup-phoneNumber" required>
                    <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                    <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span class="form-input-err-msg" data-err-for="signup-phoneNumber"></span>
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-input" placeholder="邮箱" id = "signup-email" required>
                    <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                    <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span class="form-input-err-msg" data-err-for="signup-email"></span>
                </div>
                <div class="form-group">
                    <input type="text" name="address" class="form-input" placeholder="地址" id = "signup-address" required>
                    <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                    <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span class="form-input-err-msg" data-err-for="signup-address"></span>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="密码" id = "signup-password" required>
                    <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                    <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span class="form-input-err-msg" data-err-for="signup-password"></span>
                    <div id="tips"> <span style="border-radius: 5px 0 0 5px"></span> <span></span> <span style="border-radius: 0 5px 5px 0"></span> </div>
                </div>
                <div class="form-group">
                    <input type="password" name="chkPsw" class="form-input" placeholder="确认密码" id = "signup-chkPsw" required>
                    <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                    <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span class="form-input-err-msg" data-err-for="signup-chkPsw"></span>
                </div>
                <button type="submit" id="register" style="margin-top:10px">注&ensp;册</button>
            </form>
        </div>
        <!-- SignIn Form -->
        <div class="form-container sign-in-container" id="signin-form">
            <form action="includes/signin.php" class="form-signin" method="POST" onsubmit="return checkSigninForm()">
                <h1 style="color:#ffc773">Sign In</h1>
                <div class="form-group">
                    <input type="text" class="form-input" name="nameOrEmail" placeholder="用户名/邮箱" id ="signin-name" required>
                    <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                    <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span class="form-input-err-msg" data-err-for="signin-name"></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-input" name="password" placeholder="密码" id ="signin-password" required>
                    <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                    <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span class="form-input-err-msg" data-err-for="signin-password"></span>
                </div>
                <div class="form-group">
                    <div class="row " style="margin-top: 0">
                        <div class="col">
                            <input type="text" class="form-input verify" name="verify" placeholder="验证码" id ="signin-verify" required>
                        </div>
                        <div class="col" id="verify"></div>
                    </div>
                    <span class="form-input-icon err" style="right: 56%">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                    <span class="form-input-icon success" style="right: 56%">
                        <i class="fa-solid fa-check"></i>
                    </span>
                    <span class="form-input-err-msg" data-err-for="signin-verify"></span>
                </div>
                 <a href="#" id="forget-link" style="margin-top: 50px;color: var(--txt_third_color)">Forgot your password?</a>
                <button type="submit" id="login">登&ensp;录</button>
            </form>
        </div>

        <!-- Overlays for the Forms -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p style="margin-left: -100px;">已有</p>
<!--                    <div class="logo"><span class="logo">Art</span> Store</div>-->
                    <div class="logo">
                        <img src=".\image\logo.png" height=55px width=auto />
                        <span style="margin-left: 5px;font-size: 20px"> Store</span>
                    </div>
                    <p style="margin-right: -125px;">帐户</p>
                    <button class="ghost" id="signIn">
                        <i class="fa-solid fa-circle-arrow-left fa-20px"></i>
                    </button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 style="margin-bottom: 30px;">Hello!</h1>
                    <p style="margin-left: -70px;">创建您的</p>
<!--                    <div class="logo"><span>Art</span> Store</div>-->
                    <div class="logo">
                        <img src=".\image\logo.png" height=55px width=auto />
                        <span style="margin-left: 5px;font-size: 20px"> Store</span>
                    </div>
                    <p style="margin-right: -125px;">帐户</p>
                    <button class="ghost" id="signUp">
                        <i class="fa-solid fa-circle-arrow-right fa-20px"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of the PopUp div. -->

    <footer style="margin-top: 50px">
        &copy 2022 ArtStore&nbsp;&nbsp;|&nbsp;&nbsp;Made with<i style="color: #fd4b4b;font-style: normal">&nbsp; &#9829; &nbsp;</i>in China&nbsp;&nbsp;|&nbsp;&nbsp;by<span style="font-family: 'Long Cang', cursive;">&nbsp;&nbsp;Grace&nbsp;&nbsp;</span>Fudan 20SS
    </footer>

    <div id="hidden"></div>


<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src=".\JavaScript\gVerify.js"></script>
<script src=".\JavaScript\login.js"></script>
<script src=".\JavaScript\validate.js"></script>
<script src=".\JavaScript\like.js"></script>
<script src=".\JavaScript\header.js"></script>
<script language="JavaScript">
    const productSwiper = new Swiper('.product-slider', {
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
    const showSwiper = new Swiper ('.show-slider', {
        // direction: 'vertical', // 垂直切换选项
        loop: true, // 循环模式选项
        // slidesPerView: 1,
        // spaceBetween: 0,

        // 需要分页器
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false, // 手动切换之后继续自动轮播
        },
        // 如果需要前进后退按钮
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        breakpoints: {
                slidesPerView: 1
        }
    })
</script>

</body>
</html>
<?php
if($_GET["action"] == 'signin'){
    echo "<script>signin()</script>";
}else if($_GET["action"] == 'signup'){
    echo "<script>signup()</script>";
}else if($_GET["action"] == -1&&!isset($_SESSION['userID'])){
    echo "<script>alert('请先登陆')</script>";
}
