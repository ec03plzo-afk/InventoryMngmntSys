<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// EMPLOYEE UPDATE CUSTOMER
//==============================//
if(isset($_POST['updateCustomer'])){
    $customerID = $_POST['customerID'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $id = $_SESSION['user_id'];

    if(empty($name) && empty($address) && empty($phone) && empty($email)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../employee/customer.php");
        exit();
    } else {    
        $update = "UPDATE tbl_customer SET customerName ='$name', customerAddress = '$address',customerPhone = '$phone', customerEmail = '$email', lastEditedBy ='$id' WHERE customerID = '$customerID'";
        mysqli_query($con,$update);

        $_SESSION['status_message'] = "Customer has been Successfully Updated!";
        $_SESSION['status_code'] = "success";
        header("Location: ../employee/customer.php");
        exit();    
    }
} else {
    header("Location: ../employee/customer.php");
    exit();    
}
//=============END==============//
//==============================//

?>