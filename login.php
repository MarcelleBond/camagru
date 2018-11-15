<?php
	require_once 'core/init.php';
	
	$user = new user();
	$db = DB::getInstance();
	
	if ($user->isloggedin()) {
		redirect::to('index.php');
	}
	
	if(input::exists())
	{
		if (token::check(input::get('token')))
		{
			$validate = new validate();
			$validation = $validate->check($_POST, array(
				'username' => array('required' => true),
				'passwd' => array('required' => true)
			));
			if ($validation->passed())
			{
				// $user = new user();
				$login = $user->login(input::get('username'), input::get('passwd'));
				if($login)
				{
					redirect::to('index.php');
				}
				else
				{
					echo "<script>alert('Login Failed');</script>";
				}
			}
			else
			{
				function error()
				{
					global $validation;
					foreach ($validation->errors() as $error) {
					echo $error, '<br>';
				}
			}
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
	<!-- <script src="main.js"></script> -->
</head>
<body>
	<div class="navbar">
		<ul class="header">
			<li class="left"><a href="index.php">Home</a></li>
			<li class="right"><a href="register.php">Register</a></li>
		</ul>
	</div>
	<img class="logo" src="images/site_images/logo.png" alt="logo">
	<div class="login_box">
		<form action="" method="post" autocomplete="off">
			<input type="text" class="input_area" name="username" id="username" placeholder="Username" > <br>
			<input type="password" class="input_area" name="passwd" id="passwd" placeholder="Password" required> <br>
			<input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
			<p id="login_error" class="message"><?php /* error(); */ ?></p>
			<input type="submit" class="button" name="submit" id="submit" value="Login">
		</form>
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
