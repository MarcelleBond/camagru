<?php
    require_once 'core/init.php';
        
    $usercheck = new user();
    $db = DB::getInstance();

    if ($usercheck->isloggedin()) {
        redirect::to('index.php');
    }
    
    if (isset($_GET["email"]))
    {
        $_SESSION["forgot"] = $_GET["email"];
    }
    $mail =  $_SESSION["forgot"] ;

    $db->query("SELECT `user_id` FROM `users` WHERE `email` = ?", array('email' => escape($mail)));


    if ($db->count() > 0)
    {
        if (Input::exists()) {
            if (token::check(input::get('token')))
            {
                $validate = new Validate();
                $validate = $validate->check($_POST, array(
                    'passwd' => array(
                        'required' => true,
                        'min' => 6,
                    ),
                    'passwd_again' => array(
                        'required' => true,
                        'matches' => 'passwd'
                    )
                ));

                if ($validate->passed())
                {
                    try
                    {
                        $db->query("UPDATE `users` SET `passwd`=? WHERE `email` = ?", array('passwd' => hash::make(escape(input::get('passwd'))), 'email' => $mail));                    
                        redirect::to('login.php');
                        
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
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Reset Password</title>
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
			<input type="password" class="input_area" name="passwd" id="passwd" placeholder="New Password" > <br>
			<input type="password" class="input_area" name="passwd_again" id="passwd_again" placeholder="New Password Again" > <br>
			<input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
			<input type="submit" class="button" name="submit" id="submit" value="Reset">
		</form>
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
