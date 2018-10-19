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
				'name' => array(
					'required' => true,
					'min' => 2,
					'max' => 50
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
						'name' => input::get('name'),
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
	<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
	<script src="main.js"></script>
</head>
<body>
	<div class="login_box">
		<form action="" method="post" autocomplete="off">
			<div class="field"><input id="username" type="text" name="username" placeholder="Username" value="<?php echo escape(Input::get('username'));?>"></div>
			<div><input id="passwd" type="password" name="passwd" placeholder="Password"></div>
			<div><input id="passwd_again" type="password" name="passwd_again" placeholder="Password_again"></div>
			<div><input id="name" type="text" name="name" placeholder="name"value="<?php echo escape(Input::get('name'));?>"></div>
			<input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
			<div><input type="submit" value="register"></div>
		</form>
	</div>
</body>
</html>
