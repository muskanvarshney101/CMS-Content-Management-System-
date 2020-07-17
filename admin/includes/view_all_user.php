<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Admin</th>
                                <th>Subscriber</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>


                        <?php
                        $query ="SELECT * FROM `user`";
                        $select_all_user = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($select_all_user)){
                            $user_id=$row['user_id'];
                            $username=$row['username'];
                            $user_firstname=$row['user_firstname'];
                            $user_lastname=$row['user_lastname'];
                            $user_email=$row['user_email'];
                            $user_role=$row['user_role'];
                            
                           
                           echo"<tr>";
                            echo"<td> $user_id </td>";
                            echo"<td> $username </td>";
                            echo"<td>$user_firstname </td>";
                            
                            // $query="SELECT * FROM `categories` WHERE cat_id ='$post_category_id'";
                            // $select_category_id = mysqli_query($conn,$query);
                            // while($row = mysqli_fetch_assoc($select_category_id)){
                            //     $cat_id=$row['cat_id'];
                            //     $cat_title=$row['cat_title'];
                            //     echo"<td>$cat_title</td>";
                            // }
                           
                            echo"<td> $user_lastname </td>";
                             
                            //  echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
                            echo"<td> $user_email </td>";
                            echo"<td> $user_role </td>";
                            
                            echo"<td><a href='user.php?admin=$user_id'>Admin</a></td>";
                             
                            echo"<td><a href='user.php?subscriber=$user_id'>Subscriber</a></td>";
                             echo"<td><a href='user.php?source=edit_user&user_id=$user_id'>Edit</a></td>";
                             
                             echo"<td><a onClick=\"javascript:return confirm('are you sure you want to Delete');\" href='user.php?delete=$user_id'>Delete</a></td>";
                             
                        echo"</tr>";
                       

                        }?>
                        
                    </tbody>
                    </table>
                    <?php
                    if(isset($_GET['admin'])){
                    $the_user_id=$_GET['admin'];
                    $query = "UPDATE `user` SET user_role='Admin' WHERE user_id='$the_user_id'";
                    $user_admin_query = mysqli_query($conn,$query);
                    if(!$user_admin_query){
                        die("Query Failed".mysqli_error($conn));
                    }
                   else{
                       ?>
                       <script>
                       alert("User is now Admin");
                       window.open('user.php','_self');
                       </script>
                       <?php
                   }
                    }
                    
                    ?>
                    <?php
                    if(isset($_GET['subscriber'])){
                    $the_user_id=$_GET['subscriber'];
                    $query = "UPDATE `user` SET user_role='Subscriber' WHERE user_id='$the_user_id'";
                    $user_subscriber_query = mysqli_query($conn,$query);
                    if(!$user_subscriber_query){
                        die("Query Failed".mysqli_error($conn));
                    }
                   else{
                       ?>
                       <script>
                       alert("User is now Subscriber");
                       window.open('user.php','_self');
                       </script>
                       <?php
                   }
                    }
                    
                    ?>
                    <?php
                   
                    if(isset($_GET['delete']))
                    {
                        if(isset($_SESSION['role']))
                        {
                            if($_SESSION['role']=='Admin')
                            {
                                $the_user_id=mysqli_real_escape_string($conn,$_GET['delete']);
                                $query = "DELETE FROM `user` WHERE user_id='$the_user_id'";
                                $delete_query = mysqli_query($conn,$query);
                                if(!$delete_query)
                                {
                                    die("Query Failed".mysqli_error($conn));
                                }
                               else
                               {
                                   ?>
                                   <script>
                                   alert("User Deleted");
                                   window.open('user.php','_self');
                                   </script>
                                   <?php
                               }
                            }
                        }
                       
                    }
                    
                    
                    ?>
                    
                    