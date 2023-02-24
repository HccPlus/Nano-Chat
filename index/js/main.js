
function open_chat(chatID, code) {
    // 请求服务器打开该聊天
    if (code == 2) window.location.assign('/index/m-chat.html');
}

function enter() {
    let keyCode = event.keyCode || event.which || event.charCode;
    let ctrlKey = event.ctrlKey || event.metaKey;
    if (keyCode == 13) {
        if (ctrlKey) {
            document.getElementById("input_main").value += '\n';
            return;
        }
        event.preventDefault();
        send();
    }
}

function send() {

    // 获取消息并将换行符转换为<br />
    let newMessage = document.getElementById("input_main").value;
    document.getElementById("input_main").value = "";
    newMessage = newMessage.replace(/ /gm, "&#160&#160");
    newMessage = newMessage.replace(/\n/gm, "<br />");

    // 若消息为空则退出
    if (!newMessage) {
        alert("不能发送空消息！");
        return;
    }

    // 新建row并插入HTML
    document.getElementById("latest").id = "";
    const row = document.createElement("div");
    row.id = "latest";
    row.style = "display:grid;justify-content:right;text-align:right;width:100%;";
    document.getElementById("message_pad").appendChild(row);

    // 给新row添加元素
    userName = "Voyage";
    let content = '<div class="message_bar"><div class="message_box"><div class="name_box"><div class="name">' + userName + '</div></div><div class="message_me">' + newMessage + '</div></div><image src="/src/myHeadPhoto.jpg" class="head_photo"></image></div>'
    document.getElementById("latest").innerHTML = content;

    // 页面滑动至最新消息
    document.getElementById("latest").scrollIntoView();

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
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}