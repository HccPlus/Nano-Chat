<!DOCTYPE html>

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

        // document.onclick = document.getElementById("loading").classList.remove("_loading");
        // setTimeout(() => {
        //     document.getElementById("latest").scrollIntoView();
        // }, 1600);
    </script>
    <script type="text/javascript" src="/index/js/main.js"></script>
</head>

<body>
    <div>
        <span id="ball_1" class="ball"></span>
        <span id="ball_2" class="ball"></span>
        <span id="ball_3" class="ball"></span>
        <span id="ball_4" class="ball"></span>
        <span id="ball_5" class="ball"></span>
        <span id="ball_6" class="ball"></span>
        <span id="ball_7" class="ball"></span>
        <span id="ball_8" class="ball"></span>
    </div>
    <div id="top">
        <h1>示例群聊(3)</h1>
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

    <div id="input_bar">
        <input type="text" id="input_main" onkeydown="enter();"></input>
        <button id="send" onclick="send();">发送</button>
    </div>

    <div style="display: inline-block; ">
        <div id="nav">
            <div class="nav_button"></div>
            <div class="nav_button"></div>
            <div class="nav_button"></div>
            <div class="nav_button"></div>
        </div>
    </div>

</body>

</html>