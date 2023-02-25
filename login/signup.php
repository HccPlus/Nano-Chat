<!DOCTYPE html>

<script src="/src/jquery-3.6.3.min.js"></script>

<?php

$LogInStatus = false;
$UserName = null;
$cookie = $_COOKIE["user"];

include "PHP/main.php";
if ($cookie) $UserName = check_cookie($cookie);
if ($UserName) $LogInStatus = true;

if ($UserName) {
    echo <<<JS
    <script>
    $(document).ready(function () {
        $("#smtip").css("color", "#404040");
        document.getElementById("smtip").innerHTML = "您已登录！";
        setTimeout('window.location.assign("/")', 1000);
    });
    </script>
    JS;
}

?>

<html lang="zh-cn">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="" />
    <title>注册</title>
    <script>
        let screen = "Phone";
        screen = window.innerWidth >= 1080 ? "FHD" : screen;
        screen = window.innerWidth >= 1440 ? "QHD" : screen;
        const head = document.getElementsByTagName('head')[0];
        const style = document.createElement('link');

        if (screen == "Phone") {
            window.location.assign('m-signup.php');
        } else if (screen == "FHD") {
            style.href = "CSS/FHD.css";
        } else if (screen == "QHD") {
            style.href = "CSS/QHD.css";
        }

        style.rel = "stylesheet";
        style.type = "text/css";
        head.appendChild(style);
    </script>
    <script src="js/md5.js" defer="off"></script>
    <script type="text/javascript" src="js/main.js" defer="off"></script>
</head>

<body>
    <div id="container">
        <h1>NanoChat</h1>
        <div id="block">
            <h2>注册</h2>
            <hr />
            <span>用户名</span>
            <input id="un" type="text" onkeydown="if (event.keyCode == 13) add_user();" minlength="4" maxlength="16" />
            <div id="untip"></div>
            <span>&#160密&#160&#160码&#160</span>
            <input id="pw" type="password" onkeydown="if (event.keyCode == 13) add_user();" minlength="6" maxlength="16" />
            <div id="pwtip"></div>
            <button id="submit" onclick="add_user();">注册</button>
            <div id="smtip"></div>
        </div>
    </div>

    <div style="display: inline-block; ">
        <div id="nav">
            <div class="nav_button">
                <img src="/src/index.svg" class="icon" alt="回到主页" onclick="window.location.assign('/index/index.php');" />
            </div>
            <div class="nav_button"></div>
            <div class="nav_button"></div>
            <div class="nav_button"></div>
        </div>
    </div>

</body>

</html>