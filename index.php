<!-- This file contains landing page which encompasses the login,signup,and some
guidelines on how to navigate the page-->

<!-- templates are from bootstrap.com-->

<?php 

require_once("Includes/db_connection_test.php"); // getting our connections right
require_once("Includes/session.php");
if(isset($_SESSION['logged']))
{
    if ($_SESSION['logged'] == true)     //checks whether a user has logged  in
    {
        if ($_SESSION['account']=="admin") {         //check what type of account because we have two categories of people. admin
                                                 
                header("Location:admin/index.php");  //if admin,redirect to the admin page if login is successful
            }
        elseif ($_SESSION['account']=="user") {       //if user,redirect to the users page if login is successful.
                header("Location:user/index.php");
            }
    }  
    else  {
        header("Location:../index.php");     //otherwise,if the login was not successful,user cannot proceed
      }  
}

if(isset($_POST['login_submit'])) {
    if(!(isset($_POST['email']))) {
        if(!(isset($_POST['pass']))) {
            header("location:index.php");    
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>landing page</title>

   
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"> 


    <!-- linking css file for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

    <!-- The navbar contains the login portal -->
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"><i class='fas fa-cloud'></i><b>eLECTRA</b></a>
            </div>
            <div class="navbar-collapse collapse" >
                <!-- including login.php from another file-->
                <?php include("login.php"); ?>
            </div>
            
            
        </div>
    </div>
    <!-- The content-->
    <div id="headerwrap">
        <div class="darkhearderwrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 signup">
                        <h1>eLECTRA Billing<br> System</h1>
                        <p>Already worried since paying bills takes so much time.There's no need to stand in a queue to pay your bill again
            .This website serves as a consumer-oriented tool that allows users to pay their electricity bills online and connect
                with their providers in the event of complaints or questions.</p>
                    </div>
                    <!-- The registration form for new users.Users cannot log in until they have registered-->
                   <div class="col-lg-6">
                        <h1>Register</h1>
                        <!-- gotten and included in this page-->
                        <?php include("signup.php"); ?>
                    </div>
                    

                </div>
               
            </div>
           
            </div>
    </div>
    
            

        </div>
      
    </div> 

    <!--=======================JS=========================== -->
    <!-- To make the pages load faster,they are Placed at the end of the document -->
    <script src="assets/js/jquery-1.11.0.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- jQuery -->

    <script src="assets/js/custom.js"></script>
    
    <!-- form validation using javascript -->
    
    <script>

    function validateForm() {
            var x = document.forms["myForm"]["email"].value;
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                alert("The email address is not valid");
                return false;
            }
        }  </script>
    
</body>

</html>
