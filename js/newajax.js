function updPass()
{
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    curpass =  document.getElementById("passwd_current").value;
    newpass =document.getElementById("passwd_new").value;
    newpassag =document.getElementById("passwd_new_again").value;
    var vars = "passwd_new="+newpass+"&passwd_new_again="+newpassag+"&passwd_current="+curpass+"";
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
     if(hr.readyState == 4 && hr.status == 200) {
         var return_data = hr.responseText;
          
          document.getElementById("passres").innerHTML = return_data;
         
     }
}
hr.send(vars);
}


function updEmail()
{
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    curpass =  document.getElementById("email_again").value;
    newpass =document.getElementById("email").value;
    var vars = "email="+newpass+"&email_again="+newpass;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
     if(hr.readyState == 4 && hr.status == 200) {
         var return_data = hr.responseText;
          document.getElementById("emailres").innerHTML = return_data;
          
         
     }
}
hr.send(vars);
}


function updUser()
{
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    curpass =  document.getElementById("username").value;
    var vars = "username="+curpass;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
     if(hr.readyState == 4 && hr.status == 200) {
         var return_data = hr.responseText;
          
          document.getElementById("userres").innerHTML = return_data;
     }
}
hr.send(vars);
}

