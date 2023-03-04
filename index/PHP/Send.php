
<?php

$ChatID = $_POST["chatID"];
$Content = $_POST["content"];
$cookie = $_COOKIE["user"];

include "main.php";

// 获取用户名
$UserName = check_cookie($cookie);
if (!$UserName) die("您没有权限！");

// 查询用户是否拥有好友或加入群聊
$finded = false;

$con = connect_SQL("USERS");
$sql = "SELECT `CHATID` FROM `GROUPS-$UserName` WHERE 1;";
$result = mysqli_query($con, $sql);
while (@$obj = mysqli_fetch_object($result)) {
    if ($obj->CHATID == $ChatID) {
        $finded = true;
        break;
    }
}
@mysqli_free_result($result);

$sql = "SELECT `CHATID` FROM `CONT-$UserName` WHERE 1;";
$result = mysqli_query($con, $sql);
while (@$obj = mysqli_fetch_object($result)) {
    if ($obj->CHATID == $ChatID || $finded == true) {
        $finded = true;
        break;
    }
}
@mysqli_free_result($result);
mysqli_close($con);

if (!$finded) {
    die("您没有权限！");
}

// 检测$Content合法性
// if (!preg_match("/'/", $Content)) {
//     die("消息不合法！");
// }

// 将信息写入数据库
$con = connect_SQL("CHATS");
$Content = preg_replace("/'/", "&#039", $Content);
$Content = preg_replace("/</", "&#060", $Content);
$Content = preg_replace("/>/", "&#062", $Content);
$Content = preg_replace("/\\\\/", "&#092", $Content);
$sql = "INSERT INTO `$ChatID` VALUES ('$UserName', 1, '$Content', NOW())";
mysqli_query($con, $sql);
mysqli_close($con);
echo 0;

?>