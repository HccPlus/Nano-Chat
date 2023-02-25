
<?php

$ChatID = $_POST["chatID"];
$Title = $_POST["title"];
$Code = $_POST["code"];
$cookie = $_COOKIE["user"];

$number = null;

include "main.php";

// 获取用户名
$UserName = check_cookie($cookie);
if (!$UserName) die("您没有权限！");

// 群聊和私聊分类处理
if ($Code == 2 || $Code == 4) {

    // 查询用户是否加入群聊
    $con = connect_SQL("USERS");
    $sql = "SELECT `CHATID` FROM `GROUPS-$UserName` WHERE 1;";
    $result = mysqli_query($con, $sql);
    $finded = false;
    while (@$obj = mysqli_fetch_object($result)) {
        if ($obj->CHATID == $ChatID) {
            $finded = true;
            break;
        }
    }
    @mysqli_free_result($result);
    mysqli_close($con);
    if (!$finded) {
        die("您没有权限！");
    }

    // 查询群聊人数
    $con = connect_SQL("CHATS");
    $sql = "SELECT `NUM` FROM `$ChatID-information` LIMIT 1;";
    $result = mysqli_query($con, $sql);
    $obj = null;
    @$obj = mysqli_fetch_object($result);
    @mysqli_free_result($result);
    if ($obj) $number = '(' . $obj->NUM . ')';
    mysqli_close($con);
} else if ($Code == 1 || $Code == 3) {

    // 查询用户是否拥有该好友
    $con = connect_SQL("USERS");
    $sql = "SELECT `CHATID` FROM `CONT-$UserName` WHERE 1;";
    $result = mysqli_query($con, $sql);
    $finded = false;
    while (@$obj = mysqli_fetch_object($result)) {
        if ($obj->CHATID == $ChatID) {
            $finded = true;
            break;
        }
    }
    @mysqli_free_result($result);
    mysqli_close($con);
    if (!$finded) {
        die("您没有权限！");
    }
} else {
    die("请求错误！");
}

// 电脑端和手机端分类返回标题
if ($Code == 1 || $Code == 2) {
    echo <<<HTML
    <div id="chat_title">
        <h2>$Title$number</h2>
    </div>
    \n
    HTML;
} else {
    echo <<<HTML
    <div id="top">
        <button id="back" onclick="Back();">退出聊天</button>
        <h2>$Title$number</h2>
    </div>
    \n
    HTML;
}


// 将消息输出为HTML语言
function echo_row($UserName, $Sender, $Content)
{
    // 如果是系统消息
    if ($Sender == "_SYSTEM") {
        echo <<<HTML
        <div class="message_row_tip">
            <div class="message_tip">$Content</div>
        </div>
        HTML;
    }

    // 如果为自己发送的消息
    else if ($Sender == $UserName) {
        echo <<<HTML
        <div class="message_row_me">
            <div class="message_bar">
                <div class="message_box">
                    <div class="name_box">
                        <div class="name">$Sender</div>
                    </div>
                    <div class="message_me">$Content</div>
                </div>
                <image src="/src/myHeadPhoto.jpg" class="head_photo"></image>
            </div>
        </div>
        HTML;
    }

    // 其他人发送的消息
    else {
        echo <<<HTML
        <div class="message_row">
            <div class="message_bar">
                <image src="/src/Colarm.png" class="head_photo"></image>
                <div class="message_box">
                    <div class="name">$Sender</div>
                    <div class="message">$Content</div>
                </div>
            </div>
        </div>
        HTML;
    }
}

// 返回消息
$con = connect_SQL("CHATS");
$sql = "SELECT * FROM `$ChatID` WHERE 1;";
$result = mysqli_query($con, $sql);

echo '<div id="message_pad">';

// 循环获取消息并返回
$isBlank = true;
while (@$obj = mysqli_fetch_object($result)) {
    $isBlank = false;
    echo_row($UserName, $obj->SENDER, $obj->CONTENT);
}
if ($isBlank) echo_row($UserName, "_SYSTEM", "暂时没有消息");
@mysqli_free_result($result);
echo '</div>';

mysqli_close($con);

?>