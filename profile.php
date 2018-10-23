<?php
    require_once 'core/init.php';

    if (!$username = input::get('user')) {
        redirect::to('index.php');
    } else {
        echo $username;
        $user = new user($username);
        // var_dump($user);
        if (!$user->exists()) {
            redirect::to(404);
        }
        else
        {
            echo "im the shit";
        }
    }
    
?>
