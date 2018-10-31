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
			<div class="navbar">
				<ul>
					<li class="left"><a href="index.php">Home</a></li>
					<li class="left"><a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></li>
					<li class="left"><a href="new.php">NewPic</a></li>
					<li class="right"><a href="logout.php">Log out</a></li>
				</ul>
			</div>
		<div >
			<img class="logo" src="images/site_images/logo.png" alt="logo">
		</div>
		</body>
		</html>

		<?php
	}
	else 
	{
		echo "<p>You need to <a href='login.php'>log in</a> or <a href='register.php'>register</a></p>";
	}
?>
