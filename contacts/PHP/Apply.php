
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

$con = connect_SQL("MAIN");
$sql = "SELECT * FROM `LOGINDATA` WHERE `USERNAME` = '$name';";
$result = mysqli_query($con, $sql);
$obj = null;
// 检测用户是否存在
if (@$obj = mysqli_fetch_object($result)) {

    // 用户存在的情况
    $USERS_con = connect_SQL("USERS");

    // 检测是否已有好友信息
    $USERS_sql = "SELECT * FROM `CONT-$UserName` WHERE `CONTACTS` = '$name';";
    $USERS_result = mysqli_query($USERS_con, $USERS_sql);
    $USERS_obj = null;
    if (@$USERS_obj = mysqli_fetch_object($USERS_result)) {

        // 如果对方发起过好友申请
        if ($USERS_obj->STATUS == 2) {
            create_contact($UserName, $name);
            echo 0; // 申请成功，并直接建立好友联系
        } else {
            echo 1; // 不可重复申请，申请失败
        }
    } else {
        // 在双方用户数据表中插入申请信息
        $USERS_sql = "INSERT INTO `CONT-$UserName` VALUES ('$name', 1, NULL);";
        mysqli_query($USERS_con, $USERS_sql);
        $USERS_sql = "INSERT INTO `CONT-$name` VALUES ('$UserName', 2, NULL);";
        mysqli_query($USERS_con, $USERS_sql);
        mysqli_close($USERS_con);

        echo 0; // 申请成功
    }

    @mysqli_free_result($USERS_result);
    mysqli_close($USERS_con);
} else {

    // 用户不存在的情况
    echo 2; // 用户不存在
}

@mysqli_free_result($result);
mysqli_close($con);

?>