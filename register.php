<?php
 	require_once 'core/init.php';
	 $user = new user();
	 function activeEmail($token, $mail) {
		$message = ' 
		Click on link below to activate account:
		http://localhost:8080/camagru/active.php?token='.$token.'&email='.$mail;
		$message = wordwrap($message, 100, "\r\n");
		$headers = "From: Mbond@students.wethinkcode.co.za" . "\r\n" .
		mail( escape($_POST['email']) , 'Activation link' , $message, $headers);
		echo '<script>alert("Pls check email.")</script>';
		}	
	if(!$user->isloggedin())
	{
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
					'unique' => 'users',
					'valid_email' => 1
				)
			));

			if ($validate->passed())
			{
				try
				{
					$token = "QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890!$()*";
					$token = str_shuffle($token);
					$token = substr($token, 0, 10);
					$user->create(array(
						'username' => escape(input::get('username')),
						'passwd' => hash::make(escape(input::get('passwd'))),
						'email' => escape(input::get('email')),
						'active' => 0,
						'ver_code' => $token,
					));
					activeEmail($token,escape(input::get('email')));
					
					session::flash('home', '<script>alert("Please check email.")</script>');
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
					echo "<script>alert('".$error."');</script>";
				}
			}
		}
	}
}
else
{
	redirect::to('index.php');
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
	<link rel="stylesheet" type="text/css" media="screen" href="css/w3.css" />

	<!-- <script src="main.js"></script> -->
</head>
<body>
	<div class="navbar">
	<?php
		if ($user->isloggedin()) {
			loggedin();
		}
		else{
			notloggedin();

		}
	?>
	</div>
	<img class="logo" src="images/site_images/logo.png" alt="logo">
	<div class="login_box">
		<form action="" method="post" autocomplete="off">
			<input class="input_area" id="username" type="text" name="username" placeholder="Username" value="<?php echo escape(Input::get('username'));?>">
			<input class="input_area" id="passwd" type="password" name="passwd" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
			<input class="input_area" id="passwd_again" type="password" name="passwd_again" placeholder="Password again" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
			<input class="input_area" id="email" type="input" name="email" placeholder="example@host.com"value="<?php echo escape(Input::get('email'));?>">
			<input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
			<input class="button" type="submit" value="register">
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
