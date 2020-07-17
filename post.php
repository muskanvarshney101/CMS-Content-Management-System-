<?php include "includes/header.php";?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php

            if(isset($_GET['p_id']))
            {
                $post_id=$_GET['p_id'];

                $view_query ="UPDATE `post` SET post_view_count =post_view_count+1 WHERE post_id=$post_id";
                $send_query= mysqli_query($conn,$view_query);
                
                if(isset($_SESSION['role']) && $_SESSION['role']=='Admin')
                {
                    $query = "SELECT * FROM `post`  WHERE post_id=$post_id ";
                }
                else{
                    $query = "SELECT * FROM `post`  WHERE post_id=$post_id AND post_status='Published'";
                }
        
                
                $select_all_post= mysqli_query($conn,$query);
                $post=mysqli_num_rows($select_all_post);
                if(mysqli_num_rows($select_all_post)<1)
            {
                echo " <h1 class='text-center'><b>No Post available</b></h1>";
            }
            else
            {
                while($row= mysqli_fetch_assoc($select_all_post)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author']; 
                    $post_date = $row['post_date']; 
                    $post_image = $row['post_image']; 
                    $post_content= $row['post_content']; 
                    $post_tag= $row['post_tags']; 

                    ?>
                <h1 class="page-header">
                    Posts
                    
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?> </p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>


                <?php
                }
            
    if(isset($_POST['create_comment']))
    {
        $post_id=$_GET['p_id'];
        $comment_author=trim($_POST['comment_author']);
        $comment_email=trim($_POST['comment_email']);
        $comment_content=trim($_POST['comment_content']);
        $comment_content=mysqli_real_escape_string($conn,$comment_content);


        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) )
        {
            $query="INSERT INTO `comment` (comment_author,comment_email,comment_date,comment_content,comment_post_id,comment_status) VALUES('$comment_author','$comment_email',now(),'$comment_content',$post_id,'Unaproved')";
            $comment_query = mysqli_query($conn,$query);
            if(!$comment_query)
            {
                die("Query Failed".mysqli_error($conn));
            }
            // $query =  "UPDATE `post` SET post_comment_count= post_comment_count + 1 WHERE post_id=$post_id ";
        
            // $update_comment_count=mysqli_query($conn,$query);
        
        
            
        
        }
        else
        {

    ?>
    <script>
        alert('Fields connot be empty');
        
    </script>
    <?php

        }   
    }
?>
<div class="well">

                <h4>Leave a Comment:</h4>
                <form role="form" action="" method="post">
                <div class="form-group">
                <label for="post_title">Author</label>
                <input type="text" class="form-control" name="comment_author" required>
                    </div>
                    <div class="form-group">
                    <label for="post_title">Email</label>
                    <input type="email" class="form-control"  name="comment_email" required>
                    </div>
                    <div class="form-group">
                    <label for="post_title">content</label>
                        <textarea class="form-control" rows="3" name="comment_content" required></textarea>
                    </div>
                    
                    <button type="submit"  name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

<?php
            
$query = "SELECT * FROM `comment`  WHERE comment_post_id= $post_id  AND comment_status='Approved' ORDER BY comment_id DESC";
$select_all_comment= mysqli_query($conn,$query);
while($row= mysqli_fetch_assoc($select_all_comment))
{
        $comment_id=$row['comment_id'];
        $comment_author = $row['comment_author'];
        $comment_date = $row['comment_date']; 
        $comment_content = $row['comment_content']; 
        ?>
        <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;?>
                            <small><?php echo $comment_date;?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

                <?php

            
}
}
            }
else
{
    header("Location:index.php");
}
    ?>

<?php
?>
            


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"?>