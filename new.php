<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="js/pic.js"></script>
<style>
#overlay {
    position: fixed;
    display: none;
    width: 20%;
    height: 20%;
    top: 50;
    left: 10;
    right: 70;
    bottom: 30;
    z-index: 2;
    cursor: pointer;
}

#text{
    position: absolute;
    top: 110%;
    left: 50%;
    font-size: 50px;
    color: white;
    transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
}
</style>
</head>
<body>

<!-- <div id="overlay" onclick="off()">
  <div id="text">Overlay Text</div>
</div>

<div style="padding:20px">
  <h2>Overlay with Text</h2>
  <button onclick="on()">Turn on overlay effect</button>
</div>

<script>
function on() {
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
}
</script> -->

<div class="top_container">

<!--  -->
    
        <div id="overlay" class="overlay" onclick="off()">
        <img height='100px' width='100px' id="emoji1" name="emoji1" src="images/emojis/poo.png">
        </div>
        <div>
    <video id='video'>Stream not available...</video>
        </div>
    <button onclick="on()">OFF</button>
    
<!--  -->
    <button id="photo_button" class="btn btn_darkk">
        Take Photo
    </button>
    <button id="save_photo" class="btn btn_darkk">
        save
    </button>
    <div style="background-image: url(images/emojis/emoji_1.jpg)">

    </div>
       
    
    <select id="photo_filter">
        <option value="none">Normal</option>
        <option value="images/emojis/emoji_1.jpg">Grayscale</option>
        <option value="images/emojis/emoji_2.jpg">Sepia</option>
        <option value="images/emojis/emoji_3.jpg">Invert</option>
        <option value="images/emojis/emoji_4.jpg">Hue</option>
        <option value="images/emojis/emoji_5.jpg">Blur</option>
        <option value="images/emojis/emoji_6.jpg">Contrast</option>
        <option value="images/emojis/emoji_7.jpg">Contrast</option>
        <option value="images/emojis/emoji_8.jpg">Contrast</option>
        <option value="images/emojis/emoji_9.jpg">Contrast</option>
        <option value="images/emojis/emoji_10.jpg">Contrast</option>
    </select>
    <canvas id="canvas"></canvas>
</div>

<div class="bottom_container">
    <div id="photos"></div>
</div>
<script>
function on() {
	alert("FINISH");
    document.getElementById("emoji1").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("emoji1").style.display = "block";
    document.getElementById("overlay").style.display = "none";
}
</script>
     
</body>
</html> 
