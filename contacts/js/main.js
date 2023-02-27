
var gotName = null;

function check(userName) {
    let ret = true;
    if (userName.search(/^[0-9a-z\u4e00-\u9fa5]{4,16}$/i) != 0) {
        $("#sctip").css("color", "#e00000");
        $("#sctip").html("用户名格式不正确！");
        ret = false;
    }
    return ret;
}

function search() {
    
    $("#sctip").css("color", "#404040");
    $("#sctip").html("正在搜索...");
    let name = $("#sc").val();
    if (!check(name)) {
        return 1;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "PHP/Search.php", true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            let searchStatus = parseInt(xhttp.responseText);
            if (searchStatus == 0) {
                $("#sctip").css("color", "#404040");
                $("#sctip").html("为您找到下方用户");
                $("#ret").remove();
                $("#add").remove();
                $("#rttip").remove();
                $("#block").append('<div id="ret"><img class="head_photo" src="/src/Colarm.png" alt="头像" /><div class="name">' + name + '</div></div><button id="add" onclick="apply();">申请添加</button><div id="rttip"></div>');
                gotName = name;
            } else if (searchStatus == 1) {
                $("#sctip").css("color", "#e00000");
                $("#sctip").html("已经是好友了！");
            } else if (searchStatus == 2) {
                $("#sctip").css("color", "#e00000");
                $("#sctip").html("已经申请过了！");
            } else if (searchStatus == 3) {
                $("#sctip").css("color", "#404040");
                $("#sctip").html("为您找到下方用户，该用户已经申请添加你为好友");
                $("#ret").remove();
                $("#add").remove();
                $("#rttip").remove();
                $("#block").append('<div id="ret"><img class="head_photo" src="/src/Colarm.png" alt="头像" /><div class="name">' + name + '</div></div><button id="add" onclick="gotName=`' + name + '`;apply();">申请添加</button><div id="rttip"></div>');
                gotName = name;
            } else if (searchStatus == 4) {
                $("#sctip").css("color", "#e00000");
                $("#sctip").html("用户不存在！");
            } else if (searchStatus == 5) {
                $("#sctip").css("color", "#e00000");
                $("#sctip").html("不能添加自己为好友！");
            } else {
                $("#sctip").css("color", "#e00000");
                $("#sctip").html(xhttp.responseText);
            }
        } else if (xhttp.readyState == 4) {
            $("#sctip").css("color", "#e00000");
            $("#sctip").html("网络错误");
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let value = "name=" + name;
    xhttp.send(value);

}

function apply() {

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "PHP/Apply.php", true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            let applyStatus = parseInt(xhttp.responseText);
            if (applyStatus == 0) {
                $("#rttip").css("color", "#404040");
                $("#rttip").html("申请成功");
            } else if (applyStatus == 1) {
                $("#rttip").css("color", "#e00000");
                $("#rttip").html("已有申请信息，请勿重复提交。");
            } else if (applyStatus == 2) {
                $("#rttip").css("color", "#e00000");
                $("#rttip").html("用户不存在！");
            } else {
                $("#rttip").css("color", "#e00000");
                $("#rttip").html(xhttp.responseText);
            }
        } else if (xhttp.readyState == 4) {
            $("#rttip").css("color", "#e00000");
            $("#rttip").html("网络错误");
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let value = "name=" + gotName;
    xhttp.send(value);

}

function accept(dom) {

    gotName = $(dom).parent().parent().children(".name").html();
    apply();
    setTimeout(function () {
        window.location.assign(".");
    }, 1000);

}

function deny() {
    alert("抱歉，暂不支持拒绝好友申请");
}

function cancel() {
    alert("抱歉，暂不支持取消好友申请");
}