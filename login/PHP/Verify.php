
<?php

// 声明相关变量
$UserName = $_POST["userName"];
$Password = $_POST["password"];
$cookie = $_COOKIE["user"];
$RealPassword = "";

// 验证用户名和密码
if (!preg_match("/^[0-9a-z\u4e00-\u9fa5]{4,16}$/i", $UserName)) {
    echo "User name is Wrong! ";
}
if (!preg_match("/^[0-9a-f]{32}$/", $Password)) {
    echo "Password is Wrong! ";
}

// 在数据库中查找用户名对应的密码
include "main.php";
$con = connect_SQL("MAIN");
$sql = "SELECT * FROM `LOGINDATA` WHERE `USERNAME` = '{$UserName}';";
$result = mysqli_query($con, $sql);
$obj = null;
@$obj = mysqli_fetch_object($result);
@mysqli_free_result($result);
mysqli_close($con);
if ($obj) {
    $RealPassword = $obj->PASSWORD;
}

// 判断用户名和密码匹配情况
if ($obj == null) {
    echo 1; // 未找到匹配的用户名
} else if ($RealPassword != $Password) {
    echo 2; // 密码错误
} else {
    echo 0; // 密码匹配，登录成功

    // 验证cookie
    if (!preg_match("/^[0-9a-f]{32}$/", $cookie)) {
        die("cookie error! ");
    }

    // 将cookie写入数据库
    $con = connect_SQL("MAIN");
    $sql = "UPDATE `LOGINDATA` SET `COOKIE` = '{$cookie}' WHERE `USERNAME` = '{$UserName}';";
    mysqli_query($con, $sql);
    $sql = "UPDATE `LOGINDATA` SET `TIME`= NOW() WHERE `USERNAME` = '{$UserName}';";
    mysqli_query($con, $sql);
    mysqli_close($con);
}

?>