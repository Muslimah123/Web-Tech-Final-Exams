<?php 

    require_once('head_html.php'); 
    require_once('../Includes/db_connection_test.php');  
    require_once('../Includes/session.php'); 
    require_once('../Includes/user.php'); 

    if ($logged==false) {
         header("Location:../index.php");
    }
?>

<body>

    <div id="wrapper">
    
        <?php 
            require_once("nav.php");
            require_once("sidebar.php");
        ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                            <small>Overview</small>
                        </h1>
                        <?php
                            require_once("../Includes/session.php");
                            require_once('../Includes/db_connection_test.php'); 
                        ?>
                        <!-- STATISTICS -->
                        <h1 style="padding-left:30px;" class="text-muted text-centered">Stats</h1>
                        <div class="row" style="margin-top: 20px;">
                            <div class=".col-lg-3 col-xs-8">
                            <?php 
                                list($result1,$result2,$result3) = retrieve_user_stats($_SESSION['uid']);
                                $row1 = mysqli_fetch_row($result1);
                                $row2 = mysqli_fetch_row($result2);
                                $row3 = mysqli_fetch_row($result3);
                             ?>
                                <table class="table  ">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h4>Number of Bills which have been PAYED</h4>
                                            </td>
                                            <td class="success">
                                            <h4>
                                                <?php 
                                                    echo $row2[0];
                                                ?>
                                            </h4>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h4>Number of Bills whose payements are still PENDING</h4>
                                            </td>
                                            <td class="danger">
                                                <h4>
                                                    <?php 
                                                        echo $row1[0];
                                                    ?>
                                                </h4>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h4>Number of Complaints which are yet to be processed</h4>
                                            </td>
                                            <td class="success">
                                                <h4>
                                                    <?php 
                                                        echo $row3[0];
                                                    ?>
                                                </h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> 

                        </div>

                    </div>
                </div>
                
            </div>
            
        </div>
        
    </div>
    

<?php 
    
    require_once("js.php");
?>

</body>

</html>
