<?php
	require_once 'core/init.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Camagru</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" media="screen" href="css/pic.css"/> -->
	<script src="js/pic.js"></script>
</head>
<body>
	<div class="navbar">
		<h1>Camagru</h1>
	</div>

	<div class="top_container">
		<video id='video'>Stream not available...</video>
		<button id="photo_button" class="btn btn_darkk">
			Take Photo
		</button>
		<select id="photo_filter">
			<option value="non">Normal</option>
			<option value="grayscale(100%)">Grayscale</option>
			<option value="sepia(100%)">Sepia</option>
			<option value="invert(100%)">Invert</option>
			<option value="hue-rotate(90deg)">Hue</option>
			<option value="blur">Blur</option>
			<option value="contrast">Contrast</option>
		</select>
		<button id="clear_button">Clear</button>
		<canvas id="canvas"></canvas>
	</div>

	<div class="bottom_container">
		<div id="photos"></div>
	</div>

</body>
</html>