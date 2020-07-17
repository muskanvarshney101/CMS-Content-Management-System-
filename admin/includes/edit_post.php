<?php
if(isset($_GET['p_id'])){
    $post_id =$_GET['p_id'];
    $query ="SELECT * FROM `post` WHERE post_id=$post_id";
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
                            $post_content=$row['post_content'];
                        }
}


if(isset($_POST['submit'])){
  $post_category_id=$_POST['post_category'];
  $post_author=$_POST['author'];
  $post_user=$_POST['post_user'];
  $post_status=$_POST['status'];
  $post_image=$_FILES['file']['name'];
  $post_image_temp=$_FILES['file']['tmp_name'];
  $post_tags=$_POST['tags'];
  $post_title=$_POST['post_title'];
  $post_content=$_POST['post_content'];
  $post_content=mysqli_real_escape_string($conn,$post_content);

  move_uploaded_file($post_image_temp,"../images/$post_image");


  if(empty($post_image)){
    $query="SELECT * FROM `post` WHERE post_id='$post_id'";
    $select_image = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($select_image)){

      $post_image =$row['post_image'];
    }
  }

  $query="UPDATE `post` SET ";
  $query .="post_title ='$post_title', ";
  $query .="post_category_id ='$post_category_id', ";
  $query .="post_user ='$post_user', ";
  $query .="post_date =now(), ";
  $query .="post_author ='$post_author', ";
  $query .="post_status ='$post_status', ";
  $query .="post_tags ='$post_tags', ";
  $query .="post_content ='$post_content', ";
  $query .="post_image ='$post_image' ";
  $query .="WHERE post_id ='$post_id'";

  $update_post =mysqli_query($conn,$query);
  confirm($update_post);

  echo"<p class='bg-success'>Post Update. <a href='../post.php?p_id=$post_id'>View Post and </a><a href='posts.php'> Edit more post</a></p>";
 



}

?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" class="form-control" name="post_title" value="<?php echo $post_title ;?>">
  </div>
  <div class="form-group">
  <label for="post_title">Post Category</label></br>
    <select name="post_category" id="">
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

  </div>
  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="author" value="<?php echo $post_author ;?>">
  </div>
  <div class="form-group">
    <label for="post_cat">User</label>
    <select name="post_user" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
    <?php echo"<option value='$post_user'>$post_user</option>";?>
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
    <label for="post_status">Post Status</label><br>
    <!-- <input type="text" class="form-control" name="status" value="<?php echo $post_status ;?>"> -->
    <select name="status" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
  <option value="subscriber"><?php echo $post_status;?></option>
  <?php
  if($post_status=="Published"){
      ?>
      <option value="draft">Draft</option>
      <?php
  }
  else{
      ?>
      <option value="Published">Published</option>
      <?php
  }
  ?>
  </select>
  </div>
  <div class="form-group">
  <label for="post_image">Post Image</label></br>
    <img width="100" src="../images/<?php echo $post_image?>"alt="">
  </div>
  <div class="form-group">
    <input type="file" name="file">
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="tags" value="<?php echo $post_tags ;?>">
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" id="body" cols="30" rows="10" name="post_content" ><?php echo $post_content ;?></textarea>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Update Publish Post</button>
</form>

