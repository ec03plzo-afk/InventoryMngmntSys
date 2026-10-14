<?php
session_start();
include('../include/config.php');
if(!isset($_SESSION['user_id']) || !isset($_SESSION['admin_name'])){
    header('Location: ../index.php');
}
    
$categoryID = $_GET['categoryID'];
$status = $_GET['categoryStatus'];
$id = $_SESSION['user_id'];
$update = "UPDATE tbl_category SET categoryStatus ='$status', lastEditedBy ='$id' WHERE categoryID ='$categoryID'";
mysqli_query($con, $update);
header("Location: category.php");
?>