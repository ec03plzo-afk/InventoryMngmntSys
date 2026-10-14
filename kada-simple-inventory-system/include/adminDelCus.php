<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// ADMIN DELETE CUSTOMER
//==============================//
if(isset($_POST['deleteCustomer'])){
    $customerID = $_POST['customerID'];

    $delete = "DELETE FROM tbl_customer WHERE customerID = '$customerID'";
    $query = mysqli_query($con,$delete);

    if($query){
        $_SESSION['status_message'] = "Customer has been Deleted!";
        $_SESSION['status_code'] = "success";
        header("Location: ../admin/customer.php");
        exit();
    } else {
        $_SESSION['status_message'] = "Something went wrong...";
        $_SESSION['status_code'] = "error";
        header("Location: ../admin/customer.php");
        exit();
    }
} else {
    header("Location: ../admin/customer.php");
    exit();    
}
//=============END==============//
//==============================//

?>