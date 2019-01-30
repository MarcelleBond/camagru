<?php
include "core/init.php";
$user = new user();
$db = DB::getInstance();

if (isset($_POST['offset2'])) {
    profilegallery();
} else if (isset($_POST['picCounter'])) {
    imgCount();
} else if (isset($_POST['picCounter2'])) {
    imgCount2();
} else if (isset($_POST['offset'])) {
    homegallery();
} else if (isset($_POST['username'])) {
    usernameupdate2();
} else if (isset($_POST['email'])) {
    emailupdate2();
} else if (isset($_POST['passwd_new']) && isset($_POST['passwd_current']) && isset($_POST['passwd_new_again'])) {
    passwordupdate2();
} else if (isset($_POST['imgcomid'])) {

    comments($_POST['imgcomid']);
} else if (isset($_POST['comment'])) {

    add_comment();
} else if (isset($_POST['picid'])) {

    like_pic();
} else if (isset($_POST['likes'])) {

    count_likes();
} else if (isset($_POST['remove_pic'])) {

    remove_img();
} else if (isset($_POST['notify'])) {
    notify();
} else if (isset($_POST['mypostname'])) {
    checknotify();
} else {
    redirect::to('index.php');
}

function homegallery()
{
    global $db;
    $db->query("SELECT * FROM gallery ORDER BY time_stamp DESC LIMIT " . $_POST['limit'] . " OFFSET " . $_POST['offset']);
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo json_encode($images);
}

function profilegallery()
{
    global $db, $user;
    $db->query("SELECT * FROM gallery WHERE `user_id` =" . $user->data()->user_id . " ORDER BY time_stamp DESC LIMIT " . $_POST['limit'] . " OFFSET " . $_POST['offset2']);
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo json_encode($images);
}

//count images
function imgCount()
{
    global $db;
    $db->query("SELECT * FROM gallery");
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo intval($num_images);
}

function imgCount2()
{
    global $db, $user;
    $db->query("SELECT * FROM gallery WHERE `user_id` = " . $user->data()->user_id . "");
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo intval($num_images);
}

function comments($img_id)
{
    global $db;
    $db->get("comments", array('img_id', '=', $img_id));
    $comments = $db->results();
    echo json_encode($comments);
}

function add_comment()
{
    global $db, $user;
    if ($user->isloggedin()) {
        if ($db->insert('comments', array(
            'user_img_id' => escape(input::get('user_img_id')),
            'friend_id' => $user->data()->user_id,
            'comment' => escape(input::get('comment')),
            'img_id' => escape(input::get('img_id')),
        ))) {
            $user_img = new user(escape(input::get('user_img_id')));
            if ($user_img->data()->notify === '1') {

                $mail = $user_img->data()->email;
                $message = 'SOMEONE COMMENTED ON ONE OF YOUR POSTS';
                $message = wordwrap($message, 100, "\r\n");
                mail($mail, 'NOTIFICATION', $message);
            }
            echo "insert successful";
        }
    } else {
        echo "please login to comment";
    }
}

function like_pic()
{
    global $db, $user;
    if ($user->isloggedin()) {
        if ($db->query("INSERT INTO likes (img_id,likers_id,like_status) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE like_status=IF(like_status=1, 0, 1)",
            array('img_id' => escape(input::get('picid')),
                'likers_id' => $user->data()->user_id, 1))) {
            $user_img = new user(escape(input::get('user_img_id')));
            $db->query('SELECT like_status FROM likes WHERE img_id = ? AND likers_id = ? ', array('img_id' => escape(input::get('picid')),
            'likers_id' => $user->data()->user_id));
            $like_stat = $db->results();
                    if ($user_img->data()->notify === '1' && $like_stat[0]->like_status == 1) {

                        $mail = $user_img->data()->email;
                        $message = 'SOMEONE LIKED ONE OF YOUR POSTS';
                        $message = wordwrap($message, 100, "\r\n");
                        mail($mail, 'NOTIFICATION', $message);
                    }
            echo "liked inserted";
        }
    } else {
        echo "please login to like";
    }
}

function count_likes()
{
    global $db, $user;
    $db->query("SELECT * FROM likes WHERE `img_id` = " . input::get('likes') . " AND like_status = 1");
    $images = $db->results();
    $num_images = $db->count();
    echo intval($num_images);
}

function remove_img()
{
    global $db, $user;
    if ($db->delete('gallery', array('img_id', '=', input::get('remove_pic')))) {
        echo "removed successfully " . input::get('remove_pic');
    } else {
        echo "failed to remove";
    }

}

function checknotify()
{
    global $user;

    echo $user->data()->notify;
}

function notify()
{
    global $user;
    $user->update(array(
        'notify' => input::get('notify'),
    ));
    echo "Update successful";
}

function passwordupdate2()
{

    if (input::exists()) {

        global $user;

        $validate = new validate();
        $validation = $validate->check($_POST, array(
            'passwd_current' => array(
                'required' => true,
                'min' => 6,
            ),
            'passwd_new' => array(
                'required' => true,
                'min' => 6,
            ),
            'passwd_new_again' => array(
                'required' => true,
                'min' => 6,
                'matches' => 'passwd_new',
            ),
        ));

        if ($validation->passed()) {
            if (hash::make(escape(input::get('passwd_current'))) !== $user->data()->passwd) {
                echo "Your current password was incorrect :(";
            } else {
                $user->update(array(
                    'passwd' => hash::make(escape(input::get('passwd_new'))),
                ));
                echo 'Update successful';
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, "<br>";
            }
        }

    }
}

function usernameupdate2()
{
    global $user;
    if (input::exists()) {

        $validate = new validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'min' => 2,
                'max' => 20,
                'unique' => 'users',
            ),
        ));
        if ($validation->passed()) {
            try {
                $user->update(array(
                    'username' => escape(input::get('username')),
                ));
                echo "Username update successfully";
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }

    }
}

function emailupdate2()
{
    global $user;
    if (input::exists()) {

        $validate = new validate();
        $validation = $validate->check($_POST, array(
            'email' => array(
                'required' => true,
                'unique' => 'users',
            ),
            'email_again' => array(
                'required' => true,
                'matches' => 'email',
            ),
        ));

        if ($validation->passed()) {

            $user->update(array(
                'email' => escape(input::get('email')),
            ));
            echo "Email update successfully";

        } else {
            foreach ($validation->errors() as $error) {
                echo $error, "<br>";
            }
        }

    }
}
