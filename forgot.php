<?php
	require_once 'core/init.php';
	
	$usercheck = new user();
	$db = DB::getInstance();
	
	if ($usercheck->isloggedin()) {
		redirect::to('index.php');
	} 

    function activeEmail($mail) {
    $message = ' 
    Click on link below to reset your password:
    http://localhost:8080/camagru/reset.php?email='.$mail;
    $message = wordwrap($message, 100, "\r\n");
    mail( $_POST['email'] , 'Activation link' , $message);
    echo '<script>alert("Pls check email.")</script>';
    }

	if(input::exists())
	{
		if (token::check(input::get('token')))
		{
			$validate = new validate();
			$validation = $validate->check($_POST, array(
                'email' => array('required' => true,
                            'valid_email' => 1),
			));
			if ($validation->passed())
			{
                $db->query("SELECT `user_id` FROM `users` WHERE `email` = ?", array('email' => escape(input::get('email'))));
				if ($db->count() > 0)
				{
                    activeEmail(escape(input::get('email')));
                    redirect::to('logout.php');
				}
				else
				{
					echo '<script>alert("User does not exist.")</script>';
				}
			}
			else
			{
				foreach ($validation->errors() as $error) {
					echo "<script>alert('".$error."');</script>";
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
	<title>forgot password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/w3.css" />

	<!-- <script src="main.js"></script> -->
</head>
<body>
	<div class="navbar">
	<?php
		if ($usercheck->isloggedin()) {
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
			<input type="text" class="input_area" name="email" id="email" placeholder="Enter  Email" > <br>
			<input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
			<input type="submit" class="button" name="submit" id="submit" value="Submit">
		</form>
	</div>
	</div>
	<div class="footer">
		<p class='right' style="color: white">&copymbond</p>	
		<ul class="footer">
			<li><a href="index.php">Home</a></li>
			<?php
				if ($usercheck->isloggedin()) {
					echo "<li><a href='update.php'>Update Info</a></li>";
				}
			?>
		</ul>
	</div>
</body>
</html>
