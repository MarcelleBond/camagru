<?php
    require_once 'core/init.php';

    $user = new user;
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="css/pic.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
<script src="js/pic.js"></script> 
</head>
<body>
<div class="navbar">
				<ul>
                    <li class="left"><a href="index.php">Home</a></li>
					<li class="left"><a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></li>                    
					<li class="left"><a href="new.php">NewPic</a></li>
					<li class="right"><a href="logout.php">Log out</a></li>
				</ul>
			</div>
			<img class="logo" src="images/site_images/logo.png" alt="logo">
<div class="top_container">


    
        <div id="overlay" class="overlay" onclick="off()">
        <img class="text" height='100px' width='100px' id="emoji1" name="emoji1" src="images/emojis/poo.png">
        </div>
        <div>
    <video id='video'>Stream not available...</video>
        </div>
    <!-- <button onclick="on()">On</button> -->
    

    <button id="photo_button" class="btn btn_darkk">
        Take Photo
    </button>
    <button id="save_photo" class="btn btn_darkk">
        save
    </button>
   

    </div>
       
    <div>
    <img id="e1" src="images/emojis/penguin.png" height='100px' width='100px'>
    <img id="e2" src="images/emojis/poo.png" height='100px' width='100px'>
    <br>

    <canvas id="canvas"></canvas>
</div>

<div class="bottom_container">
    <div id="photos"></div>
</div>
<script>
 function on() {
	//alert("FINISH");
    // document.getElementById("emoji1").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

function off() {
    // document.getElementById("emoji1").style.display = "block";
    document.getElementById("overlay").style.display = "none";
}



        emo1 = document.getElementById("e1");

		emo2 = document.getElementById("e2");
		emo1.addEventListener("click", function(){switchsrc(emo1);}, false);
        emo2.addEventListener("click", function(){switchsrc(emo2);}, false);

function switchsrc(emonew)
{
    //document.getElementById("emoji1").style.display = "block";
    document.getElementById("overlay").style.display = "block";
    var emoswitch = document.getElementById("emoji1");
    var ovl = document.getElementById("overlay");
    switch (emonew.id)
    {
        case "e1" :
            emoswitch.setAttribute('src', emonew.src);

            ovl.style.paddingTop = "180px";
            ovl.style.paddingLeft = "30px";
            break;
        case "e2" :
        emoswitch.setAttribute('src', emonew.src);
            ovl.style.paddingTop = "170px";
            ovl.style.paddingLeft = "70px";
            break;
    }
    
} 

</script>
     
</body>
</html> 
