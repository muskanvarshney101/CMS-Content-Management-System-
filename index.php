<?php include "includes/header.php";?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            $per_page=2;

            if(isset($_GET['page'])){
                
                $page=$_GET['page'];

            }else{

                $page="";
            }

            if($page=="" || $page==1){
                $page_1=0;

            }
            else{
                $page_1=($page * $per_page)-$per_page;
            }

            if(isset($_SESSION['role']) && $_SESSION['role']=='Admin')
                {
                    $post_query_count="SELECT * FROM `post`";
                }
                else{
                    $post_query_count="SELECT * FROM `post` WHERE post_status='Published'";
                }

           
            $find_count= mysqli_query($conn,$post_query_count);
            $count= mysqli_num_rows($find_count);

            if($count< 1)
            {
                echo " <h1 class='text-center'><b>No Post available</b></h1>";
            }
            else{

            
            $count = ceil($count/$per_page);





            $query = "SELECT * FROM `post` WHERE post_status='Published' LIMIT $page_1, $per_page";
            $select_all_post= mysqli_query($conn,$query);
            $select_post_query =mysqli_num_rows($select_all_post);
            if($select_post_query>0){
                while($row= mysqli_fetch_assoc($select_all_post)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user']; 
                    $post_date = $row['post_date']; 
                    $post_image = $row['post_image']; 
                    $post_content= substr($row['post_content'] ,0,100); 
                    $post_tag= $row['post_tags']; 
    
                    ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
    
                <!-- First Blog Post -->
                <h1><?php echo $count ?></h1>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ;?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id;?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?> </p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ;?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
    
                <hr>
    
    
                <?php
                }
            }
        }
            
            
            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"?>

    </div>
    <!-- /.row -->

    <hr>

    <ul class="pager">
    <?php 
    
    for($i=1;$i<=$count;$i++){

        if($i == $page){

            ?>
        <li><a class="active_link" href='index.php?page=<?php echo $i ;?>'><?php echo  $i ?></a></li>
        <?php

        }
        else{

            ?>
        <li><a href='index.php?page=<?php echo $i ;?>'><?php echo  $i ?></a></li>
        <?php

        }
        
    }
    ?>
    
    
    </ul>


    <?php include "includes/footer.php"?>