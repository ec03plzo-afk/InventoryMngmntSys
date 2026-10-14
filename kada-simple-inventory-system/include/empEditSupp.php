<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// EMPLOYEE UPDATE SUPPLIER
//==============================//
if(isset($_POST['updateSupplier'])){
    $supplierID = $_POST['supplierID'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $url = $_POST['url'];
    $id = $_SESSION['user_id'];

    if(empty($name) && empty($address) && empty($phone)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../employee/supplier.php");
        exit();
    } else {     
        $update = "UPDATE tbl_supplier SET supplierName ='$name', supplierAddress ='$address', supplierPhone ='$phone', supplierURL ='$url', lastEditedBy ='$id' WHERE supplierID = '$supplierID'";
        mysqli_query($con,$update);

        $_SESSION['status_message'] = "Supplier has been Successfully Updated!";
        $_SESSION['status_code'] = "success";
        header("Location: ../employee/supplier.php");
        exit();
    }
} else {
    header("Location: ../employee/supplier.php");
    exit();    
}
//=============END==============//
//==============================//

?>