
function open_chat(chatID) {
    // 请求服务器打开该聊天
}

function send() {

    // 若消息为空则退出
    newMessage = document.getElementById("input_main").value;
    if (!newMessage) {
        alert("不能发送空消息！");
        return;
    }
    document.getElementById("input_main").value = "";

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