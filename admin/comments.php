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

$comments = Comment::find_all();

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
                            All Comments
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
                                    <?php foreach($comments as $comment) : ?>
                                    <tr>
                                        <td><?php echo $comment->id; ?></td>
                                        <td><?php echo $comment->author. "<br>"; ?>
                                            
                                            <div class = "action_links">
                                             <a href = "delete_comment.php?id=<?php echo $comment->id ?>">  Delete</a>
                                            </div>
                                        </td>
                                        <td><?php echo $comment->body; ?></td>
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