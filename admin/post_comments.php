<?php include "includes/header.php";?>

<div id="wrapper">

    <!-- Navigation -->
    <?php  include "includes/navigation.php";?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['username'];?></small>
                    </h1>
                    <?php
                    if(isset($_GET['id'])){
                        $post_id=$_GET['id'];
                    }
                    ?>
                    <?php

if(isset($_POST['checkBoxArray'])){
    
    foreach($_POST['checkBoxArray'] as $comment_value_id){
        $bluk_option=$_POST['bluk_option'];
       switch($bluk_option){

        case'Approved':
            $query ="UPDATE `comment` SET comment_status='$bluk_option' WHERE comment_id='$comment_value_id' " ;

            $update_Approved_status=mysqli_query($conn,$query);


        break;

        case'Unapproved':
            $query ="UPDATE `comment` SET comment_status='$bluk_option' WHERE comment_id='$comment_value_id' " ;

            $update_unApproved_status=mysqli_query($conn,$query);

            
        break;

        case 'delete':
            $query = "DELETE FROM `comment` WHERE comment_id = '$comment_value_id'";
            $delete_query =mysqli_query($conn,$query);
            if(!$delete_query){
                die("Query Failed".mysqli_error($conn));
            }
           else{
               ?>
               <script>
               alert("Post Deleted");
               </script>
               <?php
           }
        
       }


    }
    
}


?>
<form action="" method="post">
<table class="table table-bordered table-hover">
<div id="bulkOptionsContainer" class="col-xs-4"style="
    padding-left: 0px;">


<select class= "form-control" name="bluk_option" id="">

<option value="">Select Option</option>
<option value="Approved">Approved</option>
<option value="Unapproved">Unapproved</option>
<option value="delete">Delete</option>

</select>


</div>
<div class="col-xs-4">

<input type="submit" name="submit" class="btn btn-success" value="Apply">
</div>
                        <thead>
                            <tr>
                            <th><input type="checkbox" id="selectAllBoxes"></th>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comments</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>status</th>
                                <th>In Response to</th>
                                <th>Approved</th>
                                <th>Unapproved</th>
                                <th>Delete</th>
                            
                            </tr>
                        </thead>
                        <tbody>


                        <?php
                        $query ="SELECT * FROM `comment` WHERE comment_post_id =$post_id";
                        $select_all_post = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($select_all_post)){
                            $comment_id=$row['comment_id'];
                            $comment_post_id=$row['comment_post_id'];
                            $comment_author=$row['comment_author'];
                            $comment_status=$row['comment_status'];
                            $comment_email=$row['comment_email'];
                            $comment_date=$row['comment_date'];
                            $comment_content=$row['comment_content'];
                           
                           echo"<tr>";
                           ?>
                           <td><input class="checkBoxes" type='checkbox' id="selectAllBoxes" name="checkBoxArray[]" value='<?php echo $comment_id;?>'></td>
                           <?php
                            echo"<td> $comment_id </td>";
                            echo"<td> $comment_author </td>";
                            echo"<td> $comment_content </td>";
                            echo"<td>$comment_email </td>";
                            
                            echo"<td>$comment_date </td>";
                            echo"<td> $comment_status </td>";
                             
                            
                            $query="SELECT * FROM `post` WHERE post_id ='$comment_post_id'";
                            $select_post_id = mysqli_query($conn,$query);
                            while($row = mysqli_fetch_assoc($select_post_id)){
                                $post_id=$row['post_id'];
                                $post_title=$row['post_title'];
                                echo"<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                            }
                           
                            
                            //  echo "<td><img width='100' src='../images/$comment_status' alt='image'></td>";
                            

                            echo"<td><a href='post_comments.php?approved=$comment_id&id=".$_GET['id']."'>Approved</a></td>";          
                            echo"<td><a href='post_comment.php?unapproved=$comment_id&id=".$_GET['id']."'>Unapproved</a></td>";    
                        echo"<td><a onClick=\"javascript:return confirm('are you sure you want to Delete');\" href='post_comments.php?delete=$comment_id&id=".$_GET['id']."'>Delete</a></td>";
                             
                        echo"</tr>";
                       

                        }?>
                        
                        
                    </tbody>
                    </table>
                    </form>

                    <?php
                    if(isset($_GET['approved'])){
                    $the_comment_id=$_GET['approved'];
                    $query = "UPDATE `comment` SET comment_status='Approved' WHERE comment_id='$the_comment_id'";
                    $status_approved_query = mysqli_query($conn,$query);
                    if(!$status_approved_query){
                        die("Query Failed".mysqli_error($conn));
                    }
                    header("Location:post_comments.php?id=".$_GET['id']."");
                    }
                    
                    ?>

<?php
                    if(isset($_GET['unapproved'])){
                    $the_comment_id=$_GET['unapproved'];
                    $query = "UPDATE `comment` SET comment_status='Unapproved' WHERE comment_id='$the_comment_id'";
                    $status_unapproved_query = mysqli_query($conn,$query);
                    if(!$status_unapproved_query){
                        die("Query Failed".mysqli_error($conn));
                    }
                    header("Location:post_comments.php?id=".$_GET['id']."");
                    }
                    
                    ?>


                   

                    <?php
                    if(isset($_GET['delete'])){
                    $the_comment_id=$_GET['delete'];
                    $query = "DELETE FROM `comment` WHERE comment_id='$the_comment_id'";
                    $delete_query = mysqli_query($conn,$query);
                    if(!$delete_query){
                        die("Query Failed".mysqli_error($conn));
                    }
                   header("Location:post_comments.php?id=".$_GET['id']."");
                    }
                    
                    ?>
                     </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/footer.php" ;?>
                    