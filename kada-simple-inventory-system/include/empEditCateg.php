<?php
session_start();
include('config.php');
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
}


//==============================//
// EMPLOYEE UPDATE CATEGORY
//==============================//
if(isset($_POST['updateCategory'])){
    $categoryID = $_POST['categoryID'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $id = $_SESSION['user_id'];

    if(empty($name)){
        $_SESSION['status_message'] = "Category Name is required!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../employee/category.php");
        exit();
    } else {    
        $checkName = "SELECT * FROM tbl_category WHERE categoryName = '$name'";
        $query = mysqli_query($con,$checkName);

        if(mysqli_num_rows($query) > 0){
            $_SESSION['status_message'] = "Category Name is already exist..";
            $_SESSION['status_code'] = "warning";
            header("Location: ../employee/category.php");
            exit();
        } else {
            $update = "UPDATE tbl_category SET categoryName ='$name', lastEditedBy ='$id' WHERE categoryID = '$categoryID'";
            mysqli_query($con,$update);
    
            $_SESSION['status_message'] = "Category has been Successfully Updated!";
            $_SESSION['status_code'] = "success";
            header("Location: ../employee/category.php");
            exit();    
        }
    }
} else {
    header("Location: ../employee/category.php");
    exit();    
}
//=============END==============//
//==============================//

?>