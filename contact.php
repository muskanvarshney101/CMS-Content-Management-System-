
 <?php  include "includes/header.php"; ?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>

<?php

if(isset($_POST['submit']))
{
$to = "muskan.varshney_cs17@gla.ac.in";
$header ="From: muskan.varshney101@gmail.com";
$subject ="hello";
$message ="yeahhhh";

mail($to,$subject,$message,$header);
}
?>
<!-- Page Content -->
<div class="container">

<section id="login">
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <div class="form-wrap">
            <h1><b>Contact</b></h1>
                <form role="form" action="" method="post" id="login-form" autocomplete="off">

                     <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                    </div>

                    <div class="form-group">
                        <label for="subject" class="sr-only">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter the Subject">
                    </div>

                    <div class="form-group">
                    <textarea name="message" id="body" class="form-control" cols="50" rows="10"></textarea>
                    </div>
                    
                     
                    <input type="submit"name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                </form>
             
            </div>
        </div> <!-- /.col-xs-12 -->
    </div> <!-- /.row -->
</div> <!-- /.container -->
</section>


    <hr>



<?php include "includes/footer.php";?>
