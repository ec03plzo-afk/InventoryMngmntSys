<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// ADMIN USER REGISTRATION REJECT
//==============================//
if(isset($_POST['reject'])){
    $userID = $_POST['userID'];

    $del = "DELETE FROM tbl_user WHERE userID = '$userID'";
    mysqli_query($con,$del);

    $_SESSION['status_message'] = "User has been Reject!";
    $_SESSION['status_code'] = "success";
    header("Location: ../admin/user.php");
    exit();
} else {
    header("Location: ../admin/user.php");
    exit();    
}
//=============END==============//
//==============================//

?>