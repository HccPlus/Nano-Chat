<!DOCTYPE html>

<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>

<?php

$LogInStatus = false;
$UserName = null;
$cookie = $_COOKIE["user"];

include "PHP/main.php";
$ReadAge = add_read_age();
$UserName = check_cookie($cookie);
if ($UserName) $LogInStatus = true;
set_cookie($UserName, $ReadAge);

if ($UserName) {
    echo "已登录";
} else {
    echo "未登录";
}

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
        setTimeout(() => {
            document.getElementById("latest").scrollIntoView();
        }, 1600);
    </script>

    <script src="js/main.js"></script>
</head>

<body>
    <div>
        <button onclick="Logout();">退出登录</button>
    </div>

    <div id="container">
        <h1>NanoChat</h1>
        <div id="content">
            <div id="chat_list">
                <div class="chat" onclick="open_chat('65536', 1);">
                    <image src="/src/Colarm.png" class="chat_head_photo"></image>
                    <div class="chat_abstract">
                        <div class="chat_name">冷暖交响</div>
                        <div class="last_message">冷暖交响: 确实</div>
                    </div>
                </div>
                <div class="chat" onclick="open_chat('65537', 1);">
                    <image src="/src/myHeadPhoto.jpg" class="chat_head_photo"></image>
                    <div class="chat_abstract">
                        <div class="chat_name">示例群聊</div>
                        <div class="last_message">Voyage: 值了</div>
                    </div>
                </div>
            </div>

            <div id="chat_board">

                <div id="message_board">

                    <div id="chat_title">
                        <h2>示例群聊(3)</h2>
                    </div>

                    <div id="message_pad">

                        <div class="message_row_tip">
                            <div class="message_tip">12:53</div>
                        </div>

                        <div class="message_row">
                            <div class="message_bar">
                                <div class="head_photo"></div>
                                <div class="message_box">
                                    <div class="name">Loc</div>
                                    <div class="message">示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字示例文字</div>
                                </div>
                            </div>
                        </div>

                        <div class="message_row_me">
                            <div class="message_bar">
                                <div class="message_box">
                                    <div class="name_box">
                                        <div class="name">Voyage</div>
                                    </div>
                                    <div class="message_me">我说停停</div>
                                </div>
                                <image src="/src/myHeadPhoto.jpg" class="head_photo"></image>
                            </div>
                        </div>

                        <div class="message_row">
                            <div class="message_bar">
                                <div class="head_photo"></div>
                                <div class="message_box">
                                    <div class="name">Loc</div>
                                    <div class="message">绷不住了</div>
                                </div>
                            </div>
                        </div>

                        <div class="message_row">
                            <div class="message_bar">
                                <div class="head_photo"></div>
                                <div class="message_box">
                                    <div class="name">Loc</div>
                                    <div class="message">确实</div>
                                </div>
                            </div>
                        </div>

                        <div class="message_row_me">
                            <div class="message_bar">
                                <div class="message_box">
                                    <div class="name_box">
                                        <div class="name">Voyage</div>
                                    </div>
                                    <div class="message_me">
                                        但是如果袋鼠入侵乌拉圭每个乌拉圭人就要对战14只袋鼠，但你不关心乌拉圭人因为如果乌拉圭人入侵梵蒂冈每个梵蒂冈人都要向联合国提出抗议但是如果火星人入侵澳大利亚每个澳大利亚人的生活都不会有什么改变因为火星上面没有人
                                    </div>
                                </div>
                                <image src="/src/myHeadPhoto.jpg" class="head_photo"></image>
                            </div>
                        </div>

                        <div class="message_row">
                            <div class="message_bar">
                                <div class="head_photo"></div>
                                <div class="message_box">
                                    <div class="name">Loc</div>
                                    <div class="message">难绷</div>
                                </div>
                            </div>
                        </div>

                        <div class="message_row">
                            <div class="message_bar">
                                <div class="head_photo"></div>
                                <div class="message_box">
                                    <div class="name">Loc</div>
                                    <div class="message">你是故意的还是不小心</div>
                                </div>
                            </div>
                        </div>

                        <div class="message_row_me">
                            <div class="message_bar">
                                <div class="message_box">
                                    <div class="name_box">
                                        <div class="name">Voyage</div>
                                    </div>
                                    <div class="message_me">我是故意不小心的</div>
                                </div>
                                <image src="/src/myHeadPhoto.jpg" class="head_photo"></image>
                            </div>
                        </div>

                        <div class="message_row">
                            <div class="message_bar">
                                <div class="head_photo"></div>
                                <div class="message_box">
                                    <div class="name">Loc</div>
                                    <div class="message">一计害三贤是吧</div>
                                </div>
                            </div>
                        </div>

                        <div class="message_row_tip">
                            <div class="message_tip">14:32</div>
                        </div>

                        <div id="latest" class="message_row_me">
                            <div class="message_bar">
                                <div class="message_box">
                                    <div class="name_box">
                                        <div class="name">Voyage</div>
                                    </div>
                                    <div class="message_me">值了</div>
                                </div>
                                <image src="/src/myHeadPhoto.jpg" class="head_photo"></image>
                            </div>
                        </div>

                    </div>

                </div>

                <div id="input_bar">
                    <textarea type="text" id="input_main" onkeydown="enter();"></textarea>
                    <button id="send" onclick="send();">发送</button>
                </div>

            </div>
        </div>
    </div>

    <div style="display: inline-block; ">
        <div id="nav">
            <div class="nav_button">
                <img src="/src/Login.svg" class="icon" alt="登录" onclick="Login();" />
            </div>
            <div class="nav_button"></div>
            <div class="nav_button"></div>
            <div class="nav_button"></div>
        </div>
    </div>

</body>

</html>