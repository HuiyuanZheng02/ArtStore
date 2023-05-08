<!DOCTYPE html>

<?php

error_reporting(0);

session_start();

$userID = isset($_SESSION['userID'])?$_SESSION['userID']:'';
include ('includes/db_connect.php');
global $con;
//include ('includes/function.php');
$myItem = false;
$liked = false;
$itemID = $_GET["item_ID"];
$result = mysqli_query($con, "SELECT * FROM user WHERE userID = '$userID'");
while ($row_user = mysqli_fetch_array($result)){
    $userName = $row_user['userName'];
}
if(isset($_GET["item_ID"])){
    $sql = "SELECT * FROM item WHERE itemID = '$itemID'";
    $result = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($result)){
        $itemName = $row['itemName'];
        $authorName = $row['authorName'];
        $itemYear = $row['itemYear'];
        $publisherID = $row['publisher'];
        $genre = $row['genre'];
        $length = $row['length'];
        $width = $row['width'];
        $price = number_format($row['price']);
        $view = $row['view']+1;
        $itemDesc = $row['itemDesc'];
        $itemImage = $row['itemImg'];
        $buyer = $row['buyer'];
        $publishDate = $row['publish_date'];

        $user_sql = "SELECT * FROM user WHERE userID = '$publisherID'";
        $user_result = mysqli_query($con, $user_sql);
        while($user_row = mysqli_fetch_array($user_result)){
            $publisher = $user_row['userName'];
        }
    }
    $resultLiked = mysqli_query($con, "SELECT * FROM likes WHERE userID = '$userID' AND itemID = '$itemID'");
    if(mysqli_num_rows($resultLiked) != 0) $liked = true; // 判断是否已经在自己的购物车内
    if(isset($publisherID) && $publisherID== $userID) $myItem = true;
    if(isset($view) &&$userID !== ''){
        $update_item = "UPDATE item SET view = '$view'
            WHERE itemID='$itemID'";
        $run_item = mysqli_query($con, $update_item);
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
    <link rel="stylesheet" href="css/detail_product.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Asul:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Long+Cang&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ma+Shan+Zheng&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zhi+Mang+Xing&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <!-- Google Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                    <li><a href="#" class="active">商品详情</a></li>
                    <li><a href="#">关于</a></li>
                </ul>
                <ul>
                    <li class="nav_right"><a class="nav_right_a" href="shop.php"><i class="fa-solid fa-magnifying-glass fa-xl"></i></a></li>
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
        <div class="jumbotron jumbotron-bg" style="background-image: url('image/detail-bg.jpg');background-size:100% 100%">
            <div class="container">
                <h1>
                    Select your favorite product
                </h1>
                <p>
                    Enjoy your art travel
                </p>
            </div>
        </div>
    </div>

    <div class="product-detail" style="margin-bottom: 100px">
        <div class="detail-container">
            <div class="row">
                <div class="col detail-img_col" id="detail-img-col">
                    <div>
                        <img class="detail-img" src="<?php echo isset($itemImage)?'data:image/jpeg;base64, '.base64_encode($itemImage):'' ?>">
                        <div class="brush"></div>
                    </div>
                    <div class="enlarge">
                        <img class="enlarge-img" src="<?php echo isset($itemImage)?'data:image/jpeg;base64, '.base64_encode($itemImage):'' ?>">
                    </div>
                </div>
                <div class="col col-detail">
                    <div class="row">
                        <div class="col-header product-name">
                            <?php echo isset($itemName)?$itemName:'<grey>暂无名称</grey>' ?>
                            <span class="remarks" style="margin-left: 20px">
                                <?php echo isset($length)&&isset($width)?$length.'<span>&times;</span>'.$width:'<grey>暂无尺寸</grey>' ?>
                            </span>
                        </div>
                        <div class="col text-right remarks" style="min-width: 30px">
                            <i class="fa-solid fa-eye"></i>  <?php echo isset($view)?$view:'0' ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col divide"></div>
                    </div>
                    <div class="row" style="margin-top: 0px">
                        <div class="col price">
                            &#165 <strong class="price" style="font-size: 23px"><?php echo isset($price)?$price:'<grey>暂无价格</grey>' ?></strong>
                        </div>
                        <div class="col text-right remarks">
                            <?php echo isset($buyer)?'<grey>已售</grey>':'<grey>暂未出售</grey>' ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <br><br>
                            <strong>作者</strong>&ensp;/&ensp;<?php echo isset($authorName)?$authorName:'<grey>暂无作者</grey>' ?>
                            <br><br>
                            <strong>流派</strong>&ensp;/&ensp;<?php echo isset($genre)?$genre:'<grey>暂无流派</grey>' ?>
                            <br><br>
                            <strong>年代</strong>&ensp;/&ensp;<?php echo isset($itemYear)?$itemYear:'<grey>暂无年代</grey>' ?>
                            <br><br><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div style="display: <?php echo $myItem?'none':'block' ;?>;font-size: 26px">
                                <!--                                <strong>发布人</strong><br><br>-->
                                <?php echo isset($publisher)?$publisher:'<grey>暂无发布人</grey>' ?>
                                <br>
                                <span class="remarks" style="font-size: 10px">发布于</span><br>
                                <grey style="font-size: 23px"><?php echo isset($publishDate)?date("Y-m-d",strtotime($publishDate)):'暂无发布日期';?></grey>
                            </div>
                            <button class="btn btn-edit" style="display: <?php echo $myItem?'block':'none' ?>;" onclick="location.href='myProduct.php?item_ID=<?php echo $itemID?>'">编&ensp;辑</button>
                        </div>
                        <div class="col text-right" style="margin-bottom: 0;display: <?php echo isset($buyer)?'none':'block' ?>">
                            <button class="btn btn-submit" id="addToCart" onclick="addToCart(<?php echo ($userID=='')?'-1':$userID ?>,<?php echo $itemID ?>)" style="width: 200px;display: <?php echo $liked?'none':'block' ?>;">
                                <i class="fa-solid fa-cart-plus"></i> Add to Cart
                            </button>
                            <button class="btn btn-default" id="deleteFromCart" onclick="deleteFromCart(<?php echo ($userID=='')?'-1':$userID ?>,<?php echo $itemID ?>)" style="width: 200px;display: <?php echo $liked?'block':'none' ?>">
                                <i class="fa-solid fa-trash-can"></i> Delete from Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="desc-title">
                        简介
                    </div>
                    <div class="describe">
                        &ensp;&ensp;&ensp;&ensp;<?php echo isset($itemDesc)?$itemDesc:'<grey>暂无简介</grey>' ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment-container">
            <div class="row">
                <div class="col">
                    <div class="comment-title">
                        评论
                    </div>
                    <div class="comments">
                        <div class="mycomment">
                            <textarea class="comment-input" rows="3" placeholder="发表您的评论..." id="comment"></textarea>
                            <?php
                            if(isset($_SESSION['userID'])){ ?>
                                <button class="btn" id="comment-btn" onclick="leaveComment(<?php echo $itemID?>)">提 交</button>
                                <?php
                            }else{?>
                                <button class="btn" id="comment-btn" onclick="alert('请先登陆')">提 交</button>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="otherComments">
                            <?php
                            $sql_comment = "SELECT * FROM comment WHERE itemID = '$itemID' ORDER BY liked DESC ";
                            $result_comment = mysqli_query($con, $sql_comment);
                            while($row_comment = mysqli_fetch_array($result_comment)){
                                $commentID = $row_comment['commentID'];
                                $commentUser = $row_comment['userID'];
                                $sql_commentUser = mysqli_query($con, "SELECT * FROM user WHERE userID = '$commentUser'");
                                $row_commentUser = mysqli_fetch_array($sql_commentUser);
                                $result_liked = mysqli_query($con, "SELECT * FROM likeComment WHERE (commentID = '$commentID' AND userID = '$userID')");
                                $commentLiked = (bool)mysqli_num_rows($result_liked)
                                ?>
                            <div class="other-comment">
                                <div class="comment-writer"><?php echo $row_commentUser['userName'] .':'?></div>
                                <div class="comment-content">
                                    <?php echo $row_comment['comment']?>
                                </div>
                                <div class="comment-icon">
                                    <?php
                                    if(isset($_SESSION['userID'])){ ?>
                                    <button class="btn-icon" like-btn-for="<?php echo $commentID?>" onclick="unlikeCommend(<?php echo $commentID?>)" style="display: <?php echo $commentLiked?'inline':'none'?>"><span class="material-icons">thumb_up</span></button>
                                    <button class="btn-icon" unlike-btn-for="<?php echo $commentID?>" onclick="likeCommend(<?php echo $commentID?>)" style="display: <?php echo $commentLiked?'none':'inline'?>"><span class="material-icons">thumb_up_off_alt</span></button>
                                        <?php
                                    }else{?>
                                        <button class="btn-icon"  onclick="alert('请先登陆')" ><span class="material-icons">thumb_up_off_alt</span></button>
<?php
                                    }
                                    ?>
                                    <div id="liked-num" like-num-for="<?php echo $commentID?>" ><?php echo $row_comment['liked']?></div>
                                </div>
                            </div>
                                <div class="comment-time">
                                    <grey><?php echo $row_comment['comment_time']?></grey>
                                    <?php
                                    if(isset($_SESSION['userID']) && $commentUser == $_SESSION['userID']){
                                        ?>
                                        <button class="btn-icon" onclick="deleteCommend(<?php echo $commentID?>)"><span class="material-icons" style="font-size: 10px">delete_outline</span></button>
                                        <?php
                                    }
                                    ?>
                                </div>
                            <?php   }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    <footer>
        &copy 2022 ArtStore | Made with<i style="color: #fd4b4b;font-style: normal">&nbsp; &#9829; &nbsp;</i>in China by Grace
    </footer>

    <script src=".\JavaScript\like.js"></script>
    <script src=".\JavaScript\detail_product.js"></script>
    <script src=".\JavaScript\header.js"></script>
    <script language="JavaScript">setFoot(<?php echo $itemID?>,<?php echo $userID?>)</script>

</body>
</html>
