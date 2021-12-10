<?php
    $host='localhost'; # MySQL Host
    $mysql_user="root";# MySql UserName
    $mysql_pwd="";# MySql Password
    $dbms="electra"; # MySql Database

    $con = mysqli_connect($host,$mysql_user,$mysql_pwd,$dbms);
    if (!$con) die('Could not connect: ');
    mysqli_select_db($con,$dbms) or die("cannot select DB" );
?>