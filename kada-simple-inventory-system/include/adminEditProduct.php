<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// ADMIN UPDATE PRODUCT
//==============================//
if(isset($_POST['updateProduct'])){
    $productID = $_POST['productID'];
    $category = $_POST['category'];
    $productName = mysqli_real_escape_string($con,$_POST['productName']);
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $supplier = $_POST['supplier'];
    $id = $_SESSION['user_id'];
 
    if(empty($category) && empty($productName) && empty($price) && empty($qty) && empty($supplier)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../admin/product.php");
        exit();
    } else {
        $sql = "UPDATE tbl_product SET productCategory ='$category', productName ='$productName', productPrice ='$price', productQuantity ='$qty', productSupplier ='$supplier', lastEditedBy ='$id' WHERE productID = '$productID'";
        mysqli_query($con,$sql);
    
        $_SESSION['status_message'] = "Product has been Successfully Updated!";
        $_SESSION['status_code'] = "success";
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