 <form action="" method="post">
     <div class="form-group">
         <label for="cat_title">Edit Category</label>
         <?php 
                    if (isset($_GET['Edit'])){
                        $The_cat_id = $_GET['Edit'];
                        $query = "SELECT * FROM `categories` WHERE cat_id = '$The_cat_id'";
                        $Edit_category_query = mysqli_query($conn,$query);
                       while($array1= mysqli_fetch_assoc($Edit_category_query)){
                           $cat_id =$array1['cat_id'];
                           $cat_title =$array1['cat_title'];
                            ?>
         <input type="text" class="form-control" name="a_cat_title"
             value="<?php if(isset($cat_title)){ echo $cat_title;}?>">

         <?php
                       }
                        
                       
                    }
                    ?>
         <?php
                    if(isset($_POST['update_cat'])){
                        $cat_title = $_POST['a_cat_title'];
                        $query = "UPDATE `categories` SET cat_title = '$cat_title' WHERE cat_id = '$cat_id'";
                        $update_query=mysqli_query($conn,$query);
                        if(!$update_query){
                            die("QUERY FAILDE".mysqli_error($conn));
                        }
                        else{
                            ?>
         <script>
             alert("DATA UPDATED");
             window.open('categories.php', '_self');
         </script>
         <?php
                        }
                        
                    }
                        ?>
     </div>


     <div class="form-group">
         <input type="submit" name="update_cat" class="btn btn-primary" value="Update Category">
     </div>
 </form>