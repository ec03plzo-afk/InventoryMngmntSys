<?php
session_start();
include('../include/config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}
    
$supplierID = $_GET['supplierID'];
$status = $_GET['supplierStatus'];
$id = $_SESSION['user_id'];
$update = "UPDATE tbl_supplier SET supplierStatus ='$status', lastEditedBy ='$id' WHERE supplierID ='$supplierID'";
mysqli_query($con, $update);
header("Location: supplier.php");
?>