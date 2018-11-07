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
if(isset($_POST['offset']))
{
    usernameupdate();
}
if(isset($_POST['offset']))
{
    emailupdate();
}
if(isset($_POST['offset']))
{
    passwordupdate();
}


function homegallery()
{
    $db = DB::getInstance();
    $db->query("SELECT * FROM gallery ORDER BY time_stamp DESC LIMIT ".$_POST['limit']." OFFSET ".$_POST['offset']);
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo json_encode($images);
}

//count images
function imgCount()
{
    $db = DB::getInstance();
    $db->query("SELECT * FROM gallery");
    $images = $db->results();
    $num_images = $db->count() - 1;
    echo intval($num_images); 
}



?>