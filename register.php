<?php
 	require_once 'core/init.php';
	if (Input::exists()) {
		if (token::check(input::get('token')))
		{
			$validate = new Validate();
			$validate = $validate->check($_POST, array(
				'username' => array(
					'required' => true,
					'min' => 2,
					'max' => 20,
					'unique' => 'users'
				),
				'passwd' => array(
					'required' => true,
					'min' => 6,
				),
				'passwd_again' => array(
					'required' => true,
					'matches' => 'passwd'
				),
				'email' => array(
					'required' => true,
					'unique' => 'users'
				)
			));

			if ($validate->passed())
			{
				$user = new user();

				try
				{
					$user->create(array(
						'username' => input::get('username'),
						'passwd' => hash::make(input::get('passwd')),
						'email' => input::get('email'),
						'groups' => 1
					));

					session::flash('home', 'you have been regestered and can login');
					redirect::to('index.php');
				}
				catch(Exception $e)
				{
					die ($e->getMessage());
				}
			}
			else
			{
				foreach ($validate->errors() as $error) {
					echo $error, '<br>';
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
	<title>Signup</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/signup.css" />
	<!-- <script src="main.js"></script> -->
</head>
<body>
	<div class="navbar">
		<ul>
			<li class="left"><a href="index.php">Home</a></li>
			<li class="right"><a href="login.php">Login</a></li>
		</ul>
	</div>
	<img class="logo" src="images/site_images/logo.png" alt="logo">
	<div class="login_box">
		<form action="" method="post" autocomplete="off">
			<input class="input_area" id="username" type="text" name="username" placeholder="Username" value="<?php echo escape(Input::get('username'));?>">
			<input class="input_area" id="passwd" type="password" name="passwd" placeholder="Password">
			<input class="input_area" id="passwd_again" type="password" name="passwd_again" placeholder="Password again">
			<input class="input_area" id="email" type="email" name="email" placeholder="example@host.com"value="<?php echo escape(Input::get('email'));?>">
			<input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
			<input class="button" type="submit" value="register">
		</form>
	</div>
</body>
</html>
