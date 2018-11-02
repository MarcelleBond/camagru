<?php
    require_once "core/init.php";

    $x;
    $y;
    $pos1;
    $pos2;

    $db = DB::getInstance();
    $user = new user();
    $imgnum = $db->get("gallery",array('user_id', '=', $user->data()->user_id));
    $img_id = $imgnum->count() + 1;
    $data = explode( ',', $_POST["img64"] );
    $emo = $_POST["emoji64"];
    $test = base64_decode($data[1]);
    echo $test;
    $user_id = $user->data()->user_id;
    file_put_contents("images/gallary/user_".$user_id."_image_".$img_id.".png", $test);
    $dest= imagecreatefrompng("images/gallary/user_".$user_id."_image_".$img_id.".png");

    $src = imagecreatefrompng($emo);
    $width = ImageSx($src);

    $height = ImageSy($src);
    
    function pic_position($emo)
    {
        global $x, $y, $width, $height, $pos1, $pos2;

        switch ($emo)
        {
            case "http://localhost:8080/camagru/images/emojis/emoj_1.png" :
                $pos1 = 10;
                $pos2 = 10;
                $x = $width/5; $y = $height/5;
                break;
            case "http://localhost:8080/camagru/images/emojis/emoj_2.png" :
                $pos1 = 10;
                $pos2 = 200;
                $x = $width/5; $y = $height/5;
                break;
            case "http://localhost:8080/camagru/images/emojis/emoj_3.png" :
                $pos1 = 10;
                $pos2 = 400;
                $x = $width/5; $y = $height/5;
                break;
            case "http://localhost:8080/camagru/images/emojis/emoj_4.png" :
                $pos1 = 100;
                $pos2 = 10;
                $x = $width/5; $y = $height/5;
                break;
            case "http://localhost:8080/camagru/images/emojis/emoj_5.png" :
                $pos1 = 100;
                $pos2 = 200;
                $x = $width/5; $y = $height/5;
                break;
            case "http://localhost:8080/camagru/images/emojis/emoj_6.png" :
                $pos1 = 100;
                $pos2 = 400;
                $x = $width/4; $y = $height/4;
                break;
            case "http://localhost:8080/camagru/images/emojis/emoj_7.png" :
                $pos1 = 250;
                $pos2 = 10;
                $x = $width/4; $y = $height/4;
                break;
            case "http://localhost:8080/camagru/images/emojis/emoj_8.png" :
                $pos1 = 250;
                $pos2 = 200;
                $x = $width/5; $y = $height/5;
                break;
            case "http://localhost:8080/camagru/images/emojis/emoj_9.png" :
                $pos1 = 250;
                $pos2 = 390;
                $x = $width/6; $y = $height/6;
                break;
            case "http://localhost:8080/camagru/images/emojis/emoj_10.png" :
                $pos1 = 100;
                $pos2 = 200;
                $x = $width/5; $y = $height/5;
                break;
        }
    }
    pic_position($emo);
    echo $x;
    ImageCopyResampled($dest,$src,$pos2,$pos1,0,0,$x,$y,$width,$height);
    if(!empty($_POST["emoji64_2"]))
    {
        $emo2 = $_POST["emoji64_2"];

        $src = imagecreatefrompng($emo2);
        $width = ImageSx($src);

        $height = ImageSy($src);
        pic_position($emo2);
        ImageCopyResampled($dest,$src,$pos2,$pos1,0,0,$x,$y,$width,$height);
    }
    imagepng($dest, "images/gallary/user_".$user_id."_image_".$img_id.".png");

    $db->insert('gallery', array(
        'img_name' => 'images/gallary/'."user_".$user_id."_image_".$img_id.'.png',
        'user_id' => $user_id
    ));
    // redirect::to("newpic.php"); 


?>