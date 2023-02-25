
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
    setcookie("user", $cookie, time() + 30 * 24 * 3600, "/");

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

// 获取聊天标题
function get_chat_title($ChatId)
{
    $con = connect_SQL("CHATS");
    $sql = "SELECT `TITLE` FROM `{$ChatId}-information` WHERE `NUM`;";
    $result = mysqli_query($con, $sql);
    $obj = null;
    @$obj = mysqli_fetch_object($result);
    @mysqli_free_result($result);
    mysqli_close($con);
    $title = $obj->TITLE;
    return $title;
}

// 获取聊天最后一句话时间和内容
function get_latest_message($ChatId)
{
    $con = connect_SQL("CHATS");
    $sql = "SELECT * FROM `{$ChatId}` ORDER BY `TIME` DESC LIMIT 1";
    $result = mysqli_query($con, $sql);
    $obj = null;
    @$obj = mysqli_fetch_object($result);
    @mysqli_free_result($result);
    mysqli_close($con);
    $time = strtotime("1970-1-1");
    if ($obj) {
        $time = $obj->TIME;
        $sender = $obj->SENDER;
        $content = $obj->CONTENT;
        $content = preg_replace('/<br\s*\/>/', ' ', $content);
        if ($sender) return [$time, $sender, $content];
    }
    return [0, "系统提示", "暂时没有消息"];
}

// 搜索数据库并返回消息列表
function echo_chat_list($UserName, $Code)
{

    // 获取私聊ID
    $con = connect_SQL("USERS");
    $sql = "SELECT * FROM `CONT-{$UserName}` WHERE 1;";
    $result = mysqli_query($con, $sql);
    $obj = null;
    $PrivateChatIds = [];
    while (true) {
        @$obj = mysqli_fetch_object($result);
        if (!$obj) {
            echo mysqli_error($con);
            break;
        }
        if ($obj->STATUS == 1) continue; // 如果是未同意的好友申请则忽略，扫描下一个
        array_push($PrivateChatIds, [$obj->CHATID, $obj->CONTACTS]);
        $obj = null;
    }
    @mysqli_free_result($result);

    // 获取群聊ID
    $sql = "SELECT * FROM `GROUPS-{$UserName}` WHERE 1";
    $result = mysqli_query($con, $sql);
    $obj = null;
    $GroupChatIds = [];
    while (true) {
        @$obj = mysqli_fetch_object($result);
        if (!$obj) {
            echo mysqli_error($con);
            break;
        }
        if ($obj->STATUS == 1) continue; // 如果是未同意的进群邀请则忽略，扫描下一个
        array_push($GroupChatIds, $obj->CHATID);
        $obj = null;
    }
    @mysqli_free_result($result);
    mysqli_close($con);

    // 获取两种聊天ID对应的聊天信息并按时间降序
    $ChatList = [];
    foreach ($PrivateChatIds as $id) {
        $title = $id[1];
        $message = get_latest_message($id[0]);
        array_push($ChatList, [$id[0], $title, $message[0], $message[1], $message[2], $Code == 0 ? 1 : 3]); // [5]为1表示该聊天为私聊 (手机版为3)
    }
    foreach ($GroupChatIds as $id) {
        $title = get_chat_title($id);
        $message = get_latest_message($id);
        array_push($ChatList, [$id, $title, $message[0], $message[1], $message[2], $Code == 0 ? 2 : 4]); // [5]为2表示该聊天为群聊 (手机版为4)
    }
    $time = array_column($ChatList, 2);
    array_multisort($time, SORT_DESC, $ChatList);

    print_chat_list($ChatList);
}

// 输出聊天信息
function print_chat_list($ChatList)
{
    foreach ($ChatList as $row) {
        echo <<<HTML
        <div class="chat" onclick="open_chat('$row[0]', '$row[1]', $row[5]);">
            <img src="/src/Colarm.png" class="chat_head_photo" />
            <div class="chat_abstract">
                <div class="chat_name">$row[1]</div>
                <div class="last_message">$row[3]: $row[4]</div>
            </div>
        </div>
        HTML;
    }
}

?>