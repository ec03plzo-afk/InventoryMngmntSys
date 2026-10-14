<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// ADMIN DELETE PURCHASE
//==============================//
if(isset($_POST['deletePurchase'])){
    $purchaseID = $_POST['purchaseID'];
    $name = $_POST['name'];
    $qty = $_POST['qty'];

    $delete = "DELETE FROM tbl_purchase WHERE purchaseID = '$purchaseID'";
    $query = mysqli_query($con,$delete);

    if($query){
        $update = "UPDATE tbl_product SET productQuantity = GREATEST(0, productQuantity - '$qty') WHERE productID = '$name'";
        mysqli_query($con,$update);
        $_SESSION['status_message'] = "Purchase has been Deleted!";
        $_SESSION['status_code'] = "success";
        header("Location: ../admin/purchase.php");
        exit();
    } else {
        $_SESSION['status_message'] = "Something went wrong...";
        $_SESSION['status_code'] = "error";
        header("Location: ../admin/purchase.php");
        exit();
    }
} else {
    header("Location: ../admin/purchase.php");
    exit();    
}
//=============END==============//
//==============================//

?>