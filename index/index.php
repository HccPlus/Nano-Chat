<!DOCTYPE html>

<script src="/src/jquery-3.6.3.min.js"></script>

<?php

$LogInStatus = false;
$UserName = null;
$cookie = $_COOKIE["user"];

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
            window.location.assign('/index/m-index.php');
        } else if (screen == "FHD") {
            style.href = "/index/CSS/FHD.css";
        } else if (screen == "QHD") {
            style.href = "/index/CSS/QHD.css";
        }

        style.rel = "stylesheet";
        style.type = "text/css";
        head.appendChild(style);

        // document.onclick = document.getElementById("loading").classList.remove("_loading");
    </script>

    <script src="js/main.js"></script>
</head>

<body>
    <div id="container">
        <?php
        // 登录或未登录时显示的内容
        if ($LogInStatus) {
            echo <<<HTML
            <div id="head_board">
                <img id="account_head_photo" src="/src/myHeadPhoto.jpg" alt="{$UserName}" />
                <div id="user_name">{$UserName}</div>
                <button id="logout" onclick="Logout();">退出登录</button>
            </div>
            HTML;
        } else {
            echo <<<HTML
            <div id="head_board">
                <div id="account_head_photo"></div>
                <div id="login" onclick="Login();">登录</div>
                <div id="signup" onclick="Signup();">注册</div>
            </div>
            HTML;
        }
        ?>
        <h1>NanoChat</h1>
        <div id="content">

            <!--  消息列表  -->
            <div id="chat_list">
                <?php
                if ($LogInStatus) echo_chat_list($UserName, 0);
                ?>
            </div>

            <div id="chat_board">

                <!--  聊天面板  -->
                <div id="message_board"></div>

                <div id="input_bar">
                    <textarea type="text" id="input_main" onkeydown="enter('<?php echo $UserName; ?>');"></textarea>
                    <button id="send" onclick="send('<?php echo $UserName; ?>');">发送</button>
                </div>

            </div>
        </div>
    </div>

    <div style="display: inline-block; ">
        <div id="nav">
            <div class="nav_button">
                <img src="/src/Login.svg" class="icon" alt="登录" onclick="Login();" />
            </div>
            <div class="nav_button">
                <img src="/src/Login.svg" class="icon" alt="联系人" onclick="Contacts();" />
            </div>
            <div class="nav_button"></div>
            <div class="nav_button"></div>
        </div>
    </div>

</body>

</html>