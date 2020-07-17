<?php include "connection.php";?>
<?php session_start();?>

<?php

if(isset($_POST['login'])){

    $username=trim($_POST['username']);
    $username=mysqli_real_escape_string($conn,$username);
    $password=trim($_POST['password']);
    $password=mysqli_real_escape_string($conn,$password);
    // $password=strlen($passowrd);

    
        $query ="SELECT * FROM `user` WHERE username='$username' ";
        $user_query = mysqli_query($conn,$query);
        $select_user_query=mysqli_num_rows($user_query);
        if(!$user_query){
            die("QUERY FAILED".mysqli_error($conn));
        }
        // if($select_user_query>0){

            while($row=mysqli_fetch_assoc($user_query)){
                $user_id=$row['user_id'];
                $username=$row['username'];
                $firstname=$row['user_firstname'];
                $db_user_password=$row['user_password'];
                $lastname=$row['user_lastname'];
                $email=$row['user_email'];
                $role=$row['user_role'];
            }
            
    if(password_verify($password,$db_user_password)){

    $_SESSION['username']="$username";
    $_SESSION['firstname']="$firstname";
    $_SESSION['lastname']="$lastname";
    $_SESSION['role'] ="$role";
    
    header("Location:../admin");
        }

        else{
            ?>
            <script>
            alert('enter the correct username and passowrd');
            </script>
            <?php
        }

       
        

    

    
}


?>