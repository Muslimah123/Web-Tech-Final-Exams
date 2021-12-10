<?php 
   require_once('../Includes/db_connection_test.php');  

    $cid=$_POST['cid'];
    echo "$cid";
    if (isset($_POST["complaint_process"])) {
        if(isset($_POST["cid"])) {
            $query = "UPDATE complaint SET status='PROCESSED' WHERE id={$cid}";
            // echo $query;
            $result = mysqli_query($con,$query);
            if($result === FALSE) {
                die("cannot connect"); 
            }
        }
    }
    header("Location:complaint.php");
 ?>