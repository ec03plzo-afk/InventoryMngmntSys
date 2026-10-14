<?php
session_start();
include('../include/config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}
    
$productID = $_GET['productID'];
$status = $_GET['productStatus'];
$id = $_SESSION['user_id'];
$update = "UPDATE tbl_product SET productStatus ='$status', lastEditedBy ='$id' WHERE productID ='$productID'";
mysqli_query($con, $update);
header("Location: product.php");
?>