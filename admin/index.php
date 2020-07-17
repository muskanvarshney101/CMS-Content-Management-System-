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

                    

                </div>
            </div>
            <!-- /.row -->





       
                <!-- /.row -->
                
                <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php 
                    $query = "SELECT * FROm `post` ";
                    $select_all_post=mysqli_query($conn,$query);
                    $post_count= mysqli_num_rows($select_all_post);
                    ?>
                  <div class='huge'><?php echo $post_count;?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                    $query = "SELECT * FROm `comment` ";
                    $select_all_comment=mysqli_query($conn,$query);
                    $comment_count= mysqli_num_rows($select_all_comment);
                    ?>
                     <div class='huge'><?php echo $comment_count;?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comment.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                    $query = "SELECT * FROm `user` ";
                    $select_all_user=mysqli_query($conn,$query);
                    $user_count= mysqli_num_rows($select_all_user);
                    ?>
                    <div class='huge'><?php echo $user_count;?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="user.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                    $query = "SELECT * FROm `categories` ";
                    $select_all_categories=mysqli_query($conn,$query);
                    $categories_count= mysqli_num_rows($select_all_categories);
                    ?>
                        <div class='huge'><?php echo $categories_count;?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
                <?php

$query = "SELECT * FROm `post` WHERE post_status='Published' ";
$select_Published_post=mysqli_query($conn,$query);
$post_Published_count= mysqli_num_rows($select_Published_post);

                 $query = "SELECT * FROm `post` WHERE post_status='draft' ";
                 $select_draft_post=mysqli_query($conn,$query);
                 $post_draft_count= mysqli_num_rows($select_draft_post);

                 $query = "SELECT * FROm `comment` WHERE comment_status='Unapproved' ";
                 $unapproved_comment=mysqli_query($conn,$query);
                 $unapproved_comment_count= mysqli_num_rows($unapproved_comment);

                 $query = "SELECT * FROm `user` WHERE user_role='Subscriber' ";
                 $user_subscriber=mysqli_query($conn,$query);
                 $user_subscriber_count= mysqli_num_rows($user_subscriber);
                
                ?>
<div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date','Count'],
          <?php
          
          $element_text =['All Posts','Active Posts','Draft Post','Comments','Pending Comments','Users','Subscriber','Categories'];
          $element_count=[$post_count,$post_Published_count,$post_draft_count,$comment_count,$user_count,$user_count,$user_subscriber_count,$categories_count];

          $count = count($element_text);
          for($i=0;$i<$count;$i++){

            echo"['{$element_text[$i]}'"."," ."{$element_count[$i]}],";
          }
          ?>
          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
 <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
 </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/footer.php" ;?>