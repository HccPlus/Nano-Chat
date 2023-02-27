
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

// 返回好友列表的HTML文本
function echo_contact_list($UserName)
{

    // 连接数据库获取好友结果集
    $con = connect_SQL("USERS");
    $sql = "SELECT * FROM `CONT-$UserName` WHERE 1 ORDER BY `STATUS` DESC;";
    $result = mysqli_query($con, $sql);

    echo '<div id="contact_list">';

    // 循环获取好友信息
    $isBlank = true;
    while (@$obj = mysqli_fetch_object($result)) {

        $isBlank = false;

        // 如果是自己向对方发出的好友申请
        if ($obj->STATUS == 1) {
            echo <<<HTML
            <div class="contact_box">
                <div class="contact_1"> \
                    <img class="contact_head_photo" src="/src/Colarm.png" alt="头像" \> \
                    <div class="name">$obj->CONTACTS</div> \
                </div> \
                <div class="cttip">对方还未通过你的好友申请</div> \
            </div>
            HTML;
        }

        // 如果是对方向自己发出的好友申请
        else if ($obj->STATUS == 2) {
            echo <<<HTML
            <div class="contact_box">
                <div class="contact_2"> \
                    <img class="contact_head_photo" src="/src/Colarm.png" alt="头像" \> \
                    <div class="name">$obj->CONTACTS</div> \
                </div> \
                <div class="cttip">对方已申请添加你为好友</div> \
            </div>
            HTML;
        }

        // 输出一条好友信息
        else if ($obj->STATUS == 0) {
            echo <<<HTML
            <div class="contact_box">
                <div class="contact"> \
                    <img class="contact_head_photo" src="/src/Colarm.png" alt="头像" \> \
                    <div class="name">$obj->CONTACTS</div> \
                </div> \
            </div>
            HTML;
        }
    }

    @mysqli_free_result($result);
    mysqli_close($con);

    // 如果好友列表为空
    if ($isBlank) {
        echo <<<HTML
        <div class="contact">目前没有好友</div>
        HTML;
    }

    echo '</div>';
}

// 建立好友连接的函数
function create_contact($User1, $User2)
{

    // 获取CHATID
    $con = connect_SQL("MAIN");
    $sql = "SELECT * FROM `MAXCHATID` WHERE 1;";
    $result = mysqli_query($con, $sql);
    @$obj = mysqli_fetch_object($result);
    @mysqli_free_result($result);
    $ChatID = null;
    if ($obj) $ChatID = $obj->MAXCHATID;

    // CHATID+1并写回数据库
    $ChatID = strval(intval($ChatID) + 1);
    $sql = "UPDATE `MAXCHATID` SET `MAXCHATID` = {$ChatID} WHERE 1;";
    mysqli_query($con, $sql);
    mysqli_close($con);

    // 建立CHAT表
    $con = connect_SQL("CHATS");
    $sql = "CREATE TABLE `$ChatID` (`SENDER` VARCHAR(16), `TYPE` TINYINT, `CONTENT` VARCHAR(8192), `TIME` TIMESTAMP);";
    mysqli_query($con, $sql);
    mysqli_close($con);

    // 好友表建立连接
    $con = connect_SQL("USERS");
    $sql = "UPDATE `CONT-$User1` SET `STATUS` = 0, `CHATID` = '$ChatID' WHERE `CONTACTS` = '$User2';";
    mysqli_query($con, $sql);
    $sql = "UPDATE `CONT-$User2` SET `STATUS` = 0, `CHATID` = '$ChatID' WHERE `CONTACTS` = '$User1';";
    mysqli_query($con, $sql);
    mysqli_close($con);
}

?>