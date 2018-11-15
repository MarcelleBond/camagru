var picsPerPage = 3;
var offset = 0;
var numpics = countPics();
var numPages = Math.ceil(numpics / picsPerPage);
var image_ids;
function prevset() {

    offset = +offset - picsPerPage;
    if (offset < 0) {
        offset = 0;
    }
    fetchPics();
}

function nextset() {
    offset = +offset + picsPerPage;
    if (offset > parseInt(numpics)) {
        offset = 0;
    }
    fetchPics();
}

function countPics() {
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    var vars = "picCounter=SHO";
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

    var vars = "offset=" + offset + "&limit=" + picsPerPage;
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
                var img = document.createElement('img');
                img.setAttribute('id', "eg" + i);
                img.setAttribute('data-id', queryRes[i]['img_id'])
                img.setAttribute('src', queryRes[i]['img_name']);
                img.setAttribute('onclick', 'comFocus(this)');
                myNode.appendChild(img);
            }
        }
    }
    hr.send(vars);
}

function comFocus(imgObject){
    var newsrc = imgObject.src;
    //alert(newsrc);
    var actualimageid = imgObject.getAttribute("data-id");
    //document.getElementById("showcom").innerHTML = newsrc;

    ///////////////////

    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    var vars = "imgcomid="+actualimageid;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = JSON.parse(hr.responseText);
            alert(return_data);
            
            arlength = return_data.length;

            var i = 0;
            
            while(i < arrLength){
                document.getElementById("showcom").innerHTML += return_data[i]['comment'];
                i++;
            }

             
            }
        }
        hr.send(vars);
    }



window.onload = function () {
    fetchPics();
}