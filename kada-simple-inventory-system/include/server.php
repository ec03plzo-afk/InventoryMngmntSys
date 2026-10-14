<?php
session_start();
include('config.php');

//==============================//
// SIGN IN
//==============================//
if(isset($_POST['signInSubmit'])){
    $uname = trim($_POST['uname']);
    $pass = trim($_POST['pass']);

    if(empty($uname)){
        $_SESSION['status_message'] = "Username is required!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../index.php");
        exit();
    } else {
        if(empty($pass)){
            $_SESSION['status_message'] = "Password is required!";
            $_SESSION['status_code'] = "warning";
            header("Location: ../index.php");
            exit();
        } else {
            $select = "SELECT * FROM tbl_user WHERE username = '$uname' && password = password('$pass')";
            $query = mysqli_query($con,$select);

            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_array($query)){
                    if($row['status'] === 'approved'){
                        if($row['role'] === 'employee'){
                            $_SESSION['user_id'] = $row['userID'];
                            $_SESSION['employee_name'] = $row['username'];
                            date_default_timezone_set('Asia/Manila');
                            $_SESSION['login_date'] = date("Y-m-d");
                            $_SESSION['login_time'] = date("H:i:s");
                            $_SESSION['status_message'] = "Welcome to Dashboard!";
                            $_SESSION['status_code'] = "success";
                            header("Location: ../employee/home.php");
                            exit();
                        } else if($row['role'] === 'admin'){
                            $_SESSION['user_id'] = $row['userID'];
                            $_SESSION['admin_name'] = $row['username'];
                            date_default_timezone_set('Asia/Manila');
                            $_SESSION['login_date'] = date("Y-m-d");
                            $_SESSION['login_time'] = date("H:i:s");
                            $_SESSION['status_message'] = "Welcome to Dashboard!";
                            $_SESSION['status_code'] = "success";
                            header("Location: ../admin/home.php");
                            exit();
                        }
                    } else if($row['status'] === 'pending'){
                        $_SESSION['status_message'] = "Wait for approval!";
                        $_SESSION['status_code'] = "warning";
                        header("Location: ../index.php");
                        exit();
                    }
                }
            } else {
                $_SESSION['status_message'] = "Invalid Credentials..";
                $_SESSION['status_code'] = "error";
                header("Location: ../index.php");
                exit();
            }
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// SIGN UP
//==============================//
if(isset($_POST['signUp'])){
    $uname = mysqli_real_escape_string($con,$_POST['uname']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(empty($uname)){
        $_SESSION['status_message'] = "UserName is required!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../index.php");
        exit();
    } else {
        // $uname = validate($_POST['uname']);
        if(empty($email)){
            $_SESSION['status_message'] = "Email is required!";
            $_SESSION['status_code'] = "warning";
            header("Location: ../index.php");
            exit();
        } else {
            $email = validate($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['status_message'] = "Invalid Email Address.";
                $_SESSION['status_code'] = "error";
                header("Location: ../index.php");
                exit(); 
            } else {
                if(empty($phone)){
                    $_SESSION['status_message'] = "Contact is required!";
                    $_SESSION['status_code'] = "warning";
                    header("Location: ../index.php");
                    exit();
                } else {
                    // $pass = validate($_POST["pass"]);
                    if(empty($pass)){
                        $_SESSION['status_message'] = "Password is required!";
                        $_SESSION['status_code'] = "warning";
                        header("Location: ../index.php");
                        exit();
                    } else {
                        if(strlen($pass) < 6){
                            $_SESSION['status_message'] = "Password must be longer than 6 characters";
                            $_SESSION['status_code'] = "warning";
                            header("Location: ../index.php");
                            exit();
                        } else {
                            if($pass != $cpass){
                                $_SESSION['status_message'] = "Password does not matched!";
                                $_SESSION['status_code'] = "warning";
                                header("Location: ../index.php");
                                exit();
                            } else {
                                $select = "SELECT * FROM tbl_user WHERE username = '$uname'";
                                $check = mysqli_query($con,$select);
                                            
                                if(mysqli_num_rows($check) > 0){
                                    $_SESSION['status_message'] = "Username is already exist...";
                                    $_SESSION['status_code'] = "error";
                                    header("Location: ../index.php");
                                    exit();
                                } else {
                                    $selEmail = "SELECT * FROM tbl_user WHERE email = '$email'";
                                    $checkEmail = mysqli_query($con,$selEmail);
    
                                    if(mysqli_num_rows($checkEmail) > 0){
                                        $_SESSION['status_message'] = "Email is already exist...";
                                        $_SESSION['status_code'] = "error";
                                        header("Location: ../index.php");
                                        exit();
                                    } else {
                                        $insert = "INSERT INTO tbl_user(username, phone, email, password, status) VALUES ('$uname', '$phone', '$email', password('$pass'), 'pending')";
                                        mysqli_query($con,$insert);
    
                                        $_SESSION['status_message'] = "Account has been Successfully Created..Wait for approval";
                                        $_SESSION['status_code'] = "success";
                                        header("Location: ../index.php");
                                        exit();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// ADMIN USER REGISTRATION APPROVE
//==============================//
if(isset($_POST['approve'])){
    $userID = $_POST['userID'];
    $id = $_SESSION['user_id'];
     
    $update = "UPDATE tbl_user SET status ='approved', lastEditedBy ='$id' WHERE userID = '$userID'";
    mysqli_query($con,$update);

    $_SESSION['status_message'] = "User has been Successfully Approved!";
    $_SESSION['status_code'] = "success";
    header("Location: ../admin/user.php");
    exit();
}
//=============END==============//
//==============================//



//==============================//
// ADMIN ADD CUSTOMER
//==============================//
if(isset($_POST['adminAddCustomer'])){
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $id = $_SESSION['user_id'];

    if(empty($name) && empty($address) && empty($phone) && empty($email)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../admin/customer.php");
        exit();
    } else {
        $checkEmail = "SELECT * FROM tbl_customer WHERE customerEmail = '$email'";
        $query = mysqli_query($con,$checkEmail);

        if(mysqli_num_rows($query) > 0){
            $_SESSION['status_message'] = "Email is already exist..";
            $_SESSION['status_code'] = "warning";
            header("Location: ../admin/customer.php");
            exit();
        } else {
            $insert = "INSERT INTO tbl_customer(customerName,customerAddress,customerPhone,customerEmail,lastEditedBy) VALUES ('$name','$address','$phone','$email','$id')";
            mysqli_query($con,$insert);

            $_SESSION['status_message'] = "New Customer has been Successfully Created..";
            $_SESSION['status_code'] = "success";
            header("Location: ../admin/customer.php");
            exit();
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// ADMIN ADD CATEGORY
//==============================//
if(isset($_POST['adminAddCategory'])){
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $id = $_SESSION['user_id'];

    if(empty($name)){
        $_SESSION['status_message'] = "Category Name is required!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../admin/category.php");
        exit();
    } else {
        $checkName = "SELECT * FROM tbl_category WHERE categoryName = '$name'";
        $query = mysqli_query($con,$checkName);

        if(mysqli_num_rows($query) > 0){
            $_SESSION['status_message'] = "Category Name is already exist..";
            $_SESSION['status_code'] = "warning";
            header("Location: ../admin/category.php");
            exit();
        } else {
            $insert = "INSERT INTO tbl_category(categoryName,lastEditedBy) VALUES ('$name','$id')";
            mysqli_query($con,$insert);

            $_SESSION['status_message'] = "New Category has been Successfully Created..";
            $_SESSION['status_code'] = "success";
            header("Location: ../admin/category.php");
            exit();
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// ADMIN ADD SUPPLIER
//==============================//
if(isset($_POST['adminAddSupplier'])){
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $url = $_POST['url'];
    $id = $_SESSION['user_id'];

    if(empty($name) && empty($address) && empty($phone)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../admin/supplier.php");
        exit();
    } else {
        $checkName = "SELECT * FROM tbl_supplier WHERE supplierName = '$name'";
        $query = mysqli_query($con,$checkName);

        if(mysqli_num_rows($query) > 0){
            $_SESSION['status_message'] = "Supplier Name is already exist..";
            $_SESSION['status_code'] = "warning";
            header("Location: ../admin/supplier.php");
            exit();
        } else {
            $insert = "INSERT INTO tbl_supplier(supplierName,supplierAddress,supplierPhone,supplierURL,lastEditedBy) VALUES ('$name','$address','$phone','$url','$id')";
            mysqli_query($con,$insert);

            $_SESSION['status_message'] = "New Supplier has been Successfully Created..";
            $_SESSION['status_code'] = "success";
            header("Location: ../admin/supplier.php");
            exit();
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// ADMIN ADD PRODUCT
//==============================//
if(isset($_POST['adminAddProduct'])){
    $category = $_POST['category'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $supplier = $_POST['supplier'];

    $id = $_SESSION['user_id'];
    $imageName = $_FILES["photo"]["name"];
    $imageSize = $_FILES["photo"]["size"];
    $tmpName = $_FILES["photo"]["tmp_name"];

    if(empty($category) && empty($name) && empty($price) && empty($qty) && empty($supplier)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../admin/product.php");
        exit();
    } else {
        $checkName = "SELECT * FROM tbl_product WHERE productName = '$name'";
        $query = mysqli_query($con,$checkName);

        if(mysqli_num_rows($query) > 0){
            $_SESSION['status_message'] = "Product Name is already exist..";
            $_SESSION['status_code'] = "warning";
            header("Location: ../admin/product.php");
            exit();
        } else {
            // Image validation
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));

            if(!in_array($imageExtension, $validImageExtension)){
                $_SESSION['status_message'] = "Invalid Image Extension!";
                $_SESSION['status_code'] = "error";
                header("Location: ../admin/product.php");
                exit();
            } else if($imageSize > 1200000){
                $_SESSION['status_message'] = "Image Size Is Too Large";
                $_SESSION['status_code'] = "warning";
                header("Location: ../admin/product.php");
                exit();
            } else {
                $newImageName = $name . "-" . date("Y.m.d") . "-" . date("h.i.sa"); // Generate new image name
                $newImageName .= '.' . $imageExtension;
                $insert = "INSERT INTO tbl_product (productCategory, productName, productPhoto, productPrice, productQuantity, productSupplier, lastEditedBy) VALUES ('$category', '$name', '$newImageName', '$price', '$qty', '$supplier', '$id')";
                mysqli_query($con,$insert);
                move_uploaded_file($tmpName, '../assets/img/product/' . $newImageName);

                $_SESSION['status_message'] = "You have Successfully added new Product!";
                $_SESSION['status_code'] = "success";
                header("Location: ../admin/product.php");
                exit();
            }
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// ADMIN ADD PURCHASE
//==============================//
if(isset($_POST['adminAddPurchase'])){
    $name = $_POST['name'];
    $qty = $_POST['qty'];
    $supplier = $_POST['supplier'];
    $id = $_SESSION['user_id'];

    if(empty($name) && empty($qty) && empty($supplier)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../admin/purchase.php");
        exit();
    } else {
        $insert = "INSERT INTO tbl_purchase(productID,quantity,supplierID,lastEditedBy) VALUES ('$name','$qty','$supplier','$id')";
        mysqli_query($con,$insert);
        $update = "UPDATE tbl_product SET productQuantity = (productQuantity + '$qty') WHERE productID = '$name'";
        mysqli_query($con,$update);
        
        $_SESSION['status_message'] = "Purchase has been Successfully..";
        $_SESSION['status_code'] = "success";
        header("Location: ../admin/purchase.php");
        exit();
    }
}
//=============END==============//
//==============================//



//==============================//
// ADMIN ADD ORDERS
//==============================//
if(isset($_POST['adminAddOrder'])){
    $customer = $_POST['customer'];
    $qty = $_POST['qty'];
    $product = $_POST['product'];
    $id = $_SESSION['user_id'];

    if(empty($customer) && empty($product) && empty($qty)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../admin/order.php");
        exit();
    } else {
        $insert = "INSERT INTO tbl_order(customerID, productID, totalProduct, lastEditedBy) VALUES ('$customer','$product','$qty','$id')";
        mysqli_query($con,$insert);
        $update = "UPDATE tbl_product SET productQuantity = (productQuantity - '$qty') WHERE productID = '$product'";
        mysqli_query($con,$update);
        
        $_SESSION['status_message'] = "Order has been Successfully..";
        $_SESSION['status_code'] = "success";
        header("Location: ../admin/order.php");
        exit();
    }
}
//=============END==============//
//==============================//



//==============================//
// ADMIN SIGN UP EMPLOYEE
//==============================//
if(isset($_POST['empSignUp'])){
    $uname = mysqli_real_escape_string($con,$_POST['uname']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(empty($uname)){
        $_SESSION['status_message'] = "UserName is required!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../admin/user.php");
        exit();
    } else {
        // $uname = validate($_POST['uname']);
        if(empty($email)){
            $_SESSION['status_message'] = "Email is required!";
            $_SESSION['status_code'] = "warning";
            header("Location: ../admin/user.php");
            exit();
        } else {
            $email = validate($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['status_message'] = "Invalid Email Address.";
                $_SESSION['status_code'] = "error";
                header("Location: ../admin/user.php");
                exit(); 
            } else {
                if(empty($phone)){
                    $_SESSION['status_message'] = "Contact is required!";
                    $_SESSION['status_code'] = "warning";
                    header("Location: ../admin/user.php");
                    exit();
                } else {
                    // $pass = validate($_POST["pass"]);
                    if(empty($pass)){
                        $_SESSION['status_message'] = "Password is required!";
                        $_SESSION['status_code'] = "warning";
                        header("Location: ../admin/user.php");
                        exit();
                    } else {
                        if(strlen($pass) < 6){
                            $_SESSION['status_message'] = "Password must be longer than 6 characters";
                            $_SESSION['status_code'] = "warning";
                            header("Location: ../admin/user.php");
                            exit();
                        } else {
                            if($pass != $cpass){
                                $_SESSION['status_message'] = "Password does not matched!";
                                $_SESSION['status_code'] = "warning";
                                header("Location: ../admin/user.php");
                                exit();
                            } else {
                                $select = "SELECT * FROM tbl_user WHERE username = '$uname'";
                                $check = mysqli_query($con,$select);
                                            
                                if(mysqli_num_rows($check) > 0){
                                    $_SESSION['status_message'] = "Username is already exist...";
                                    $_SESSION['status_code'] = "error";
                                    header("Location: ../admin/user.php");
                                    exit();
                                } else {
                                    $selEmail = "SELECT * FROM tbl_user WHERE email = '$email'";
                                    $checkEmail = mysqli_query($con,$selEmail);
    
                                    if(mysqli_num_rows($checkEmail) > 0){
                                        $_SESSION['status_message'] = "Email is already exist...";
                                        $_SESSION['status_code'] = "error";
                                        header("Location: ../admin/user.php");
                                        exit();
                                    } else {
                                        $insert = "INSERT INTO tbl_user(username, phone, email, password, status) VALUES ('$uname', '$phone', '$email', password('$pass'), 'pending')";
                                        mysqli_query($con,$insert);
    
                                        $_SESSION['status_message'] = "Account has been Successfully Created..Wait for approval";
                                        $_SESSION['status_code'] = "success";
                                        header("Location: ../admin/user.php");
                                        exit();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// EMPLOYEE ADD CUSTOMER
//==============================//
if(isset($_POST['empAddCustomer'])){
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $id = $_SESSION['user_id'];

    if(empty($name) && empty($address) && empty($phone) && empty($email)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../employee/customer.php");
        exit();
    } else {
        $checkEmail = "SELECT * FROM tbl_customer WHERE customerEmail = '$email'";
        $query = mysqli_query($con,$checkEmail);

        if(mysqli_num_rows($query) > 0){
            $_SESSION['status_message'] = "Email is already exist..";
            $_SESSION['status_code'] = "warning";
            header("Location: ../employee/customer.php");
            exit();
        } else {
            $insert = "INSERT INTO tbl_customer(customerName,customerAddress,customerPhone,customerEmail,lastEditedBy) VALUES ('$name','$address','$phone','$email','$id')";
            mysqli_query($con,$insert);

            $_SESSION['status_message'] = "New Customer has been Successfully Created..";
            $_SESSION['status_code'] = "success";
            header("Location: ../employee/customer.php");
            exit();
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// EMPLOYEE ADD CATEGORY
//==============================//
if(isset($_POST['empAddCategory'])){
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
            $insert = "INSERT INTO tbl_category(categoryName,lastEditedBy) VALUES ('$name','$id')";
            mysqli_query($con,$insert);

            $_SESSION['status_message'] = "New Category has been Successfully Created..";
            $_SESSION['status_code'] = "success";
            header("Location: ../employee/category.php");
            exit();
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// EMPLOYEE ADD SUPPLIER
//==============================//
if(isset($_POST['empAddSupplier'])){
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $url = $_POST['url'];
    $id = $_SESSION['user_id'];

    if(empty($name) && empty($address) && empty($phone)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../employee/supplier.php");
        exit();
    } else {
        $checkName = "SELECT * FROM tbl_supplier WHERE supplierName = '$name'";
        $query = mysqli_query($con,$checkName);

        if(mysqli_num_rows($query) > 0){
            $_SESSION['status_message'] = "Supplier Name is already exist..";
            $_SESSION['status_code'] = "warning";
            header("Location: ../employee/supplier.php");
            exit();
        } else {
            $insert = "INSERT INTO tbl_supplier(supplierName,supplierAddress,supplierPhone,supplierURL,lastEditedBy) VALUES ('$name','$address','$phone','$url','$id')";
            mysqli_query($con,$insert);

            $_SESSION['status_message'] = "New Supplier has been Successfully Created..";
            $_SESSION['status_code'] = "success";
            header("Location: ../employee/supplier.php");
            exit();
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// EMPLOYEE ADD PRODUCT
//==============================//
if(isset($_POST['empAddProduct'])){
    $category = $_POST['category'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $supplier = $_POST['supplier'];

    $id = $_SESSION['user_id'];
    $imageName = $_FILES["photo"]["name"];
    $imageSize = $_FILES["photo"]["size"];
    $tmpName = $_FILES["photo"]["tmp_name"];

    if(empty($category) && empty($name) && empty($price) && empty($qty) && empty($supplier)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../employee/product.php");
        exit();
    } else {
        $checkName = "SELECT * FROM tbl_product WHERE productName = '$name'";
        $query = mysqli_query($con,$checkName);

        if(mysqli_num_rows($query) > 0){
            $_SESSION['status_message'] = "Product Name is already exist..";
            $_SESSION['status_code'] = "warning";
            header("Location: ../employee/product.php");
            exit();
        } else {
            // Image validation
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $imageName);
            $imageExtension = strtolower(end($imageExtension));

            if(!in_array($imageExtension, $validImageExtension)){
                $_SESSION['status_message'] = "Invalid Image Extension!";
                $_SESSION['status_code'] = "error";
                header("Location: ../employee/product.php");
                exit();
            } else if($imageSize > 1200000){
                $_SESSION['status_message'] = "Image Size Is Too Large";
                $_SESSION['status_code'] = "warning";
                header("Location: ../employee/product.php");
                exit();
            } else {
                $newImageName = $name . "-" . date("Y.m.d") . "-" . date("h.i.sa"); // Generate new image name
                $newImageName .= '.' . $imageExtension;
                $insert = "INSERT INTO tbl_product (productCategory, productName, productPhoto, productPrice, productQuantity, productSupplier, lastEditedBy) VALUES ('$category', '$name', '$newImageName', '$price', '$qty', '$supplier', '$id')";
                mysqli_query($con,$insert);
                move_uploaded_file($tmpName, '../assets/img/product/' . $newImageName);

                $_SESSION['status_message'] = "You have Successfully added new Product!";
                $_SESSION['status_code'] = "success";
                header("Location: ../employee/product.php");
                exit();
            }
        }
    }
}
//=============END==============//
//==============================//



//==============================//
// EMPLOYEE ADD ORDERS
//==============================//
if(isset($_POST['empAddOrder'])){
    $customer = $_POST['customer'];
    $qty = $_POST['qty'];
    $product = $_POST['product'];
    $id = $_SESSION['user_id'];

    if(empty($customer) && empty($product) && empty($qty)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../employee/order.php");
        exit();
    } else {
        $insert = "INSERT INTO tbl_order(customerID, productID, totalProduct, lastEditedBy) VALUES ('$customer','$product','$qty','$id')";
        mysqli_query($con,$insert);
        $update = "UPDATE tbl_product SET productQuantity = (productQuantity - '$qty') WHERE productID = '$product'";
        mysqli_query($con,$update);
        
        $_SESSION['status_message'] = "Purchase has been Successfully..";
        $_SESSION['status_code'] = "success";
        header("Location: ../employee/order.php");
        exit();
    }
}
//=============END==============//
//==============================//


?>