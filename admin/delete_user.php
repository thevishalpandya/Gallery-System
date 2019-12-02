<?php include("includes/init.php"); ?>

<?php if(!$session->is_signed_in()){
    redirect("login.php");
}
?>

<?php
if(empty($_GET["id"])){
    
    redirect("../admin/users.php");
    
}

$user = User::find_by_id($_GET["id"]);

if($user){
    $session->message("The {$user->username} has been deleted");
    
    $user->delete_user();
    redirect("../admin/users.php");
    
}else{
    
    redirect("../admin/users.php");
    
}
?>
