<?php include "includes/header.php";?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php

            if(isset($_GET['p_id'])){
                
                $post_id=$_GET['p_id'];
                $post_author=$_GET['author'];
              
                $post_author;
            }
            $query = "SELECT * FROM `post`  WHERE post_user='$post_author'";
            $select_all_post= mysqli_query($conn,$query);
            while($row= mysqli_fetch_assoc($select_all_post)){
                $post_title = $row['post_title'];
                $post_author = $row['post_user']; 
                $post_date = $row['post_date']; 
                $post_image = $row['post_image']; 
                $post_content= $row['post_content']; 
                $post_tag= $row['post_tags']; 

                ?>
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
            all post by <a href="index.php"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?> </p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>
            <hr>


            <?php
            }
            ?>




        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"?>