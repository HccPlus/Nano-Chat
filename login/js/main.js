
function check(userName, password) {
    let ret = true
    if (userName.search(/^[0-9a-z\u4e00-\u9fa5]{4,16}$/i) != 0) {
        $("#untip").css("color", "#e00000");
        document.getElementById("untip").innerHTML = "用户名格式不正确！";
        console.log("unError");
        ret = false;
    }
    if (password.search(/^[^\n]{6,16}$/) != 0) {
        $("#pwtip").css("color", "#e00000");
        document.getElementById("pwtip").innerHTML = "密码格式不正确！";
        console.log("pwError");
        ret = false;
    }
    return ret;
}

function submit() {
    let userName = document.getElementById("un").value;
    let password = document.getElementById("pw").value;
    if (check(userName, password) != true) {
        return;
    }
    password = md5(password);

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "PHP/Verify.php", true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            let loginStatus = parseInt(xhttp.responseText);
            if (loginStatus == 0) {
                $("#smtip").css("color", "#404040");
                document.getElementById("smtip").innerHTML = "登录成功！";
                setTimeout('window.location.assign("/")', 1000);
            } else if (loginStatus == 1) {
                $("#smtip").css("color", "#e00000");
                document.getElementById("smtip").innerHTML = "用户名不存在！";
            } else if (loginStatus == 2) {
                $("#smtip").css("color", "#e00000");
                document.getElementById("smtip").innerHTML = "用户名或密码错误！";
            } else {
                $("#smtip").css("color", "#e00000");
                document.getElementById("smtip").innerHTML = xhttp.responseText;
            }
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let value = "userName=" + userName + "&password=" + password;
    xhttp.send(value);
}

function add_user() {
    let userName = document.getElementById("un").value;
    let password = document.getElementById("pw").value;
    if (check(userName, password) != true) {
        return;
    }
    password = md5(password);

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "PHP/Adduser.php", true);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            let loginStatus = parseInt(xhttp.responseText);
            if (loginStatus == 0) {
                $("#smtip").css("color", "#404040");
                document.getElementById("smtip").innerHTML = "注册成功！";
                setTimeout('window.location.assign("/")', 1000);
            } else if (loginStatus == 1) {
                $("#smtip").css("color", "#e00000");
                document.getElementById("smtip").innerHTML = "用户名已存在！";
            } else {
                $("#smtip").css("color", "#e00000");
                document.getElementById("smtip").innerHTML = xhttp.responseText;
            }
        }
    }
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let value = "userName=" + userName + "&password=" + password;
    xhttp.send(value);
}

document.getElementById("un").onfocus = function () {
    $("#untip").css("color", "#404040");
    document.getElementById("untip").innerHTML = "*请输入4位以上中文、英文字母或数字";
}

document.getElementById("un").onblur = function () {
    document.getElementById("untip").innerHTML = "";
}

document.getElementById("pw").onfocus = function () {
    $("#pwtip").css("color", "#404040");
    document.getElementById("pwtip").innerHTML = "*请输入6位以上密码";
}

document.getElementById("pw").onblur = function () {
    document.getElementById("pwtip").innerHTML = "";
}