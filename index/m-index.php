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
            style.href = "/index/CSS/Phone.css";
        } else if (screen == "FHD") {
            window.location.assign('/index/index.php');
        } else if (screen == "QHD") {
            window.location.assign('/index/index.php');
        }

        style.rel = "stylesheet";
        style.type = "text/css";
        head.appendChild(style);
    </script>
    <script type="text/javascript" src="/index/js/main.js"></script>

</head>

<body>

    <div id="top">

        <?php
        // 登录或未登录时显示的内容
        if ($LogInStatus) {
            echo <<<HTML
            <img id="account_head_photo" src="/src/myHeadPhoto.jpg" alt="{$UserName}" />
            <h1>NanoChat</h1>
            <button id="logout" onclick="Logout();">退出登录</button>
            HTML;
        } else {
            echo <<<HTML
            <h1>NanoChat</h1>
            HTML;
        }
        ?>

    </div>

    <div id="chat_list">
        <?php
        if ($LogInStatus) echo_chat_list($UserName, 1);
        else {
            echo <<<HTML
            <button id="login" onclick="Login();">登录</button>
            <button id="signup" onclick="Signup();">注册</button>
            HTML;
        }
        ?>
    </div>

    <div id="nav">
        <div class="nav_button" onclick="Contacts();"></div>
        <div class="nav_button"></div>
        <div class="nav_button"></div>
        <div class="nav_button"></div>
    </div>

</body>

</html>