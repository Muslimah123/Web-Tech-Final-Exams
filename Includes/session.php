<!-- I called this file session.It includes the inserting of information to the database -->
<!-- both the admin and the user -->
<?php  
    require_once("db_connection_test.php");   //connecting with database
    session_start();          //starting the session
    $logged = false;
    
    if(isset($_SESSION['logged']))   //checking if anyone is logged in or not
    {
        if ($_SESSION['logged'] == true)
        {
            $logged = true ;
            $email = $_SESSION['email'];
        }
    }
    else
        $logged=false;

    if($logged != true)
    {
        $email = "";
        if (isset($_POST['email']) && isset($_POST['pass']))
        {
            $email=$_POST['email'];
            $password=$_POST['pass'];            
            
            $email = stripslashes($email); // a few prereq-safeguards for database searching
            $email = mysqli_real_escape_string($con,$email);
            $password = stripslashes($password);
            $password = mysqli_real_escape_string($con,$password);
        
            //The database has two tables:Admin,each with their own email and password attributes.
                 
            // The database user       
            $sql = "SELECT * FROM user WHERE email='$email' AND pass='$password' "; 
            $result = mysqli_query($con,$sql);
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $_SESSION['user'] = $row['name'];
                $_SESSION['logged']=true;
                $_SESSION['uid']=$row['id'];
                $_SESSION['email'] = $email;
                $_SESSION['account']="user";
                
                header("Location:user/index.php");
            }  
            // admin
            $sql = "SELECT * FROM admin WHERE email='$email' AND pass='$password' ";
            $result = mysqli_query($con,$sql);
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $_SESSION['logged']=true;
                $_SESSION['email'] = $email;
                $_SESSION['aid']=$row['id'];
                $_SESSION['account']="admin";
                header("Location:admin/index.php");
            }

        }
    }
?>