<!--<head>
    <style>
    <link href="css/styles2.css" rel="stylesheet">
    </style>
</head>-->

<?php include("includes/header.php"); ?>

<?php  if(!$session->is_signed_in()){
    redirect("login.php");
} ?>

<?php

$Users = User::find_all();

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
                        
                        <p class="bg-success"><?php echo $message; ?></p>  
                        
                        <a class="btn btn-primary" href="add_user.php">Add User</a>
                        
                        <div class="col-md-12">
                            <table class = "table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PHOTO</th>
                                        <th>USERNAME</th>
                                        <th>FIRST_NAME</th>
                                        <th>LAST_NAME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($Users as $User) : ?>
                                    <tr>
                                        <td><?php echo $User->id; ?></td>
                                        <td><img class = "admin-user-thumbnail user-image" src = "<?php echo $User->image_path_and_placeholder(); ?>" alt=""></td>
                                        <td><?php echo $User->username. "<br>"; ?>
                                            
                                            <div class = "action_links">
                                             <a href = "delete_user.php?id=<?php echo $User->id ?>">  Delete</a>
                                            <a href = "edit_user.php?id=<?php echo $User->id ?>">Edit</a>
                                            </div>
                                        </td>
                                        <td><?php echo $User->first_name; ?></td>
                                        <td><?php echo $User->last_name; ?></td>
                                    </tr>
                                    <?php endforeach ;?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

            
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>