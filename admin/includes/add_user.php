<?php

if(isset($_POST['submit'])){
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $user_role=$_POST['role'];
    $username=$_POST['username'];
    $username=mysqli_real_escape_string($conn,$username);
    $user_email=$_POST['email'];
    // $post_image=$_FILES['file']['name'];
    // $post_image_temp=$_FILES['file']['tmp_name'];
    // salt="dfghjklrtyuiobnn";
    $user_password=$_POST['password'];

    $query="SELECT randsalt FROM `user`";
    $select_randsalt_query=mysqli_query($conn,$query);

    $user_password=password_hash($user_password,PASSWORD_BCRYPT, array('cost'=>12));
    
    
    $query ="INSERT INTO `user`(user_firstname,user_lastname,username,user_email,user_role,user_password) VALUES('$user_firstname','$user_lastname','$username','$user_email','$user_role','$user_password')";

     $create_all_user=mysqli_query($conn,$query);
     confirm($create_all_user);

}
?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="firstname">Firstname</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>
  <div class="form-group">
    <label for="lastname">Lastname</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>

  <div class="form-group">
  <label for="role">Role</label><br>
  <select name="role" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
  <option value="Admin">Admin</option>
  <option value="Subscriber">Subcscriber</option></select>  
  </div>
  
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username">
  </div>
  
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email"class="form-control" name="email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary">ADD User</button>
</form>