<?php

if(isset($_POST['checkBoxArray'])){
    
    foreach($_POST['checkBoxArray'] as $post_value_id){
        $bluk_option=$_POST['bluk_option'];
       switch($bluk_option){

        case'Published':
            $query ="UPDATE `post` SET post_status='$bluk_option' WHERE post_id='$post_value_id' " ;

            $update_published_status=mysqli_query($conn,$query);


        break;

        case'draft':
            $query ="UPDATE `post` SET post_status='$bluk_option' WHERE post_id='$post_value_id' " ;

            $update_draft_status=mysqli_query($conn,$query);

            
        break;
        case'clone':
            $query ="SELECT * FROM `post` WHERE post_id=$post_value_id";
                        $select_all_post = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($select_all_post)){
                            $post_id=$row['post_id'];
                            $post_category_id=$row['post_category_id'];
                            $post_author=$row['post_author'];
                            $post_status=$row['post_status'];
                            $post_image=$row['post_image'];
                            $post_tags=$row['post_tags'];
                            $post_date=$row['post_date'];
                            $post_title=$row['post_title'];
                            $post_content=$row['post_content'];
                            $post_content=mysqli_real_escape_string($conn,$post_content);
                        }
           $query ="INSERT INTO `post`(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) VALUES('$post_category_id','$post_title','$post_author',now(),'$post_image','$post_content','$post_tags','$post_status')";

     $copy_query=mysqli_query($conn,$query);
     confirm($copy_query);
                            
            
        break;
        case'delete':


            $query = "DELETE FROM `post` WHERE post_id='$post_value_id'";
            $delete_query = mysqli_query($conn,$query);
            if(!$delete_query){
                die("Query Failed".mysqli_error($conn));
            }
           else{
               ?>
               <script>
               alert("Post Deleted");
               window.open('posts.php','_self');
               </script>
               <?php
           }

            
        break;
       }


    }
    
}


?>
<form action="" method='post'>
<table class="table table-bordered table-hover">

<div id="bulkOptionsContainer" class="col-xs-4"style="
    padding-left: 0px;">


<select class= "form-control" name="bluk_option" id="">

<option value="">Select Option</option>
<option value="Published">Published</option>
<option value="draft">Draft</option>
<option value="delete">Delete</option>
<option value="clone">Clone</option>
</select>


</div>

<div class="col-xs-4">

<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
</div>


                        <thead>
                            <tr>
                            <th><input type="checkbox" id="selectAllBoxes"></th>
                                <th>Id</th>
                                <th>User</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Date</th>
                                <th>View Post</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php
                        $query ="SELECT * FROM `post` ORDER BY post_id DESC";
                        $select_all_post = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($select_all_post)){
                            $post_id=$row['post_id'];
                            $post_category_id=$row['post_category_id'];
                            $post_author=$row['post_author'];
                            $post_user=$row['post_user'];
                            $post_status=$row['post_status'];
                            $post_image=$row['post_image'];
                            $post_tags=$row['post_tags'];
                            $post_comment=$row['post_comment_count'];
                            $post_date=$row['post_date'];
                            $post_title=$row['post_title'];
                            $post_view_count=$row['post_view_count'];
                            
                           echo"<tr>";
                           ?>
                           
                           <td><input class="checkBoxes" type='checkbox' id="selectAllBoxes" name="checkBoxArray[]" value='<?php echo $post_id;?>'></td>


                           <?php
                            echo"<td> $post_id </td>";

                            if(!empty($post_author))
                            {
                                echo"<td> $post_author </td>";
                            }
                            elseif(!empty($post_user))
                            {
                                echo"<td> $post_user </td>";
                            }
                            




                            echo"<td>$post_title </td>";
                            
                            $query="SELECT * FROM `categories` WHERE cat_id ='$post_category_id'";
                            $select_category_id = mysqli_query($conn,$query);
                            while($row = mysqli_fetch_assoc($select_category_id)){
                                $cat_id=$row['cat_id'];
                                $cat_title=$row['cat_title'];
                                echo"<td>$cat_title</td>";
                            }
                           
                            echo"<td> $post_status </td>";
                             
                             echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
                            echo"<td> $post_tags </td>";

                            $query_comment = "SELECT * FROM `comment` WHERE comment_post_id =$post_id";
                            $comment_query= mysqli_query($conn,$query_comment);
                            $count_comment = mysqli_num_rows($comment_query);
                            
                            echo"<td><a href ='./post_comments.php?id=$post_id'>$count_comment</a></td>";
                            echo"<td>$post_date </td>";
                            
                             echo"<td><a href='../post.php?p_id=$post_id'>View Post</a></td>";
                             echo"<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
                             
                             echo"<td><a onClick=\"javascript:return confirm('are you sure you want to Delete');\" href='posts.php?delete=$post_id'>Delete</a></td>";
                             echo"<td><a href='posts.php?reset=$post_id'> $post_view_count </a></td>";
                             
                        echo"</tr>";
                       

                        }?>
                        
                    </tbody>
                    </table>
                    </form>


                    <?php
                    if(isset($_GET['delete'])){
                    $the_post_id=$_GET['delete'];
                    $query = "DELETE FROM `post` WHERE post_id='$the_post_id'";
                    $delete_query = mysqli_query($conn,$query);
                    if(!$delete_query){
                        die("Query Failed".mysqli_error($conn));
                    }
                   else{
                       ?>
                       <script>
                       alert("Post Deleted");
                       window.open('posts.php','_self');
                       </script>
                       <?php
                   }
                    }
                    
                    ?>
                    <?php
                    if(isset($_GET['reset'])){
                    $the_post_view=$_GET['reset'];
                    $query = "UPDATE `post` SET post_view_count=0 WHERE post_id=".mysqli_real_escape_string($conn,$_GET['reset'])."";
                    $set_query = mysqli_query($conn,$query);
                    if(!$set_query){
                        die("Query Failed".mysqli_error($conn));
                    }
                   header("Location:posts.php");
                    }
                    
                    ?>
                   
                    