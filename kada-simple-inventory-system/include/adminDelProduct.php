<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// ADMIN DELETE PRODUCT
//==============================//
if(isset($_POST['deleteProduct'])){
    $productID = $_POST['productID'];

    $delete = "DELETE FROM tbl_product WHERE productID = '$productID'";
    $query = mysqli_query($con,$delete);

    if($query){
        $_SESSION['status_message'] = "Product has been Deleted!";
        $_SESSION['status_code'] = "success";
        header("Location: ../admin/product.php");
        exit();
    } else {
        $_SESSION['status_message'] = "Something went wrong...";
        $_SESSION['status_code'] = "error";
        header("Location: ../admin/product.php");
        exit();
    }
} else {
    header("Location: ../admin/product.php");
    exit();    
}
//=============END==============//
//==============================//

?>