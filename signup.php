
<?php
require_once("Includes/session.php");
require_once("Includes/db_connection_test.php");
//initialising the variables
$nameErr = $phoneErr = $addrErr = $emailErr = $passwordErr = $confpasswordErr = "";
$name = $email = $password = $confpassword = $address = "";
$flag=0;

//Checking for a valid form string
function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

if(isset($_POST["reg_submit"])) {
        $email = test_input($_POST['email']); 
        $password = test_input($_POST["inputPassword"]);
        $confpassword = test_input($_POST["confirmPassword"]);
        $address = test_input($_POST["address"]);
        $email = test_input($_POST['email']);

        // Name validation
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $flag=1;
            echo $nameErr;
        } else {
            $name = test_input($_POST["name"]);
            // check to see if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Only letters and white space allowed"; 
                $flag=1;
                echo $nameErr;
            }
        }

        // Email validation
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $flag=1;
            } else {
            $email = test_input($_POST["email"]);
            // checking  email address 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
                $flag=1;
                echo $emailErr;
            }
        }

        // Password validation
        if (empty($_POST["inputPassword"])) 
        {
            $passwordErr = "password is needed ";
            $flag=1;
        }
        else 
        {
            $password = $_POST["inputPassword"];
        }
        // CONFIRM PASSWORD
        if (empty($_POST["confirmPassword"])) 
        {
            $confpasswordErr = "it's missing";
            $flag=1;
        }
        else 
        {
            if($_POST['confirmPassword'] == $password)
            {
                $confpassword = $_POST["confirmPassword"];
            }
            else
            {
                $confpasswordErr = "Password doesn't match";
                $flag = 1;
            }
        }

        //checking for address validation
        if (empty($_POST["address"])) {
            $addrErr = "The address is needed";
            $flag=1;
            echo $addrErr;
        } else {
            $address = test_input($_POST["address"]);
           
        }

        //contact validation
        if (empty($_POST["contactNo"])) {
            $flag=1;
            $contactNo = "";
          
        } else {
            $contactNo = test_input($_POST["contactNo"]);
            if(!preg_match("/^d{10}$/", $_POST["contactNo"])){
                $phoneErr="10 digit phone no allowed.";
                
                echo $_POST['contactNo'];
            }
        }

        // Only if succeed from the validation  
        echo $flag; 
        if($flag == 0)
        {
            require_once("Includes/db_connection_test.php");
            $sql = "INSERT INTO user (`name`,`email`,`phone`,`pass`,`address`)
                    VALUES('$name','$email','$contactNo','$password','$address')";
                    echo $sql;
            if (!mysqli_query($con,$sql))
            {
                die('Error: ' . mysqli_error($con));
            }
            header("Location: ../ebill/user/index.php");
        }
    }
?>

<form action="signup.php" method="post" class="form-horizontal" role="form" onsubmit="return validateForm()">
    <div class="row form-group">
        <div class="col-md-12">
            <input type="name" class="form-control" name="name" id="name" placeholder="Full Name" required>
            <!-- <label><?php echo $nameErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            <!-- <label><?php echo $emailErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password" required>
            <!-- <label><?php echo $passwordErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required>
            <!-- <label><?php echo $confpasswordErr;?></label><label><?php echo $confpasswordErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="tel" class="form-control" name="contactNo" placeholder="Contact No." required>
            <!-- <label><?php echo $phoneErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="address" class="form-control" name="address" placeholder="Address" required>
            <!-- <label><?php echo $addrErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-10">
            <button name="reg_submit" class="btn btn-primary">Sign up</button>
        </div>
    </div>

</form>
