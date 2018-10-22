<?php
	require_once 'core/init.php';

	$user = new user();

	if (!$user->isloggedin()) {
		redirect::to('index.php');
	}

	if (input::exists()) {
		if (token::check(input::get('token'))) {
			
			$validate = new validate();
			$validation = $validate->check($_POST, array(
				'passwd_current' => array(
					'required' => true,
					'min' => 6
				),
				'passwd_new' => array(
					'required' => true,
					'min' => 6
				),
				'passwd_new_again' => array(
					'required' => true,
					'min' => 6,
					'matches' => 'passwd_new'
				)
			));

			if ($validation->passed()) {
				if (hash::make(input::get('passwd_current')) !== $user->data()->passwd)
				{
					echo "Your current password was incorrect :(";
				}
				else
				{
					$user->update(array(
						'passwd' => hash::make(input::get('passwd_new'))
					));
					session::flash('home', 'Your password was updated');
					redirect::to('index.php');
				}
			} else {
				foreach ($validation->errors() as $error) {
					echo $error, "<br>";
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
	<title>change password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" /> -->
	<!-- <script src="main.js"></script> -->
</head>
<body>
	<form action="" method="post">
		<input type="password" name="passwd_current" id="passwd_current" placeholder="current password"> <br>
		<input type="password" name="passwd_new" id="passwd_new" placeholder="new password"> <br>
		<input type="password" name="passwd_new_again" id="passwd_new_again" placeholder="repeat new password"> <br>
		<input type="submit" value="Update"> <br>
		<input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
	</form>

</body>
</html>