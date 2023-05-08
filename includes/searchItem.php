<?php
session_start();

$con = new mysqli('localhost', 'root', 'hysyxx20080135', 'OASD_project');

if ($con->connect_error) {
//    echo "连接 MySQL 失败: " . mysqli_connect_error();
    die("连接 MySQL 失败: " . $con->connect_error);
}

$userID = isset($_SESSION['userID'])?$_SESSION['userID']:'-1';

//$search = $_GET['search'];
$sortBy = $_GET['sort_by'];
$likeArr = [];
$result_like = mysqli_query($con, "SELECT * FROM likes WHERE userID = '$userID'");
while ($row = mysqli_fetch_array($result_like)){
    $likeArr[] = $row['itemID'];
}

switch ($sortBy){
    case 'price':
        $sql = "SELECT itemID,itemImg,itemName,authorName,price,view,itemDesc,publish_date,buyer FROM item ORDER BY price";
        $result = mysqli_query($con, $sql);
        break;
    case 'priceDesc':
        $sql = "SELECT itemID,itemImg,itemName,authorName,price,view,itemDesc,publish_date,buyer  FROM item ORDER BY price DESC ";
        $result = mysqli_query($con, $sql);
        break;
    case 'view':
        $sql = "SELECT itemID,itemImg,itemName,authorName,price,view,itemDesc,publish_date,buyer  FROM item ORDER BY view DESC ";
        $result = mysqli_query($con, $sql);
        break;
    case 'name':
        $sql = "SELECT itemID,itemImg,itemName,authorName,price,view,itemDesc,publish_date  FROM item ORDER BY itemName ";
        $result = mysqli_query($con, $sql);
        break;
    case 'nameDesc':
        $sql = "SELECT itemID,itemImg,itemName,authorName,price,view,itemDesc,publish_date  FROM item ORDER BY itemName DESC ";
        $result = mysqli_query($con, $sql);
        break;
    case 'date':
        $sql = "SELECT itemID,itemImg,itemName,authorName,price,view,itemDesc,publish_date,buyer  FROM item ORDER BY publish_date DESC ";
        $result = mysqli_query($con, $sql);
        break;
    default:
        $sql = "SELECT itemID,itemImg,itemName,authorName,price,view,itemDesc,publish_date,buyer  FROM item";
        $result = mysqli_query($con, $sql);
        break;
}

$arr = [];
while ($row = mysqli_fetch_assoc($result)){
    $arr[] = array(
        'userID' => $userID,
        'itemID' => $row['itemID'],
        'itemImg' => 'data:image/jpeg;base64,'.base64_encode($row['itemImg']),
        'itemName' => $row['itemName'],
        'authorName' => $row['authorName'],
        'price' => $row['price'],
        'view'=> $row['view'],
        'itemDesc' => $row['itemDesc'],
        'publish_date'=>date("Y-m-d",strtotime($row['publish_date'])),
        'liked' => in_array($row['itemID'],$likeArr)?'liked':'unlike',
        'firstChar' => getFirstCharter($row['itemName']),
        'sold' => isset($row['buyer']),
        );
}


if($sortBy == 'name') array_multisort(array_column($arr,'firstChar'),SORT_ASC,$arr);
if($sortBy == 'nameDesc') array_multisort(array_column($arr,'firstChar'),SORT_DESC,$arr);

echo json_encode($arr,JSON_UNESCAPED_SLASHES,JSON_UNESCAPED_UNICODE);

mysqli_close($con);


function getFirstCharter($str){
    if(empty($str)){return "";}
    $fchar = ord($str[0]);
    if($fchar >= ord("A") && $fchar <= ord("z")) return strtoupper($str[0]);
    $s1 = iconv("UTF-8","gb2312",$str);
    $s2 = iconv("gb2312","UTF-8",$s1);
    $s = $s2==$str?$s1:$str;
    $asc = ord($s[0])*256+ord($s[1])-65536;
    if($asc>=-20319&&$asc<=-20284) return "A";
    if($asc>=-20283&&$asc<=-19776) return "B";
    if($asc>=-19775&&$asc<=-19219) return "C";
    if($asc>=-19218&&$asc<=-18711) return "D";
    if($asc>=-18710&&$asc<=-18527) return "E";
    if($asc>=-18526&&$asc<=-18240) return "F";
    if($asc>=-18239&&$asc<=-17923) return "G";
    if($asc>=-17922&&$asc<=-17418) return "H";
    if($asc>=-17417&&$asc<=-16475) return "J";
    if($asc>=-16474&&$asc<=-16213) return "K";
    if($asc>=-16212&&$asc<=-15641) return "L";
    if($asc>=-15640&&$asc<=-15166) return "M";
    if($asc>=-15165&&$asc<=-14923) return "N";
    if($asc>=-14922&&$asc<=-14915) return "O";
    if($asc>=-14914&&$asc<=-14631) return "P";
    if($asc>=-14630&&$asc<=-14150) return "Q";
    if($asc>=-14149&&$asc<=-14091) return "R";
    if($asc>=-14090&&$asc<=-13319) return "S";
    if($asc>=-13318&&$asc<=-12839) return "T";
    if($asc>=-12838&&$asc<=-12557) return "W";
    if($asc>=-12556&&$asc<=-11848) return "X";
    if($asc>=-11847&&$asc<=-11056) return "Y";
    if($asc>=-11055&&$asc<=-10247) return "Z";
    return null;
}