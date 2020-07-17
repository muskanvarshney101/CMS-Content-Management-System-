<?php include "includes/header.php";?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php

            if(isset($_GET['cat_id'])){
                
                $cat_id=$_GET['cat_id'];

                if(isset($_SESSION['role']) && $_SESSION['role']=='Admin')
                {
                    $query = "SELECT * FROM `post`  WHERE post_category_id='$cat_id' ";
                }
                else{
                    $query = "SELECT * FROM `post`  WHERE post_category_id='$cat_id' AND post_status='Published'";
                }
            
           
            $select_all_post= mysqli_query($conn,$query);
            if(mysqli_num_rows($select_all_post)<1)
            {
                echo " <h1 class='text-center'><b>No Post available</b></h1>";
            }
            else
            {
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
            <a href="index.php"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?> </p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>
            <hr>


            <?php
            }
        }
        }
        else{
            header("Location:index.php");
        }
            ?>




        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"?>