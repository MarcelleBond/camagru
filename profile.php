<?php
    require_once 'core/init.php';

    if (!$username = input::get('user')) {
        redirect::to('index.php');
    } else {
        $user = new user($username);
        if (!$user->exists()) {
            redirect::to(404);
        }
        else
        {
            $data = $user->data();
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
					<li class="left"><a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></li>
					<li class="left"><a href="new.php">NewPic</a></li>
					<li class="right"><a href="logout.php">Log out</a></li>
				</ul>
			</div>
            <div >
                <!-- <img class="logo" src="images/site_images/logo.png" alt="logo"> -->
            </div>
            <div>
                <ul>
                    <li><a class="update" href="update.php">Update details</a></li>
                    <li><a class="update" href="changepassword.php">change password</a></li>
                </ul>
                 <h3><?php echo escape($data->username); ?></h3>
                <p><?php echo escape($data->email); ?></p>
            </div>
            </body>
            </html>
        <?php
    }
    
?>
