<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// ADMIN DELETE ORDER
//==============================//
if(isset($_POST['deleteOrder'])){
    $orderID = $_POST['orderID'];
    $product = $_POST['product'];
    $qty = $_POST['qty'];

    $delete = "DELETE FROM tbl_order WHERE orderID = '$orderID'";
    $query = mysqli_query($con,$delete);

    if($query){
        $update = "UPDATE tbl_product SET productQuantity = GREATEST(0, productQuantity + '$qty') WHERE productID = '$product'";
        mysqli_query($con,$update);
        $_SESSION['status_message'] = "Purchase has been Deleted!";
        $_SESSION['status_code'] = "success";
        header("Location: ../admin/order.php");
        exit();
    } else {
        $_SESSION['status_message'] = "Something went wrong...";
        $_SESSION['status_code'] = "error";
        header("Location: ../admin/order.php");
        exit();
    }
} else {
    header("Location: ../admin/order.php");
    exit();    
}
//=============END==============//
//==============================//

?>