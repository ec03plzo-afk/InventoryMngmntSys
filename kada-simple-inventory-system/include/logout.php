<?php 
    require('config.php');
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location: ../index.php');
    }
    
    date_default_timezone_set('Asia/Manila');
    $logout_date = date("Y-m-d");
    $logout_time = date("H:i:s");
    $query = "INSERT INTO tbl_userlogs VALUES ('".$_SESSION['user_id']."','".$_SESSION['login_date']."', '".$_SESSION['login_time']."','$logout_date','$logout_time')";
    mysqli_query($con,$query);
    session_unset();
    session_destroy();
    header('Location: ../index.php');
?>