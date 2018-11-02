<?php
 	require_once 'core/init.php';


	if(session::exists("home"))
	{
		echo '<p>' . session::flash('home') .'<p>';
	}

	$user = new user();
	if ($user->isloggedin()) {
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>Welcome</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
		</head>
		<body>
		<header>
			<div class="navbar">
				<ul>
					<li class="left"><a href="index.php">Home</a></li>
					<li class="left"><a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></li>
					<li class="left"><a href="newpic.php">NewPic</a></li>
					<li class="right"><a href="logout.php">Log out</a></li>
				</ul>
			</div>
			<img class="logo" src="images/site_images/logo.png" alt="logo">
		</header>
			whats good world
		<footer>
			
		</footer>
		</body>
		</html>

		<?php
	}
	else 
	{
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>Welcome</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
		</head>
		<body>
			<div class="navbar">
				<ul>
					<li class="left"><a href="index.php">Home</a></li>
					<li class="right"><a href="register.php">Register</a></li>
					<li class="right"><a href="login.php">Log in</a></li>
				</ul>
			</div>
			<img class="logo" src="images/site_images/logo.png" alt="logo">
			
		</body>
		</html>
		<?php
	}
?>
