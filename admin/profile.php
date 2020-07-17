<?php include "includes/header.php";?>
<?php

if(isset($_SESSION['username'])){

    $username=$_SESSION['username'];
    $query ="SELECT * FROM `user` WHERE username='$username'";
                        $select_all_user = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($select_all_user)){
                            $user_id=$row['user_id'];
                            $user_firstname=$row['user_firstname'];
                            $user_lastname=$row['user_lastname'];
                            $user_email=$row['user_email'];
                            $username=$row['username'];
                            $role=$row['user_role'];
                            $password=$row['user_password'];
                            
                        }
}

?>
<?php

if(isset($_POST['submit'])){
    
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $user_email=$_POST['user_email'];
    $username=$_POST['username'];
    $username=mysqli_real_escape_string($conn,$username);
    $role=$_POST['user_role'];
    $password=$_POST['password'];
    $password=password_hash($password,PASSWORD_BCRYPT, array('cost'=>12));
    
//   move_uploaded_file($post_image_temp,"../images/$post_image");


//   if(empty($post_image)){
//     $query="SELECT * FROM `post` WHERE post_id='$post_id'";
//     $select_image = mysqli_query($conn,$query);
//     while($row = mysqli_fetch_assoc($select_image)){

//       $post_image =$row['post_image'];
//     }
//   }

  $query="UPDATE `user` SET ";
  $query .="user_firstname ='$user_firstname', ";
  $query .="user_lastname ='$user_lastname', ";
  $query .="user_email ='$user_email', ";
  $query .="username ='$username', ";
  $query .="user_role ='$role', ";
  $query .="user_password ='$password' ";
  $query .="WHERE username ='$username'";
  

  $update_user =mysqli_query($conn,$query);
  confirm($update_user);

}
?>


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
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username ; ?>">
  </div>
  
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email"class="form-control" name="user_email" value="<?php echo $user_email ;?>">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" autocomplete="off" class="form-control" name="password">
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
</form>




                    
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/footer.php" ;?>