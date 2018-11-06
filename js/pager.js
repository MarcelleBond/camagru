var picsPerPage = 12;
var offset = 0;
var numpics = countPics();
//countPics();
var numPages = Math.ceil(numpics/picsPerPage);
var imagediv = document.getElementById("images");

function prevset(){

    offset = +offset - picsPerPage;
    if(offset < 0)
    {
        offset = 0;
    }
    // alert(offset);
//    alert(picsPerPage);

    // countPics();
    fetchPics();
}

function nextset(){
    offset = +offset + picsPerPage;
   // alert(offset);
    if(offset > parseInt(numpics))
    {
        offset = 0;
    }
//    alert(offset);
//    alert(picsPerPage);
    //countPics();
    fetchPics();
}

function countPics()
{
 var hr = new XMLHttpRequest();
 var url = "ajax.php";

 var vars = "picCounter=SHO";
 hr.open("POST", url, true);
 hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 hr.onreadystatechange = function() {
     if(hr.readyState == 4 && hr.status == 200) {
         var return_data = hr.responseText;
          //alert(return_data);
          numpics = return_data;
     }
 }
 hr.send(vars);
}

function fetchPics()
{
    // alert("fetching");
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

 var vars = "offset="+offset+"&limit="+picsPerPage;
 hr.open("POST", url, true);
 hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 hr.onreadystatechange = function() {
     if(hr.readyState == 4 && hr.status == 200) {
         var return_data = hr.responseText;
          
          //append or switch src
          queryRes = JSON.parse(return_data);
          console.log(queryRes);
          arrLength = queryRes.length;
          var myNode = document.getElementById("images");
          while (myNode.firstChild) {
              myNode.removeChild(myNode.firstChild);
          }
           for(var i= 0;i < arrLength; i++)
          {
              var img = document.createElement('img'); 
              img.setAttribute('id',"eg"+i);
              img.setAttribute('src',queryRes[i]['img_name']);
              img.setAttribute('onclick','alert("hi")');
              myNode.appendChild(img);

          } 
         // alert(arrLength);
         
     }
}
hr.send(vars);
}

window.onload = function()
{
    fetchPics();
}