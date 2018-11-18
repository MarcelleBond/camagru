function updPass() {
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    curpass = document.getElementById("passwd_current").value;
    newpass = document.getElementById("passwd_new").value;
    newpassag = document.getElementById("passwd_new_again").value;
    var vars = "passwd_new=" + newpass + "&passwd_new_again=" + newpassag + "&passwd_current=" + curpass + "";
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;

            document.getElementById("passres").innerHTML = return_data;
            document.getElementById("passwd_current").value = "";
            document.getElementById("passwd_new").value = "";
            document.getElementById("passwd_new_again").value = "";

        }
    }
    hr.send(vars);
}


function updEmail() {
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    curpass = document.getElementById("email_again").value;
    newpass = document.getElementById("email").value;
    var vars = "email=" + newpass + "&email_again=" + newpass;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("emailres").innerHTML = return_data;
            document.getElementById("email_again").value = "";
            document.getElementById("email").value = "";



        }
    }
    hr.send(vars);
}


function updUser() {
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    curpass = document.getElementById("username").value;
    var vars = "username=" + curpass;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("userres").innerHTML = return_data;
            curpass = document.getElementById("username").value = "";

        }
    }
    hr.send(vars);
}

var box = document.getElementById("chbx");

function testfunc() {
    notifsub(box)
    var xhr = new XMLHttpRequest();
    var url = "ajax.php";
    if (box.checked) {
        var notify = 1;
    }
    else {
        var notify = 0;
    }
    var newvars = "notify=" + notify;
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(newvars);
}

function notifsub(cbx) {
    if (cbx.checked) {
        alert('checkbox is checked!');
    }
    else {
        alert("TSEK");
    }
}

function checkcheck() {
    var xhr = new XMLHttpRequest();
    var url = "ajax.php";
    var newvars = "mypostname=" + "testttt";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            chkstat = xhr.responseText;
            if (chkstat == "1") {
                box.checked = true;
            }
            else {
                box.checked = false;
            }

        }
    };
    xhr.send(newvars);

}

window.onload = function () {
    // alert(box.value);
    checkcheck();

}