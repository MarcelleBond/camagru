<?php
    require_once 'core/init.php';

	
	function loggedin()
	{
		$user = new user();
		echo "<button class='left'><a href='index.php'>Home</a></button>
		<button class='left'><a href='profile.php?user=".$user->data()->username."'>".$user->data()->username."</a></button>
		<button class='left'><a href='newpic.php'>NewPic</a></button>
		<button class='right'><a href='logout.php'>Log out</a></button>";
	}
	function notloggedin()
	{
		echo "<button class='left'><a href='index.php'>Home</a></button>
		<button class='right'><a href='login.php'>Log in</a></button>
		<button class='right'><a href='register.php'>Register</a></button>";
	}

?>