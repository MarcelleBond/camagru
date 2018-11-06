<?php
 	require_once 'core/init.php';


	if(session::exists("home"))
	{
		echo '<p>' . session::flash('home') .'<p>';
	}

	$user = new user();
	
	function loggedin()
	{
		Global $user;
		echo "<ul class='header'>
		<li class='left'><a href='index.php'>Home</a></li>
		<li class='left'><a href='profile.php?user=".$user->data()->username."'>".$user->data()->username."</a></li>
		<li class='left'><a href='newpic.php'>NewPic</a></li>
		<li class='right'><a href='logout.php'>Log out</a></li>
		</ul>";
	}
	function notloggedin()
	{
		echo "<ul>
				<li class='left'><a href='index.php'>Home</a></li>
				<li class='right'><a href='register.php'>Register</a></li>
				<li class='right'><a href='login.php'>Log in</a></li>
			</ul>";
	}
?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>Welcome</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
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
		<div id="images" class="photo">
		</div>
		<div id="controls">
			<button id="prev" onclick="prevset();">Previous</button>
			<button id="next" onclick="nextset();">Next</button>
		</div>
		<div class="footer">
				<ul class="footer">
					<li><a href="index.php">Home</a></li>
					<li><a href="update.php">Update Info</a></li>
				</ul>	
		</div>
		</body>
		</html>