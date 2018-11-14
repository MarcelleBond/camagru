<?php
    require_once 'core/init.php';

    $user = new user();

    if (!$user->isloggedin())
    {
        redirect::to('index.php');
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
    <script src="js/newajax.js"></script>
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
            <h1 class='current'>Update Username</h1>
            <input class="input_area" id="username" type="text" name="username" placeholder="New Username">
            <input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
            <p id="userres" class="message"></p>
            <button class="button" id="passupdate" type="submit" onclick="updUser();" value="Update"> Update</button><br>
    </div>
    <div class="login_box2">
            <h1 class='current'>Update Email</h1>
            <input class="input_area" type="email" id="email" name="email" placeholder="New Email">    
            <input class="input_area" type="email" id="email_again" name="email_again" placeholder="Confirm New Email">    
            <input type="hidden" name="token" value="<?php echo token::generate(); ?>" >
            <p id="emailres" class="message"></p>
            <button class="button" id="passupdate" type="submit" onclick="updEmail();" value="Update"> Update</button><br>                
    </div>
    <div class="login_box3">
        <h1 class='current'>Update Password</h1>
        <input class="input_area" type="password" name="passwd_current" id="passwd_current" placeholder="current password"> <br>
        <input class="input_area" type="password" name="passwd_new" id="passwd_new" placeholder="new password"> <br>
        <input class="input_area" type="password" name="passwd_new_again" id="passwd_new_again" placeholder="repeat new password"> <br>
        <p id="passres" class="message"></p>
        <button class="button" id="passupdate" type="submit" onclick="updPass();" value="Update"> Update</button><br>
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