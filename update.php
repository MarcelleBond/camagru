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
                'name' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 50
                ),
            ));
            if ($validation->passed())
            {
                
            }
            else{
                foreach ($validation->errors as $error) {
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
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" /> -->
    <!-- <script src="main.js"></script> -->
</head>
<body>
    <form action="" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo escape($user->data()->username);?>">

        <input type="submit" value="Update">
        <input type="hidden" name="token" value="<?php echo token::generate();?>">
    </form>
</body>
</html>