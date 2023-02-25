
<?php

// 声明相关变量
$UserName = $_POST["userName"];
$Password = $_POST["password"];
$cookie = $_COOKIE["user"];

// 验证用户信息
if (!preg_match("/^[a-z0-9\x{4e00}-\x{9fa5}]{4,16}$/iu", $UserName)) {
    die("用户名不合法！");
}
if (!preg_match("/^[0-9a-f]{32}$/i", $cookie)) {
    die("密码不合法！");
}
if (!preg_match("/^[0-9a-f]{32}$/", $cookie)) {
    die("cookie值不合法！");
}

// 查询用户名是否已存在
include "main.php";
$con = connect_SQL("MAIN");
$sql = "SELECT * FROM `LOGINDATA` WHERE `USERNAME` = '{$UserName}';";
$result = mysqli_query($con, $sql);
$obj = null;
@$obj = mysqli_fetch_object($result);
@mysqli_free_result($result);

// 若已存在则返回提示，否则将信息写入数据库并返回0
if ($obj != null) {
    echo 1; // 用户名已存在
} else {
    $sql = "INSERT INTO `LOGINDATA` VALUES ('{$UserName}', '{$Password}', '{$cookie}', NOW());";
    mysqli_query($con, $sql);
    mysqli_close($con);

    $con = connect_SQL("USERS");
    $sql = "CREATE TABLE `CONT-$UserName` (`CONTACTS` VARCHAR(16), `STATUS` TINYINT, `CHATID` VARCHAR(16));";
    mysqli_query($con, $sql);
    $sql = "CREATE TABLE `GROUPS-$UserName` (`STATUS` TINYINT, `CHATID` VARCHAR(16));";
    mysqli_query($con, $sql);
    mysqli_close($con);
    echo 0;
}

?>