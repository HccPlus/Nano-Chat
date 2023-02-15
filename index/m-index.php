<!DOCTYPE html>

<html lang="zh-cn">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="" />
    <title>NanoChat</title>
    <script>
        let screen = "Phone";
        screen = window.innerWidth >= 1080 ? "Desktop" : screen;
        const head = document.getElementsByTagName('head')[0];
        const style = document.createElement('link');

        if (screen == "Phone") {
            style.href = "/index/CSS/Phone.css";
        } else if (screen == "Desktop") {
            window.location.assign('/index/index.php');
        }

        style.rel = "stylesheet";
        style.type = "text/css";
        head.appendChild(style);
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
        <h1>NanoChat</h1>
    </div>

    <div id="chat_list">
        <div class="chat" onclick="open_chat('65536');">
            <image src="/src/Colarm.png" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">冷暖交响</div>
                <div class="last_message">冷暖交响: 确实啊确实主要是刘云凡真的没有__但是刘云凡还是不如王子帆赞</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65537');">
            <image src="/src/myHeadPhoto.jpg" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">示例群聊</div>
                <div class="last_message">Voyage: 值了</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65536');">
            <image src="/src/Colarm.png" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">冷暖交响</div>
                <div class="last_message">冷暖交响: 确实</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65537');">
            <image src="/src/myHeadPhoto.jpg" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">示例群聊</div>
                <div class="last_message">Voyage: 值了</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65536');">
            <image src="/src/Colarm.png" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">冷暖交响</div>
                <div class="last_message">冷暖交响: 确实</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65537');">
            <image src="/src/myHeadPhoto.jpg" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">示例群聊</div>
                <div class="last_message">Voyage: 值了</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65536');">
            <image src="/src/Colarm.png" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">冷暖交响</div>
                <div class="last_message">冷暖交响: 确实</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65537');">
            <image src="/src/myHeadPhoto.jpg" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">示例群聊</div>
                <div class="last_message">Voyage: 值了</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65536');">
            <image src="/src/Colarm.png" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">冷暖交响</div>
                <div class="last_message">冷暖交响: 确实</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65537');">
            <image src="/src/myHeadPhoto.jpg" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">示例群聊</div>
                <div class="last_message">Voyage: 值了</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65536');">
            <image src="/src/Colarm.png" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">冷暖交响</div>
                <div class="last_message">冷暖交响: 确实</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65537');">
            <image src="/src/myHeadPhoto.jpg" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">示例群聊</div>
                <div class="last_message">Voyage: 值了</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65536');">
            <image src="/src/Colarm.png" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">冷暖交响</div>
                <div class="last_message">冷暖交响: 确实</div>
            </div>
        </div>
        <div class="chat" onclick="open_chat('65537');">
            <image src="/src/myHeadPhoto.jpg" class="chat_head_photo"></image>
            <div class="chat_abstract">
                <div class="chat_name">示例群聊</div>
                <div class="last_message">Voyage: 值了</div>
            </div>
        </div>
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