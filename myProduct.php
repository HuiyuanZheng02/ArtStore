<!DOCTYPE html>

<?php
session_start();
if(!isset($_SESSION['userID'])){
    header("Location: index.php?action=-1");
}

include ('includes/db_connect.php');
global $con;

$userID = $_SESSION['userID'];
$result = mysqli_query($con, "SELECT * FROM user WHERE userID = '$userID'");
$userName = mysqli_fetch_array($result)['userName'];

$itemName = '';
$authorName = '';
$itemYear ='';
$genre = '';
$length = '';
$width = '';
$price = '';
$itemDesc = '';
$itemImage = '';
$editTime = 0;
if(isset($_GET["item_ID"])){
    $itemID = $_GET["item_ID"];
    $sql = "SELECT * FROM item WHERE itemID = '$itemID'";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($result)) {
        if($row['publisher'] !== $_SESSION['userID']) {
            echo "<script>alert('不是您发布的商品，暂无权限更改');</script>";
            break;
        }
        if(isset($row['buyer'])){
            echo "<script>alert('已经出售商品无法修改信息');history.back()</script>";
            break;
        }
        $itemName = $row['itemName'];
        $authorName = $row['authorName'];
        $itemYear = $row['itemYear'];
        $genre = $row['genre'];
        $length = $row['length'];
        $width = $row['width'];
        $price = $row['price'];
        $itemDesc = $row['itemDesc'];
        $itemImage = $row['itemImg'];
        $editTime = $row['editTime']+1;
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
    <link rel="stylesheet" href="css/myProduct.css" />
    <link rel="stylesheet" href="css/jumbotron.css" />
<!--    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />-->

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
                    <li class = "nav_right"><a class="nav_right_a" href="cart.php"><i class="fa-solid fa-cart-shopping fa-xl"></i></a></li>
                    <li class="nav_right active" style="z-index: 3">
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
                <?php echo isset($itemID)?'Edit':'Add' ?> Your Product
                </h1>
                <p>
                Enjoy your art travel
                </p>
            </div>
        </div>
    </div>

    <div class="form-container" id="productForm" style="margin-bottom: 70px">
        <form name="myProduct" action="<?php echo isset($itemID)?'':'includes/addProduct.php' ?>" method="post" onsubmit="return validItemForm(<?php echo isset($itemID)?1:0; ?>);" enctype="multipart/form-data">
            <div class="row row-fm">
                <div class="col">
                    <div class="upload" style="margin-right: 10%">
                        <!-- 只接受jpg，jpeg和png格式 -->
                        <input name="itemImage" class="upload-input" id="upload-input" type="file" accept="image/jpeg, image/jpg, image/png" onchange="showImg(this)" />
                        <!-- 自定义按钮效果 -->
                        <div class="upload-btn" style="height: 250px;">
                            <div id="upload-icon"  style="display: <?php echo isset($itemID)?'none':'block'; ?>" >
                                <i class="fa-solid fa-cloud-arrow-up fa-7x" style="vertical-align: baseline;margin:auto;color: #9b9a92;"></i>
                                <div style="margin-top: -200px">上传艺术品图片</div>
                                <div style="margin-top: -225px">（仅支持jpg，jpeg和png格式）</div>
                            </div>
<!--                            --><?php //echo '<img src="data:image/jpg;base64, '.base64_encode($itemImage). '" id="show" class="upload-show"/>'?>
                            <img src="<?php echo isset($itemID)?'data:image/jpeg;base64, '.base64_encode($itemImage):'' ?>" id="show" class="upload-show"/>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <div class="form-title">艺术品名称：</div>
                        <input type="text" name="itemName" class="form-input" id = "itemName" value = "<?php echo $itemName ?>" required>
                        <span class="form-input-icon err">
                            <i class="fa-solid fa-exclamation"></i>
                        </span>
                        <span class="form-input-icon success">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <span class="form-input-err-msg" data-err-for="itemName"></span>
                    </div>
                    <div class="form-group">
                        <div class="form-title">作者姓名：</div>
                        <input type="text" name="authorName" class="form-input" id = "authorName" value = "<?php echo $authorName ?>" required>
                        <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                        <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                        <span class="form-input-err-msg" data-err-for="authorName"></span>
                    </div>
                    <div class="form-group">
                        <div class="form-title">年份：</div>
                        <input onClick="WdatePicker({dateFmt: 'yyyy'})" type="text" max="2022" name="itemYear" class="form-input" id = "itemYear" value = "<?php echo $itemYear ?>" required>
                        <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                        <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                        <span class="form-input-err-msg" data-err-for="itemYear"></span>
                    </div>
                    <div class="form-group">
                        <div class="form-title">流派：</div>
                        <input type="text" name="genre" class="form-input" id = "genre" value = "<?php echo $genre ?>" required>
                        <span class="form-input-icon err">
                        <i class="fa-solid fa-exclamation"></i>
                    </span>
                        <span class="form-input-icon success">
                        <i class="fa-solid fa-check"></i>
                    </span>
                        <span class="form-input-err-msg" data-err-for="genre"></span>
                    </div>
                    <div class="form-group">
                        <div class="form-title">尺寸：</div>
                        <input type="text" placeholder="长" name="length" class="form-input genre" id = "size" value = "<?php echo $length ?>" required>
                        &times;
                        <input type="text" placeholder="宽" name="width" class="form-input genre" id = "size" value = "<?php echo $width ?>" required>&emsp;cm
                        <span class="form-input-err-msg" data-err-for="size"></span>
                    </div>
                    <div class="form-group">
                        <div class="form-title">价格：</div>
                        <input type="text" name="price" class="form-input" id = "price" style="width: 40%" value = "<?php echo $price ?>" required>&emsp;RMB
                        <span class="form-input-err-msg" data-err-for="price"></span>
                    </div>
                </div>
            </div>
            <div  class="row row-desc" style="margin-top: -10px">
                <div class="col">
                    <div class="form-group">
                        <div class="form-title" style="vertical-align:top;width: 10%">简介：</div>
                        <textarea class="form-input" name="itemDesc" style="width: 75%" rows="7" id = "itemDesc" placeholder="不超过200字" required><?php echo $itemDesc ?></textarea>
                        <span class="form-input-err-msg" data-err-for="itemDesc" style="margin-left: 11%"></span>
                    </div>
                </div>
            </div>
            <div  class="row row-fm">
                <div class="col text-right" style="margin-right: 16%">
                    <button class="btn" type="button" id="cancel" onclick="history.back();">取&ensp;消</button>
                    <button class="btn btn-submit" type="submit" id="submit" name="submitMyItem">提&ensp;交</button>
                </div>
            </div>
        </form>
    </div>
</div>
    <footer>
        &copy 2022 ArtStore | Made with<i style="color: #fd4b4b;font-style: normal">&nbsp; &#9829; &nbsp;</i>in China by Grace
    </footer>

    <script src=".\JavaScript\My97DatePicker\WdatePicker.js"></script>
    <script src=".\JavaScript\myProduct.js"></script>
    <script src=".\JavaScript\header.js"></script>

</body>
</html>

<?php

if(isset($_POST['submitMyItem']) && isset($itemID)) {

    $itemName = $_POST['itemName'];
    $authorName = $_POST['authorName'];
    $itemYear = $_POST['itemYear'];
    $genre = $_POST['genre'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $price = $_POST['price'];
    $itemDesc = $_POST['itemDesc'];
    $publisher = $_SESSION['userID'];
//    $itemImage = addslashes(file_get_contents($_FILES['itemImage']['name']));

    if($_FILES['itemImage']['tmp_name'] == ''){
        $update_item = "UPDATE item SET itemName = '$itemName',
                authorName = '$authorName',
                itemYear = '$itemYear',
                genre = '$genre',
                length = '$length',
                width = '$width',
                price = '$price',
                itemDesc = '$itemDesc',
                editTime = '$editTime'
            WHERE itemID='$itemID'";
    }else{
        $itemImage = addslashes(file_get_contents($_FILES['itemImage']['tmp_name']));
        $update_item = "UPDATE item SET itemName = '$itemName',
                authorName = '$authorName',
                itemYear = '$itemYear',
                genre = '$genre',
                length = '$length',
                width = '$width',
                price = '$price',
                itemDesc = '$itemDesc',
                itemImg = '$itemImage',
                editTime = '$editTime'
            WHERE itemID='$itemID'";
    }
    $run_item = mysqli_query($con, $update_item);
    echo "<script>alert('修改成功！');location='/userInfo.php'</script>";
//    if ($con->query($update_item) === TRUE) {
//        $con->close();
//        header("Location: /userInfo.php");
//    }
}
?>