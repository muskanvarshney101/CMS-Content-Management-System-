<?php include "connection.php";?>
<?php


if(isset($_POST['submit'])){
    $username=trim($_POST['username']);
    $email=trim($_POST['email']);
    $password=$_POST['password'];

    if(!empty($username) && !empty($email) && !empty($password)){
        if(strlen($password)>=6){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $username=mysqli_real_escape_string($conn,$username);
    $email=mysqli_real_escape_string($conn,$email);
    $password=mysqli_real_escape_string($conn,$password);

                $password=password_hash($password,PASSWORD_BCRYPT, array('cost'=>12));
  
                $query ="INSERT INTO `user`(username,user_email,user_password,user_role) VALUES('$username','$email','$password','Subscriber')";
                $register_user_query=mysqli_query($conn,$query);
                if(!$register_user_query){
                    die("QUERY FAILEd".mysqli_error($conn).''.mysqli_errno($conn));
                }
                ?>
                <script>
                alert('Your Registration has been submitted');
                window.open('../registration.php','_self');
                </script>
                <?php
            }
            else{
                ?>
                <script>
                alert('enter the valid email');
                window.open('../registration.php','_self');
                </script>
                <?php
            }
        }
        else{
            ?>
            <script>
            alert('enter password more than equal to 6 character');
            window.open('../registration.php','_self');
            </script>
            <?php
        }
    }
    else{
        ?>
        <script>
        alert('Field must be specified');
        window.open('../registration.php','_self');</script>

        <?php
    }
}





?>