<?php
include "core/init.php";
$user = new user();

if(isset($_POST['img_page']))
{
    homegallery();
}
if(isset($_POST['picCounter']))
{
    imgCount();
}
if(isset($_POST['offset']))
{
    homegallery();
}

function homegallery()
{
    $db = DB::getInstance();
   // $db->get("gallery",array('user_id', '=', $user->data()->user_id));
    $db->query("SELECT * FROM gallery ORDER BY time_stamp ASC LIMIT ".$_POST['limit']." OFFSET ".$_POST['offset']);
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo json_encode($images);
/* 
    for ($i=0; $i <= $num_images; $num_images--) { 
        $img = $images[$num_images]->img_name;
        $imgid = $images[$num_images]->img_id;
        echo "<img src='$img' style='margin: 5px; margin-bottom: 1px; margin-top: 1px' data-id='".$imgid."'>";
    }  */
}

//count images
function imgCount()
{
    $db = DB::getInstance();
   // $db->get("gallery",array('user_id', '=', $user->data()->user_id));
    $db->query("SELECT * FROM gallery");
    $images = $db->results();
    //var_dump($images);
    $num_images = $db->count() - 1;
    echo intval($num_images); 
}



?>