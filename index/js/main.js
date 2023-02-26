
var num = 0; // 记录发送消息的条数
var currentChatID = null; // 记录当前所在的聊天ID
var interval; // 定时任务

// 请求服务器打开该聊天
function open_chat(chatID, title, code) {

    // 若为移动端则跳转页面
    if (code == 3 || code == 4) window.location.assign('/index/m-chat.php?chatID=' + chatID + '&title=' + title + '&code=' + code);

    // 取消之前的定时任务
    clearInterval(interval);

    // 发送请求并在消息面板显示返回的HTML
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/index/PHP/Message.php", true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("message_board").innerHTML = xhttp.responseText;
            $("#message_pad").scrollTop($("#message_pad").prop("scrollHeight"));
            currentChatID = chatID;
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let value = "chatID=" + chatID + "&title=" + title + "&code=" + code;
    xhttp.send(value);

    interval = setInterval(function () {

        // 发送请求并在消息面板显示返回的HTML
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "/index/PHP/Message.php", true);
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                // document.getElementById("message_board").innerHTML = xhttp.responseText;
                let currentScroll = $("#message_pad").scrollTop();
                let scroll = false;
                if (currentScroll + $("#message_pad").innerHeight() + 1 >= $("#message_pad").prop('scrollHeight')) scroll = true;
                $("#message_board").html(xhttp.responseText);
                $("#message_pad").css("scroll-behavior", "auto");
                $("#message_pad").scrollTop(currentScroll);
                $("#message_pad").css("scroll-behavior", "smooth");
                if (scroll) $("#message_pad").scrollTop($("#message_pad").prop("scrollHeight"));
            } else if (xhttp.readyState == 4) {
                $("#message_board").html("网络错误");
            }
        }
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let value = "chatID=" + chatID + "&title=" + title + "&code=" + code;
        xhttp.send(value);

    }, 4000);


}

function enter(userName) {
    let keyCode = event.keyCode || event.which || event.charCode;
    let ctrlKey = event.ctrlKey || event.metaKey;
    if (keyCode == 13) {
        if (ctrlKey) {
            document.getElementById("input_main").value += '\n';
            return;
        }
        event.preventDefault();
        send(userName);
    }
}

function send(userName) {

    let thisNum = num++; // 这条消息的序号

    // 获取消息并将换行符转换为<br />
    let newMessage = document.getElementById("input_main").value;
    document.getElementById("input_main").value = "";
    newMessage = newMessage.replace(/ /gm, "&#160&#160");
    newMessage = newMessage.replace(/\n/gm, "<br />");

    // 若消息为空则退出
    if (!newMessage) {
        alert("不能发送空消息！");
        return 1;
    }

    // 新建row并插入HTML
    const row = document.createElement("div");
    row.id = "latest";
    row.style = "display:grid;justify-content:right;text-align:right;width:100%;";
    document.getElementById("message_pad").appendChild(row);

    // 给新row添加元素
    let content = '<div class="message_bar"><div id="send_message_' + thisNum + '" class="sending">发送中</div><div class="message_box"><div class="name_box"><div class="name">' + userName + '</div></div><div class="message_me">' + newMessage + '</div></div><image src="/src/myHeadPhoto.jpg" class="head_photo"></image></div>'
    document.getElementById("latest").innerHTML = content;
    document.getElementById("latest").id = "";

    // 页面滑动至最新消息
    $("#message_pad").scrollTop($("#message_pad").prop("scrollHeight"));

    // 发送POST请求
    newMessage = newMessage.replace(/&/gm, "%26");
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/index/PHP/Send.php", true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            let sendStatus = parseInt(xhttp.responseText);
            if (sendStatus == 0) {
                document.getElementById("send_message_" + thisNum).innerHTML = "发送成功";
                $("#send_message_" + thisNum).delay(1000).hide(0);
            } else {
                document.getElementById("send_message_" + thisNum).innerHTML = "发送失败";
                console.log(xhttp.responseText);
            }
        } else if (xhttp.readyState == 4) {
            alert("网络错误");
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    value = "chatID=" + currentChatID + "&content=" + newMessage;
    xhttp.send(value);
}

function Login() {
    window.location.assign("/login/login.php");
}

function Signup() {
    window.location.assign("/login/signup.php");
}

function Logout() {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/index/PHP/Logout.php", true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            let logoutStatus = parseInt(xhttp.responseText);
            if (logoutStatus == 0) {
                alert("已退出登录");
                setTimeout('window.location.assign("/")', 1000);
            } else {
                alert(xhttp.responseText);
            }
        } else if (xhttp.readyState == 4) {
            alert("网络错误");
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

function Back() {
    window.location.assign("/index/m-index.php");
}

function Contacts() {
    window.location.assign("/contacts/index.php");
}