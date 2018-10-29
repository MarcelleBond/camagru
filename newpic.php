<!-- <?php
	require_once 'core/init.php';
?> -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Camagru</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/pic.css"/>
	<script src="js/pic.js"></script>
	<script src="js/test.js"></script>
</head>
<body>
	<div class="navbar">
		<h1>Camagru</h1>
	</div>

	<div class="top_container">

	<!--  -->
		
			<div id="overlay" class="overlay" onclick="off()">
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
			<img height='100px' width='100px' id="emoji1" name="emoji1" src="images/emojis/emoji_1.jpg">
		
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

</body>
<script>
function on() {
	alert("FINISH");
    document.getElementById("overlay").style.display = "none";
}

function off() {
    document.getElementById("overlay").style.display = "block";
}
</script>

</html>