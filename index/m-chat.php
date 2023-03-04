<!DOCTYPE html>

<script src="/src/jquery-3.6.3.min.js"></script>

<?php

$LogInStatus = false;
$UserName = null;
$cookie = $_COOKIE["user"];
$ChatID = $_GET["chatID"];
$Title = $_GET["title"];
$Code = $_GET["code"];

include "PHP/main.php";
$ReadAge = add_read_age();
if ($cookie) $UserName = check_cookie($cookie);
if ($UserName) $LogInStatus = true;
set_cookie($UserName, $ReadAge);

?>

<html lang="zh-cn">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="" />
    <title>NanoChat</title>
    <script>
        let screen = "Phone";
        screen = window.innerWidth >= 1080 ? "FHD" : screen;
        screen = window.innerWidth >= 1440 ? "QHD" : screen;
        const head = document.getElementsByTagName('head')[0];
        const style = document.createElement('link');

        if (screen == "Phone") {
            style.href = "/index/CSS/Phone.css";
        } else if (screen == "FHD") {
            window.location.assign('/index/index.php');
        } else if (screen == "QHD") {
            window.location.assign('/index/index.php');
        }

        style.rel = "stylesheet";
        style.type = "text/css";
        head.appendChild(style);


        // 获取ChatID, title和Code
        let chatID = "<?php echo $ChatID; ?>";
        let title = "<?php echo $Title; ?>";
        let code = <?php echo $Code; ?>;
        // 发送请求并在消息面板显示返回的HTML
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "/index/PHP/Message.php", true);
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                $("#message_board").html(xhttp.responseText);
                $(document).scrollTop($(document).height() - $(window).height());
                currentChatID = chatID;
            }
        }
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let value = "chatID=" + chatID + "&title=" + title + "&code=" + code;
        xhttp.send(value);

        interval = setInterval(function() {

            // 发送请求并在消息面板显示返回的HTML
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "/index/PHP/Message.php", true);
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    let scroll = false;
                    if ($(document).scrollTop() + 1 >= $(document).height() - $(window).height()) scroll = true;
                    $("#message_board").html(xhttp.responseText);
                    $(document).scrollTop($(document).height() - $(window).height());
                } else if (xhttp.readyState == 4) {
                    $("#message_board").html("网络错误");
                }
            }
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            let value = "chatID=" + chatID + "&title=" + title + "&code=" + code;
            xhttp.send(value);

        }, 4000);
    </script>
    <script type="text/javascript" src="/index/js/main.js"></script>

</head>

<body>
    <div id="message_board"></div>

    <div id="input_bar">
        <input type="text" id="input_main" onkeydown="enter('<?php echo $UserName; ?>');$(document).scrollTop($(document).height() - $(window).height());"></input>
        <button id="send" onclick="send('<?php echo $UserName; ?>');$(document).scrollTop($(document).height() - $(window).height());">发送</button>
    </div>

</body>

</html>