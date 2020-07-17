<?php

if(isset($_POST['submit'])){
    $post_title=escape($_POST['post_title']);
    $post_author=escape($_POST['author']);
    $post_user=escape($_POST['post_user']);
    $post_category=escape($_POST['post_cat_id']);
    $post_status=escape($_POST['status']);

    $post_image=$_FILES['file']['name'];
    $post_image_temp=$_FILES['file']['tmp_name'];
    

    $post_tags=escape($_POST['tags']);
    $post_Content=$_POST['post_content'];
    $post_Content=mysqli_real_escape_string($conn,$post_Content);
    $post_date=date('d-m-y');
    // $post_comment_count=4;

    move_uploaded_file($post_image_temp,"../images/$post_image");
    
    $query ="INSERT INTO `post`(post_category_id,post_title,post_author,post_user,post_date,post_image,post_content,post_tags,post_status) VALUES('$post_category','$post_title','$post_author','$post_user',now(),'$post_image','$post_Content','$post_tags','$post_status')";

     $create_all_post=mysqli_query($conn,$query);
     confirm($create_all_post);
     $post_id=mysqli_insert_id($conn);
     echo"<p class='bg-success'>Post Created. <a href='../post.php?p_id=$post_id'>View Post and </a><a href='posts.php'> Edit more post</a></p>";
 



}
?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" class="form-control" name="post_title">
  </div>
  <div class="form-group">
    <label for="post_cat">Category</label>
    <select name="post_cat_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
    <?php
    
                        $query = "SELECT * FROM `categories`";
                        $Edit_category_query = mysqli_query($conn,$query);
                        confirm($Edit_category_query);
                       while($array1= mysqli_fetch_assoc($Edit_category_query)){
                           $cat_id =$array1['cat_id'];
                           $cat_title =$array1['cat_title'];
                           echo"<option value='$cat_id'>$cat_title</option>";
                       }
    ?>
    </select>
    <!-- <input type="text" class="form-control" name="post_cat_id"> -->
  </div>
  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="author">
  </div>
  <div class="form-group">
    <label for="post_cat">User</label>
    <select name="post_user" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
    <?php
    
                        $query = "SELECT * FROM `user`";
                        $Edit_user_query = mysqli_query($conn,$query);
                        confirm($Edit_user_query);
                       while($array1= mysqli_fetch_assoc($Edit_user_query)){
                           $user_id =$array1['user_id'];
                           $username =$array1['username'];
                           echo"<option value='$username'>$username</option>";
                       }
    ?>
    </select>
    </div>
  <div class="form-group">
  <label for="post_cat">Status</label>
  <select name="status" class=" custom-select mr-sm-2" id="inlineFormCustomSelect">
    <option value="draft">Post Status
    </option>
  <option value="Published">Published</option>
  <option value="draft">Draft</option></select>
  </div>
  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="file">
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="tags">
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" id="body" cols="30" rows="10" name="post_content"></textarea>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Publish Post</button>
</form>