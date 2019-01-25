<?php
require_once 'core/init.php';

$usercheck = new user();
$db = DB::getInstance();

if ($usercheck->isloggedin()) {
    redirect::to('index.php');
}

if (input::exists()) {
    if (token::check(input::get('token'))) {
        $validate = new validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'passwd' => array('required' => true),
        ));
        if ($validation->passed()) {
            $user = new user(escape(input::get('username')));
            if ($user->data() != null) {
                if ($user->data()->active === '1') {
                    $login = $user->login(escape(input::get('username')), escape(input::get('passwd')));
                    if ($login) {
                        redirect::to('index.php');
                    } else {
                        echo "<script>alert('Login Failed');</script>";
                    }
                } else {
                    echo "<script>alert('Please activate your account');</script>";
                }
            } else {
                echo "<script>alert('Incorrect username and password');</script>";
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo "<script>alert('" . $error . "');</script>";
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
    <title>Login</title>
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
} else {
    notloggedin();

}
?>
    </div>
    <img class="logo" src="images/site_images/logo.png" alt="logo">
    <div class="login_box">
        <form action="" method="post" autocomplete="off">
            <input type="text" class="input_area" name="username" id="username" placeholder="Username"> <br>
            <input type="password" class="input_area" name="passwd" id="passwd" placeholder="Password"> <br>
            <input type="hidden" name="token" value="<?php echo token::generate(); ?>">
            <input type="submit" class="button" name="submit" id="submit" value="Login">
        </form>
        <button class="button"><a href="forgot.php">Forgot password ?</a></button>
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