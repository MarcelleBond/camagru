<?php
	require_once 'core/init.php';

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
				$user = new user();
				$remember = (input::get('remember') === 'on') ? true : false;
				$login = $user->login(input::get('username'), input::get('passwd'), $remember);
				if($login)
				{
					redirect::to('index.php');
				}
				else
				{
					echo "login failed";
				}
			}
			else
			{
				foreach ($validation->errors() as $error) {
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
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="login.css" />
	<script src="main.js"></script>
</head>
<body>
	<div class="login_box">
		<form action="" method="post" autocomplete="off">
			<input type="text" class="input_area" name="username" id="username" placeholder="Username"> <br>
			<input type="password" class="input_area" name="passwd" id="passwd" placeholder="Password"> <br>
			<input type="checkbox" name="remember" id="remember"> Remember me
			<input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
			<input type="submit" class="button" name="submit" id="submit" value="Login">
		</form>
	</div>
</body>
</html>
