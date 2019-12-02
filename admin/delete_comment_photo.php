<?php include("includes/init.php"); ?>

<?php if(!$session->is_signed_in()){
    redirect("login.php");
}
?>

<?php
if(empty($_GET["id"])){
    
    redirect("comments_photo.php");
    
}

$comment = Comment::find_by_id($_GET["id"]);

if($comment){
    $session->message("the comment of photo with id {$comment->photo_id} has been deleted");
    
    $comment->delete();
    redirect("comments_photo.php?id={$comment->photo_id}");
    
}else{
    
    redirect("comments_photo.php?id={$comment->photo_id}");
    
}
?>
