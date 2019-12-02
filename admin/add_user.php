<?php include("includes/header.php"); ?>

<?php  if(!$session->is_signed_in()){
    redirect("login.php");
} ?>

<?php

    
$user = new User();

    
  if(isset($_POST["create"])){
      
      
      
      if($user){
          
         $user->username = $_POST["username"];
          $user->first_name = $_POST["firstname"];
          $user->last_name = $_POST["lastname"];
          $user->password = $_POST["password"];
          
          $user->set_file($_FILES["user_image"]);
          
          $user->upload_photo();
          $session->message("the User {$user->username} has been added");
          $user->save();
          redirect("users.php");
          
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
                        
                        
                        <form action="" method="post" enctype="multipart/form-data">
                        
                        <div class="col-md-6 col-md-offset-3">
                            
                            <div class="form-group">
                            <input type="file" name = "user_image">
                            </div>
                            
                            <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name = "username" class="form-control">
                            </div>
                            
                            <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name = "firstname" class="form-control">
                            </div>
                            
                            <div class="form-group">
                            <label for="lastname">Last Name</label>
                                <input type="text" name = "lastname" class="form-control">
                            </div>
                            
                            <div class="form-group">
                            <label for="password">Password</label>
                                <input type="password" name = "password" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" name = "create" class="btn btn-primary pull-right">
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