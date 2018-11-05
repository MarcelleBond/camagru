var picsPerPage =4;
var offset = 0;
var numpics = countPics();
//countPics();
var numPages = Math.ceil(numpics/picsPerPage);
var imagediv = document.getElementById("images");

function prevset(){

    offset = +offset - 2;
    if(offset < 0)
    {
        offset = 0;
    }
    alert(offset);
    countPics();
}

function nextset(){
    offset = +offset + 2;
   // alert(offset);
    if(offset > parseInt(numpics))
    {
        offset = 0;
    }
   // alert(offset);
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
    alert("fetching");
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

           for(var i= 0;i < arrLength; i++)
          {
              document.getElementById("eg"+i).setAttribute('src',queryRes[i]['img_name']);
          } 
         // alert(arrLength);
         
     }
}
hr.send(vars);
}