<?php require_once("init.php"); ?>

<?php


$user = new User();

if(isset($_POST["image_name"])){
    
    $user->ajax_image_save($_POST["image_name"],$_POST["user_id"]);
    
}

if(isset($_POST["photo_id"])){
    
    Photo::display_sidebar_data($_POST["photo_id"]);
    
}

?>