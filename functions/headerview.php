<?php
    require_once 'core/init.php';

	
	function loggedin()
	{
		$user = new user();
		echo "<ul>
		<li class='left'><a href='index.php'>Home</a></li>
		<li class='left'><a href='profile.php?user=".$user->data()->username."'>".$user->data()->username."</a></li>
		<li class='left'><a href='newpic.php'>NewPic</a></li>
		<li><h1 class='camagru'>camagru</h1></li>
		<li class='right'><a href='logout.php'>Log out</a></li>
		</ul>";
	}
	function notloggedin()
	{
		echo "<ul>
				<li class='left'><a href='index.php'>Home</a></li>
				<li class='right'><a href='register.php'>Register</a></li>
				<li><h1 class='camagru'>camagru</h1></li> 
				<li class='right'><a href='login.php'>Log in</a></li>
			</ul>";
	}

?>