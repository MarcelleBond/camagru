<?php
    require_once "core/init.php";
    //var_dump($_SESSION);
     $db = db::getInstance();
     $user = new user();
    $imgnum = $db->get("gallery",array('user_id', '=', $user->data()->user_id));
    $data = explode( ',', $_POST["img64"] );
    $emo = $_POST["emoji64"]; //explode( '/', $_POST["emoji64"] );
    $test = base64_decode($data[1]);
//try imgcreate
    $user_id = $user->data()->user_id;
    file_put_contents("images/gallary/".$user_id."1.png", $test);

    $dest= imagecreatefrompng("images/gallary/".$user_id."1.png");

    $src = imagecreatefrompng($emo);
    $width = ImageSx($src);

    $height = ImageSy($src);
    $x = $width/4; $y = $height/4;
    ImageCopyResampled($dest,$src,0,0,0,0,$x,$y,$width,$height);
    imagepng($dest, 'images/gallary/'.$user_id.'2.png');


?>