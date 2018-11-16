<?php
 	require_once 'core/init.php';

	 $user = new user();
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/w3.css" />
	<script src="js/pager.js"></script>
</head>
<body>
	<div class="navbar">
	<?php
		if ($user->isloggedin()) {
			loggedin();
		}
		else{
			notloggedin();
		}
	?>
	</div>
	<img class="logo" src="images/site_images/logo.png" alt="logo">
	<div class="w3-row">
		<div id="images" class="w3-container w3-twothird photo" >
		</div>
		<div id="showcom" class="w3-container w3-third" style="background: #333; color: white; margin-top:3px; margin-bottom:10px;">
		</div>
	</div>
		<div id="controls">
			<button id="prev" onclick="prevset();">Previous</button>
			<button id="next" onclick="nextset();">Next</button>
		</div>

<div class="footer">
	<p class='right' style="color: white">&copymbond</p>	
	<ul class="footer">
		<li><a href="index.php">Home</a></li>
		<?php
			if ($user->isloggedin()) {
				echo "<li><a href='update.php'>Update Info</a></li>";
			}
		?>
	</ul>
</div>
</body>
</html>