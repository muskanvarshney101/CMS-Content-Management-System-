<?php


function escape($string)
{
    global $conn;
    return mysqli_real_escape_string($conn, trim($string));
}

function confirm($create){
    global $conn;
    if(!$create){
         die("QUERY FAILED".mysqli_error($conn));
     }
     
     
}

function insert_categories(){
   
    global $conn;
                    if(isset($_POST['submit'])){
                        $cat_title = trim($_POST['cat_title']);
                        
                       if(empty($cat_title)){
                           ?>
                        <script>
                            alert("Enter Category Title");
                            window.open('categories.php', '_self');
                        </script>
                        <?php
                       }
                       else{
                           $query ="INSERT INTO `categories`(cat_title) VALUES ('$cat_title')";
                           $create_category = mysqli_query($conn,$query);
                           if(!$create_category){
                               die ("QUERY FAILED".mysqli_error($conn));
                               
                           }
                           else{
                               ?>
                        <script>
                            alert("Category Add successfully");
                            window.open('categories.php', '_self');
                        </script>
                        <?php
                           }
                       }

                    }
                  
}


function findAllCategories(){

     global $conn;

                    $query = "SELECT * FROM `categories`";
                    $select_category = mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($select_category)){
                        $cat_title=$row['cat_title'];
                        $cat_id=$row['cat_id'];
                       
                                echo"<tr>";
                                    echo"<td>$cat_id </td>";
                                    echo"<td>$cat_title </td>";
                                    echo"<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
                                    echo"<td><a href='categories.php?Edit=$cat_id'>Edit</a></td>";
                                echo"</tr>";
                              
                    }
}


function Delete_Categories(){

    global $conn;

                        if(isset($_GET['delete'])){
                        $the_cat_id = $_GET['delete'];
                        $query = "DELETE FROM `categories` WHERE cat_id = '$the_cat_id'";
                        $delete_query =mysqli_query($conn,$query);
                        if($delete_query){
                          
                            ?>
                                <script>
                                    alert("Category Deleted Suceessfully");
                                    window.open('categories.php', '_self');
                                </script>
                                <?php
                        }
                        
                    }
}

function users_online(){

    global $conn;
    
$session = session_id();
$time=time();
$time_out_seconds = 30;
$time_out = $time - $time_out_seconds;

$query ="SELECT * FROM `users_online` WHERE user_session='$session'";
$send_query=mysqli_query($conn,$query);
$count = mysqli_num_rows($send_query);

if($count == NULL){

    mysqli_query($conn,"INSERT INTO `users_online`(user_session ,user_time) VALUES('$session','$time')");

}
else{

    mysqli_query($conn,"UPDATE `users_online` SET user_time='$time' WHERE user_session='$session'");

}
$user_online=mysqli_query($conn,"SELECT * FROM `users_online` WHERE user_time > '$time_out'");
return $count_user= mysqli_num_rows($user_online);
}
?>