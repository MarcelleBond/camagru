<?php
    require_once 'core/init.php';

    $user = new user();

    if (!$user->isloggedin())
    {
        redirect::to('index.php');
    }

    if (input::exists()) {
        if (token::check(input::get('token'))) {
            
            $validate = new validate();
            $validation = $validate->check($_POST, array(
                'username' => array(
					'min' => 2,
					'max' => 20,
					'unique' => 'users'
				),
				'email' => array(
					'unique' => 'users'
				)
            ));
            if ($validation->passed())
            {
                try{
                    $user->update(array(
                        'username' => escape(input::get('username')),
                        'email' => escape(input::get('email'))
                    ));
                    session::flash('home', 'your details have been updated');
                    redirect::to('index.php');
                }
                catch(Exception $e)
                {
                    die($e->getMessage()); 
                }
            }
            else{
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
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/updatepage.css" />
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
        <div class="login_box1">
            <form action="#" method="post" autocomplete="off">
                <h1 class='current'>Update Username</h1>
                <input class="input_area" id="username" type="text" name="username" placeholder="New Username">
                <input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
                <input class="button" type="submit" value="Update">
            </form>
        </div>
        <div class="login_box2">
            <form action="#" method="post" autocomplete="off">
                <h1 class='current'>Update Email</h1>
                <input class="input_area" type="email" name="email" placeholder="New Email">    
                <input class="input_area" type="email" name="email_again" placeholder="Confirm New Email">    
                <input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
                <input class="button" type="submit" value="Update">
            </form>
        </div>
        <div class="login_box3">
            <form action="#" method="post">
                <h1 class='current'>Update Password</h1>
                <input class="input_area" type="password" name="passwd_current" id="passwd_current" placeholder="current password"> <br>
                <input class="input_area" type="password" name="passwd_new" id="passwd_new" placeholder="new password"> <br>
                <input class="input_area" type="password" name="passwd_new_again" id="passwd_new_again" placeholder="repeat new password"> <br>
                <input class="button" type="submit" value="Update"> <br>
                <input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
            </form>
        </div>
</body>
</html>