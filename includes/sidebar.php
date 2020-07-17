<div class="col-md-4">
    <!-- Blog Search Well  -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group"><input type="text" name="search" class="form-control"><span
                    class="input-group-btn"><button type="submit" name="submit" class="btn btn-default"
                        type="button"><span class="glyphicon glyphicon-search"></span></button></span></div>
        </form>
        <!-- search form -->
        <!-- /.input-group  -->
    </div>

<!--login form-->
    <div class="well">
    <?php if(isset($_SESSION['role'])):?>
        <h4>Logged in as <b><?php echo $_SESSION['username'];?></b></h4>
        <a href="includes/logout.php" class="btn btn-primary">Logout</a>
    <?php else:?>
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
            </div> 
            <div class="input-group">
            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            <span class="input-group-btn">
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            </span>
            </div>

        </form>
        <!-- search form -->
        <!-- /.input-group  -->
    <?php endif;?>
        
    </div>


    <!-- Blog Categories Well  -->
    <div class="well">

        <?php

            $query ="SELECT * FROM `categories`";
            $select_category_sidebar = mysqli_query($conn,$query);
            
            ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                            while($row =mysqli_fetch_assoc( $select_category_sidebar)){
                            $cat_title= $row['cat_title'];
                            $cat_id= $row['cat_id'];
                            
                       ?>
                    <li><a href="category.php?category=<?php echo $cat_id ;?>"><?php echo $cat_title ;?> </a></li>

                    <?php
                            }
                            ?>

                </ul>
            </div>
            <!-- /.col-lg-6   -->
        </div>
        <!-- /.row -->
    </div>
    <!-- Side Widget Well  -->
    <?php include "includes/widget.php"?>
</div>