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
        ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>Page Title</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
                <script src="js/profile.js"></script>
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

            <div id="images" class="photo" >
            </div>
            <div id="controls">
                <button id="prev" onclick="prevset();">Previous</button>
                <button id="next" onclick="nextset();">Next</button>
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
        <?php
    }
    
?>
