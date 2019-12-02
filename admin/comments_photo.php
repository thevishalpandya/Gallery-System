<?php include("includes/header.php"); ?>

<?php  if(!$session->is_signed_in()){
    redirect("login.php");
} ?>

<?php

if(empty($_GET["id"])){
    
    redirect("photos.php");
    
}

$comments = Comment::find_the_comment($_GET["id"]);

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
                            Comment
                            <small></small>
                        </h1>
                        
                        <p class="bg-success"><?php echo $message; ?></p>
                        
                        <div class="col-md-12">
                            <table class = "table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>AUTHOR</th>
                                        <th>BODY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php foreach($comments as $photo) : ?>
                                    <tr>
                                         
                                        
                                        <td><?php echo $photo->id; ?></td>
                                        <td><?php echo $photo->author; ?>
                                        
                                        <div class="action_links">
                                            <a href = "delete_comment_photo.php?id=<?php echo $photo->id ?>">Delete</a>
                                            </div></td>
                                        <td><?php echo $photo->body; ?></td>
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