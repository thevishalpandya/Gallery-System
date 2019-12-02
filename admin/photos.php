<?php include("includes/header.php"); ?>

<?php  if(!$session->is_signed_in()){
    redirect("login.php");
} ?>

<?php

$photos = Photo::find_all();

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
                            Photo
                            <small></small>
                        </h1>
                        
                         <p class="bg-success"><?php echo $message; ?></p>
                        
                        <div class="col-md-12">
                            <table class = "table table-hover">
                                <thead>
                                    <tr>
                                        <th>PHOTO</th>
                                        <th>ID</th>
                                        <th>FILE NAME</th>
                                        <th>TITLE</th>
                                        <th>SIZE</th>
                                        <th>COMMENTS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($photos as $photo) : ?>
                                    <tr>
                                        <td><img class = "admin-photo-thumbnail" src = "<?php echo $photo->picture_path(); ?>" alt="">
                                        <div class="action_links">
                                            <a href = "delete_photo.php?id=<?php echo $photo->id ?>">Delete</a>
                                            <a href = "edit_photo.php?id=<?php echo $photo->id ?>">Edit</a>
                                            <a href = "../photo.php?id=<?php echo $photo->id ?>">View</a>
                                            </div> 
                                        </td>
                                        <td><?php echo $photo->id; ?></td>
                                        <td><?php echo $photo->filename; ?></td>
                                        <td><?php echo $photo->title; ?></td>
                                        <td><?php echo $photo->size; ?></td>
                                         <td>
                                             <a href = "comments_photo.php?id=<?php echo $photo->id ?>">
                                             <?php
                                             
                                             $comments = Comment::find_the_comment($photo->id);
                                             
                                             echo count($comments);
                                              ?>
                                             
                                             </a>
                                             
                                            
                                        </td>
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