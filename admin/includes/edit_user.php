<?php
if(isset($_GET['user_id'])){
    $user_id =$_GET['user_id'];
    
    $query_select_user ="SELECT * FROM `user` WHERE user_id=$user_id";
                        $select_all_user = mysqli_query($conn,$query_select_user);
                        while($row = mysqli_fetch_assoc($select_all_user)){
                            $user_firstname=$row['user_firstname'];
                            $user_lastname=$row['user_lastname'];
                            $user_email=$row['user_email'];
                            $username=$row['username'];
                            $password=$row['user_password'];
                            $role=$row['user_role'];
                            
                        }


    

if(isset($_POST['submit']))
{
    
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $user_email=$_POST['user_email'];
    $username=$_POST['username'];
    $username=mysqli_real_escape_string($conn,$username);
    $role=$_POST['user_role'];
    $password=$_POST['password'];

if(!empty($password))
{
  $query_password="SELECT * FROM `user` WHERE user_id = $user_id ";
  $get_user = mysqli_query($conn,$query_password);
  confirm($get_user);
  $row= mysqli_fetch_array($get_user);
  $db_user_password = $row['user_password'];

  if($db_user_password != $password)
  {
    $password=password_hash($password,PASSWORD_BCRYPT, array('cost'=>12));
  }
  $query="UPDATE `user` SET ";
  $query .="user_firstname ='$user_firstname', ";
  $query .="user_lastname ='$user_lastname', ";
  $query .="user_email ='$user_email', ";
  $query .="username ='$username', ";
  $query .="user_role ='$role', ";
  $query .="user_password ='$password' ";
  $query .="WHERE user_id =$user_id";
  

  $update_user =mysqli_query($conn,$query);
  confirm($update_user);

  echo "User Updated" . "<a href ='user.php'>View Users?</a>";


}

}

}
else{
  header('Location: index.php');
}

?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="firstname">Firstname</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ;?>">
  </div>
  <div class="form-group">
    <label for="lastname">Lastname</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ;?>">
  </div>

  <div class="form-group">
  <label for="role">Role</label><br>
  <select name="user_role" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
  <option value="<?php echo $role;?>"><?php echo $role;?></option>
  <?php
  if($role=="Admin"){
      ?>
      <option value="Subscriber">Subcscriber</option>
      <?php
  }
  else{
      ?>
      <option value="Admin">Admin</option>
      <?php
  }
  ?>
  
  </select>  
  </div>
  
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username ; ?>">
  </div>
  
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email"class="form-control" name="user_email" value="<?php echo $user_email ;?>">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" autocomplete="off" class="form-control" name="password" >
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary">Update User</button>
</form>
