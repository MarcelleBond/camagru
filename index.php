<?php
 	require_once 'core/init.php';


	if(session::exists("home"))
	{
		echo '<p>' . session::flash('home') .'<p>';
	}

	$user = new user();
	if ($user->isloggedin()) {
		?> <p>Hello<a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a>!</p>
		<ul>
			<li><a href="logout.php">Log out</a></li>
			<li><a href="update.php">Update details</a></li>
			<li><a href="changepassword.php">change password</a></li>
		</ul>

		<?php
	}
	else 
	{
		echo "<p>You need to <a href='login.php'>log in</a> or <a href='register.php'>register</a></p>";
	}
?>
