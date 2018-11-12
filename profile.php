<?php
    require_once 'core/init.php';

    if (!$username = input::get('user')) {
        redirect::to('index.php');
    } else {
        $user_profile = new user($username);

        $user = new user();
        if (!$user_profile->exists()) {
            redirect::to(404);
        }
        else
        {
            $data = $user_profile->data();
        }
        if($user->data()->username === $username)
        {
            echo "welcome to your profile";
        }
        else 
        {
            echo " your uing someone else's profile";
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
                <script src="main.js"></script>
            </head>
            <body>
            <div class="navbar">
				<ul>
					<li class="left"><a href="index.php">Home</a></li>
                    <li class="left"><a href="newpic.php">NewPic</a></li>
                    <li><h1 class='camagru'>camagru</h1></li>                    
					<li class="right"><a href="logout.php">Log out</a></li>
				</ul>
			</div>
                <img class="logo" src="images/site_images/logo.png" alt="logo">
            <div>
                <h3><?php echo escape($data->username); ?></h3>
                <p><?php echo escape($data->email); ?></p>
            </div>
            </body>
            </html>
        <?php
    }
    
?>
