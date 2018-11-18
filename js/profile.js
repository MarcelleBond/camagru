var picsPerPage = 4;
var offset = 0;
var numpics = countPics();
var numPages = Math.ceil(numpics / picsPerPage);
var imagediv = document.getElementById("images");

function prevset() {

    offset = +offset - picsPerPage;
    if (offset < 0) {
        offset = 0;
    }
    var div = document.getElementById("showcom");
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }
    fetchPics();
}

function nextset() {
    offset = +offset + picsPerPage;
    if (offset > parseInt(numpics)) {
        offset = 0;
    }
    var div = document.getElementById("showcom");
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }
    fetchPics();
}

function countPics() {
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    var vars = "picCounter2=SHO";
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            numpics = return_data;
        }
    }
    hr.send(vars);
}

function fetchPics() {
    var hr = new XMLHttpRequest();
    var url = "ajax.php";
    var vars = "offset2=" + offset + "&limit=" + picsPerPage;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;

            queryRes = JSON.parse(return_data);
            arrLength = queryRes.length;
            var myNode = document.getElementById("images");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            for (var i = 0; i < arrLength; i++) {
                var user_info = [queryRes[i]['img_id'], queryRes[i]['user_id']];
                var img = document.createElement('img');
                img.setAttribute('id', "eg" + i);
                img.setAttribute('data-id', user_info)
                img.setAttribute('src', queryRes[i]['img_name']);
                img.setAttribute('onclick', 'comFocus(this)');
                myNode.appendChild(img);

            }
        }
    }
    hr.send(vars);
}


function comFocus(imgObject) {
    var newsrc = imgObject.src;
    //alert(newsrc);
    var ele = imgObject.getAttribute("data-id");
    var actualimageid = ele.split(",");
    //document.getElementById("showcom").innerHTML = newsrc;
    ///////////////////

    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    var vars = "imgcomid=" + actualimageid[0];
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;

            queryRes = JSON.parse(return_data);
            arrLength = queryRes.length;
            var div = document.getElementById("showcom");
            var i = 0;
            while (div.firstChild) {
                div.removeChild(div.firstChild);
            }
            var div = document.getElementById("showcom");
            var comcount = document.createElement('p');
            comcount.setAttribute('id', 'likes');
            div.appendChild(comcount);
            fetchlikes(actualimageid)
            var newimg = document.createElement('img');
            newimg.setAttribute('src', newsrc);
            newimg.setAttribute('id', 'compic');
            newimg.setAttribute('data-id', actualimageid);
            newimg.setAttribute('style', 'width: 100%; max-width: 500px; margin-top:10px;');
            div.appendChild(newimg);
            while (i < arrLength) {
                var p = document.createElement('p');
                p.innerHTML = queryRes[i]['comment'];
                div.appendChild(p);
                i++;
            }
            var text_place = document.createElement('input');
            text_place.setAttribute('style', 'width: 100%; max-width: 500px; margin-top:5px; margin-bottom:5px;');
            text_place.setAttribute('id', 'comment');
            div.appendChild(text_place);
            var subbtn = document.createElement('button');
            subbtn.setAttribute('style', 'width: 100%; max-width: 500px; margin-top:5px; margin-bottom:5px;');
            subbtn.innerHTML = "COMMENT"
            subbtn.setAttribute('onclick', 'comment()');
            var likebtn = document.createElement('button');
            likebtn.setAttribute('style', 'width: 100%; max-width: 500px; margin-top:5px; margin-bottom:5px;');
            likebtn.innerHTML = "LIKE"
            likebtn.setAttribute('onclick', 'likes_pic()');            
            var removebtn = document.createElement('button');
            removebtn.setAttribute('style', 'width: 100%; max-width: 500px; margin-top:5px; margin-bottom:5px;');
            removebtn.innerHTML = "DELETE"
            removebtn.setAttribute('onclick', 'remove_pic('+actualimageid[0]+')');            
            div.appendChild(subbtn);
            div.appendChild(likebtn);
            div.appendChild(removebtn);
        }
    }
    hr.send(vars);
}


function comment()
{
    var imgObject = document.getElementById('compic');
    var ele = imgObject.getAttribute("data-id");
    var actualimageid = ele.split(",");
    var comm = document.getElementById('comment').value

    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    var vars = "img_id=" + actualimageid[0]+"&user_img_id=" + actualimageid[1] +"&comment="+ comm;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
           // alert(return_data);
           comFocus(imgObject);
        }
    }
    hr.send(vars);
}

function likes_pic()
{
    var imgObject = document.getElementById('compic');
    var ele = imgObject.getAttribute("data-id");
    var actualimageid = ele.split(",");

    var hr = new XMLHttpRequest();
    var url = "ajax.php";
    var vars = "picid="+actualimageid[0];
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            comFocus(imgObject);
        } 
    }
    hr.send(vars);
}

function fetchlikes(actualimageid)
{
    var hr = new XMLHttpRequest();
    var url = "ajax.php";
    var vars = "likes="+actualimageid[0];
    hr.open("POST", url, true); 
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            var comcount = document.getElementById("likes");
            comcount.innerHTML = "Likes: " + return_data;
           
        } 
    }
    hr.send(vars);
}

function remove_pic(actualimageid)
{
    // alert(actualimageid)
    var hr = new XMLHttpRequest();
    var url = "ajax.php";
    var vars = "remove_pic="+actualimageid;
    hr.open("POST", url, true); 
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            // alert(return_data);
            var div = document.getElementById("showcom");
            while (div.firstChild) {
                div.removeChild(div.firstChild);
            }
        fetchPics();           
        } 
    }
    hr.send(vars);
}

window.onload = function () {
    fetchPics();
}