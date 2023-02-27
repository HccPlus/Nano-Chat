<!DOCTYPE html>

<script src="/src/jquery-3.6.3.min.js"></script>

<script>
    alert("抱歉，暂不支持手机查看联系人");
    window.location.assign("/");
</script>

<?php

die();

$LogInStatus = false;
$UserName = null;
$cookie = $_COOKIE["user"];

include "PHP/main.php";
if ($cookie) $UserName = check_cookie($cookie);
if ($UserName) $LogInStatus = true;


// 用户搜索
$SearchUN = null;
$SearchUN = $_GET["un"];

echo <<<JAVASCRIPT
<script>
    $(document).ready(function () {
        if ($("#sc").val()) search();
    });
</script>
JAVASCRIPT;

?>

<html lang="zh-cn">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="" />
    <title>联系人</title>
    <script>
        let screen = "Phone";
        screen = window.innerWidth >= 1080 ? "FHD" : screen;
        screen = window.innerWidth >= 1440 ? "QHD" : screen;
        const head = document.getElementsByTagName('head')[0];
        const style = document.createElement('link');

        if (screen == "Phone") {
            style.href = "CSS/Phone.css";
        } else if (screen == "FHD") {
            window.location.assign('index.php');
        } else if (screen == "QHD") {
            window.location.assign('index.php');
        }

        style.rel = "stylesheet";
        style.type = "text/css";
        head.appendChild(style);


        // 添加好友
        let newContact = '<div id="new"><div><span>添加好友</span><input id="sc" type="text" onkeydown="if (event.keyCode == 13) search();" minlength="4" maxlength="16" /><div id="sctip"></div></div><button id="submit" onclick="search();">搜索</button></div>'

        // 好友列表
        let contactList = `<?php echo_contact_list($UserName); ?>`;

        // 显示添加好友模块的函数
        function show_new_contact() {
            $("#contact_list").remove();
            $("#new_contact").hide();
            $("#view_contact").show();
            $("#block").append(newContact);
        }

        // 显示好友列表的函数
        function show_contact_list() {
            $("#new").remove();
            $("#ret").remove();
            $("#add").remove();
            $("#rttip").remove();
            $("#view_contact").hide();
            $("#new_contact").show();
            $("#block").append(contactList);
        }

        // 文档加载完毕后执行
        $(document).ready(function() {

            // 默认显示好友列表
            show_contact_list();

            // 若有GET变量则显示添加好友
            if (<?php echo $SearchUN != null ? "true" : "false"; ?>) {
                show_new_contact();
                $("#sc").val("<?php echo $SearchUN; ?>");
                search();
            }

            // 好友列表处理
            $(".contact_1").click(function() {
                $(this).children(".operation").remove();
                $(this).children(".contact_head_photo").remove();
                $(this).prepend('<div class="operation"><button class="operation_button" onclick="cancel();">取消</button></div>');
                $(this).css("background-color", "#97dbf1");
            });

            $(".contact_2").click(function() {
                $(this).children(".operation").remove();
                $(this).children(".contact_head_photo").remove();
                $(this).prepend('<div class="operation"><button class="operation_button" onclick="accept(this);">通过</button><button class="operation_button" onclick="deny(this);">拒绝</button></div>');
                $(this).css("background-color", "#97dbf1");
            });

        });
    </script>
    <script src="js/main.js" defer="off"></script>
</head>

<body>
    <div id="top">
        <h1>NanoChat</h1>
    </div>
    <div id="block">
        <button id="new_contact" onclick='show_new_contact();'>添加好友</button>
        <button id="view_contact" onclick='show_contact_list();'>查看好友列表</button>
        <h2>联系人</h2>
        <hr />
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