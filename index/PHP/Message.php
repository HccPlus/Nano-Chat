
<?php

$ChatID = $_POST["chatID"];
$Title = $_POST["title"];
$Code = $_POST["code"];

$number = null;

include "main.php";
if ($Code == 2) {
    $con = connect_SQL("CHATS");
    $sql = "SELECT `NUM` FROM `$ChatID-information` LIMIT 1;";
    $result = mysqli_query($con, $sql);
    $obj = null;
    @$obj = mysqli_fetch_object($result);
    @mysqli_free_result($result);
    if ($obj) $number = '(' . $obj->NUM . ')';
    mysqli_close($con);
}

// 返回标题
echo <<<HTML
<div id="chat_title">
    <h2>$Title$number</h2>
</div>
HTML;

// 循环返回消息
$con = connect_SQL("CHATS");
$sql = "SELECT * FROM `$ChatID` WHERE 1;";
$result = mysqli_query($con, $sql);
$obj = null;
@$obj = mysqli_fetch_object($result);
@mysqli_free_result($result);

echo <<<HTML
<div id="message_pad">
    <div class="message_row">
        <div class="message_bar">
            <image src="/src/myHeadPhoto.jpg" class="head_photo"></image>
            <div class="message_box">
                <div class="name">Loc</div>
                <div class="message">示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字</div>
            </div>
        </div>
    </div>
</div>
HTML;

?>