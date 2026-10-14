<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// ADMIN DELETE SUPPLIER
//==============================//
if(isset($_POST['deleteSupplier'])){
    $supplierID = $_POST['supplierID'];

    $delete = "DELETE FROM tbl_supplier WHERE supplierID = '$supplierID'";
    $query = mysqli_query($con,$delete);

    if($query){
        $_SESSION['status_message'] = "Supplier has been Deleted!";
        $_SESSION['status_code'] = "success";
        header("Location: ../admin/supplier.php");
        exit();
    } else {
        $_SESSION['status_message'] = "Something went wrong...";
        $_SESSION['status_code'] = "error";
        header("Location: ../admin/supplier.php");
        exit();
    }
} else {
    header("Location: ../admin/supplier.php");
    exit();    
}
//=============END==============//
//==============================//

?>