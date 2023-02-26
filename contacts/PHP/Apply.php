
<?php

$name = $_POST["name"];
$cookie = $_COOKIE["user"];

include "main.php";
$Username = null;
$UserName = check_cookie($cookie);
if (!$UserName) {
    die("您没有权限！");
}

// 检测申请添加的是否为自己
if ($UserName == $name) {
    die("不能添加自己为好友！");
}

$con = connect_SQL("USERS");

// 检测是否已有好友信息
$sql = "SELECT * FROM `CONT-$UserName` WHERE `CONTACTS` = '$name';";
$result = mysqli_query($con, $sql);
$obj = null;
if (@$obj = mysqli_fetch_object($result)) {

    // 如果对方发起过好友申请
    if ($obj->STATUS == 2) {
        create_contact($UserName, $name);
        echo 0; // 申请成功，并直接建立好友联系
    } else {
        echo 1; // 不可重复申请，申请失败
    }
} else {
    // 在双方用户数据表中插入申请信息
    $sql = "INSERT INTO `CONT-$UserName` VALUES ('$name', 1, NULL);";
    mysqli_query($con, $sql);
    $sql = "INSERT INTO `CONT-$name` VALUES ('$UserName', 2, NULL);";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo 0; // 申请成功
}

?>