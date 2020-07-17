<?php include "includes/header.php";?>

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

                    <div class="col-xs-6">

                        <?php insert_categories(); ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">AddCategory</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="ADD Category"></div>


                        </form>
                        <?php

                        // UPDATE aND INCLUDE QUERY

                       if(isset($_GET['Edit'])){

                           $cat_id = $_GET['Edit'];

                           include "includes/update_category.php";

                       } 
                       ?>
                    </div>

                    <!--Add category form-->

                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                    
                                </tr>
                            </thead>

                            <tbody>


                                <?php

                                // find all Category

                                    findAllCategories();
                                ?>
                                
                                <?php
                    
                                     Delete_Categories();
                    
                                ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/footer.php" ;?>