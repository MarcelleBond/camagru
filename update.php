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
                        'username' => input::get('username'),
                        'email' => input::get('email')
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
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="main.css" /> -->
    <!-- <script src="main.js"></script> -->
</head>
<body>
    <form action="" method="post">
        <label for="name">Name</label>
        <input type="text" name="username" value="<?php echo escape($user->data()->username);?>">
        <input type="email" name="email" value="<?php echo escape($user->data()->email);?>">

        <input type="submit" value="Update">
        <input type="hidden" name="token" value="<?php echo token::generate();?>">
    </form>
</body>
</html>