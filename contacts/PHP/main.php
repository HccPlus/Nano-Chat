
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

?>