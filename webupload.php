<?php
    require_once "core/init.php";
    //var_dump($_SESSION);
     $db = db::getInstance();
     $user = new user();
    $imgnum = $db->get("gallery",array('user_id', '=', $user->data()->user_id));
    $data = explode( ',', $_POST["img64"] );
    $emo = $_POST['emoji64'];
    $test = base64_decode($data[1]);
//try imgcreate
    $user_id = $user->data()->user_id;
    // $img_id = $imgnum->first()->img_id;
    file_put_contents("images/gallary/".$user_id."1.png", $test);
    $dest= imagecreatefrompng("images/gallary/".$user_id."1.png");

    $src = imagecreatefrompng($emo);
    imagecopymerge($dest, $src, 10, 10, 0, 0, 100, 47, 75);
//    echo "<img src=".$emo."><br>";
    // header('Content-Type: image/png');
    // imagepng($dest);
    imagejpeg($dest, 'images/gallary/'.$user_id.'2.png');

    //file_put_contents("images/gallary/".$user_id."2.png", imagecopymerge($src, $dest, 10, 10, 0, 0, 100, 47, 75));
   // echo imagepng($dest);

?>