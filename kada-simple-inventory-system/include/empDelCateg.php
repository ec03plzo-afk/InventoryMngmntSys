<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// EMPLOYEE DELETE CATEGORY
//==============================//
if(isset($_POST['deleteCategory'])){
    $categoryID = $_POST['categoryID'];

    $delete = "DELETE FROM tbl_category WHERE categoryID = '$categoryID'";
    $query = mysqli_query($con,$delete);

    if($query){
        $_SESSION['status_message'] = "Category has been Deleted!";
        $_SESSION['status_code'] = "success";
        header("Location: ../employee/category.php");
        exit();
    } else {
        $_SESSION['status_message'] = "Something went wrong...";
        $_SESSION['status_code'] = "error";
        header("Location: ../employee/category.php");
        exit();
    }
} else {
    header("Location: ../employee/category.php");
    exit();    
}
//=============END==============//
//==============================//

?>