
<?php

// 连接数据库的函数
function connect_SQL($Name)
{
    $SQL_un = "root";
    $SQL_pw = "123456"; // 此处涉及数据库密码不在公开仓库展示
    $con = mysqli_connect("localhost", $SQL_un, $SQL_pw);
    mysqli_select_db($con, $Name);
    return $con;
}

// 将数据库中阅读量+1并返回的函数
function add_read_age()
{

    // 获取阅读量数据
    $con = connect_SQL("MAIN");
    $sql = "SELECT * FROM `READAGE` WHERE 1;";
    $result = mysqli_query($con, $sql);
    @$obj = mysqli_fetch_object($result);
    @mysqli_free_result($result);
    $ReadAge = 0;
    if ($obj) $ReadAge = $obj->READAGE;

    // 阅读量+1并写回数据库
    $ReadAge++;
    $sql = "UPDATE `READAGE` SET `READAGE` = {$ReadAge} WHERE 1;";
    mysqli_query($con, $sql);
    mysqli_close($con);

    // 返回阅读量数据
    return $ReadAge;
}

// 检查数据库中是否包含该cookie，若包含则将对应的UserName返回
function check_cookie($cookie)
{

    // 在数据库中查询包含$cookie的行
    $con = connect_SQL("MAIN");
    $sql = "SELECT * FROM `LOGINDATA` WHERE `COOKIE` = '{$cookie}';";
    $result = mysqli_query($con, $sql);
    $obj = null;
    @$obj = mysqli_fetch_object($result);
    @mysqli_free_result($result);
    mysqli_close($con);

    // 若有结果则将UserName返回，否则返回null
    $UserName = null;
    if ($obj) $UserName = $obj->USERNAME;
    return $UserName;
}

// 设置cookie，若UserName不为空则将新cookie写入数据库
function set_cookie($UserName, $ReadAge)
{

    // 设置cookie
    $seed = uniqid($ReadAge, true);
    $cookie = md5($seed);
    setcookie("user", $cookie, time() + 30 * 24 * 3600);
    echo "new cookie: " . $cookie . "<br />";

    // 若UserName不为空则将新cookie写入数据库
    if ($UserName != null) {
        $con = connect_SQL("MAIN");
        $sql = "UPDATE `LOGINDATA` SET `COOKIE` = '{$cookie}' WHERE `USERNAME` = '{$UserName}';";
        mysqli_query($con, $sql);
        $sql = "UPDATE `LOGINDATA` SET `TIME`= NOW() WHERE `USERNAME` = '{$UserName}';";
        mysqli_query($con, $sql);
        mysqli_close($con);
    }

    return null;
}

?>