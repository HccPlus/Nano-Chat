
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
    echo 5;
    die();
}

$con = connect_SQL("MAIN");
$sql = "SELECT * FROM `LOGINDATA` WHERE `USERNAME` = '$name';";
$result = mysqli_query($con, $sql);
$obj = null;
// 检测用户是否存在
if (@$obj = mysqli_fetch_object($result)) {

    // 用户存在的情况
    $USERS_con = connect_SQL("USERS");
    $USERS_sql = "SELECT *FROM `CONT-$UserName` WHERE `CONTACTS` = '$name';";
    $USERS_result = mysqli_query($USERS_con, $USERS_sql);
    $USERS_obj = null;
    // 如果用户数据表中已经存在则按需返回，否则返回0
    if (@$USERS_obj = mysqli_fetch_object($USERS_result)) {
        if ($USERS_obj->STATUS == 0) {
            echo 1; // 已经是好友了
        } else if ($USERS_obj->STATUS == 1) {
            echo 2; // 已经申请过了
        } else if ($USERS_obj->STATUS == 2) {
            echo 3; // 对方已经申请添加你为好友
        }
    } else {
        echo 0; // 用户数据表中无对方用户，可以进行好友添加申请
    }
    @mysqli_free_result($USERS_result);
    mysqli_close($USERS_con);

} else {

    // 用户不存在的情况
    echo 4; // 用户不存在
}

@mysqli_free_result($result);
mysqli_close($con);

?>