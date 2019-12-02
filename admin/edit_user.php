<?php ob_start();?>
<?php include("includes/header.php"); ?>

<?php include("includes/photo_library_modal.php"); ?>

<?php  if(!$session->is_signed_in()){
    redirect("login.php");
} ?>

<?php

    
if(empty($_GET["id"])){
    
    redirect("users.php");
    
}
    
  $user = User::find_by_id(($_GET["id"]));
 
  if(isset($_POST["update"])){
      
      
      
      if($user){
          
         $user->username = $_POST["username"];
          $user->first_name = $_POST["firstname"];
          $user->last_name = $_POST["lastname"];
          $user->password = $_POST["password"];
          
          if(empty($_FILES["user_image"])){
            $user->save();
            redirect("users.php");
            $session->message("The {$user->username} has been updated");
              
              
          }else{
             
            $user->set_file($_FILES["user_image"]);
              
            $user->save_user_and_photo();
               
            $user->save();
              
            redirect("users.php");
              
            $session->message("The {$user->username} has been updated");
             
        
          }   
      }
}
?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            <?php include("includes/top_nav.php")?>
            
            <?php include("includes/side_nav.php")?>
            
        </nav>

        <div id="page-wrapper">

         <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            User
                            <small></small>
                        </h1>
                        
                        <div class="col-md-6 user_image_box">
                            <a href="#" data-toggle = "modal" data-target = "#photo-library"><img class="img-responsive" src = "<?php echo $user->image_path_and_placeholder(); ?>" alt = ""></a>
                        </div>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                        
                        <div class="col-md-6">
                            
                            <div class="form-group">
                            <input type="file" name = "user_image">
                            </div>
                            
                            <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name = "username" class="form-control" value="<?php echo $user->username; ?>">
                            </div>
                            
                            <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name = "firstname" class="form-control" value="<?php echo $user->first_name; ?>">
                            </div>
                            
                            <div class="form-group">
                            <label for="lastname">Last Name</label>
                                <input type="text" name = "lastname" class="form-control" value="<?php echo $user->last_name; ?>">
                            </div>
                            
                            <div class="form-group">
                            <label for="password">Password</label>
                                <input type="password" name = "password" class="form-control" value="<?php echo $user->password; ?>">
                            </div>
                            
                            <div class="form-group">
                                <a id = "user-id" href="delete_user.php?id=<?php echo $user->id;?>" class="btn btn-danger">Delete</a>
                                <input type="submit" name = "update" class="btn btn-primary pull-right" value="Update">
                            </div>
                            
                        </div>
                        
                    </form>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

            
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>