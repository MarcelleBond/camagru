<?php
    require_once "core/init.php";
    $db = DB::getInstance();
    $user = new user();
    $imgnum = $db->get("gallery",array('user_id', '=', $user->data()->user_id));
    $img_id = $imgnum->count() + 1;
    $data = explode( ',', $_POST["img64"] );
    $emo = $_POST["emoji64"];
    $test = base64_decode($data[1]);
//try imgcreate
    $user_id = $user->data()->user_id;
    file_put_contents("images/gallary/"."user_".$user_id."_image_".$img_id.'.png', $test);

    $dest= imagecreatefrompng("images/gallary/"."user_".$user_id."_image_".$img_id.'.png');

    $src = imagecreatefrompng($emo);
    $width = ImageSx($src);

    $height = ImageSy($src);
    $x = $width/4; $y = $height/4;
    ImageCopyResampled($dest,$src,0,0,0,0,$x,$y,$width,$height);
    imagepng($dest, 'images/gallary/'."user_".$user_id."_image_".$img_id.'.png');
    $db->insert('gallery', array(
        'img_name' => 'images/gallary/'."user_".$user_id."_image_".$img_id.'.png',
        'user_id' => $user_id
    ));
    redirect::to("new.php");


?>