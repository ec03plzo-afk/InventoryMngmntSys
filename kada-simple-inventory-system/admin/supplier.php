<?php
    session_start();
    include('../include/config.php');
    if(!isset($_SESSION['user_id']) || !isset($_SESSION['admin_name'])){
        header('Location: ../index.php');
    }

//==============================//
// UPDATE PROFILE
//==============================//
if(isset($_POST['editSubmit'])){
    $userID = $_POST['userID'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $id = $_SESSION['user_id'];
 
    if(empty($name) && empty($address) && empty($username) && empty($phone) && empty($email)){
        $_SESSION['status_message'] = "Fill out all field!";
        $_SESSION['status_code'] = "warning";
        header("Location: ../admin/supplier.php");
        exit();
    } else {
        $sql = "UPDATE tbl_user SET name ='$name', address ='$address', phone ='$phone', email ='$email', lastEditedBy ='$id' WHERE userID = '$userID'";
        mysqli_query($con,$sql);
    
        $_SESSION['status_message'] = "Account has been Successfully Updated!";
        $_SESSION['status_code'] = "success";
        header("Location: ../admin/supplier.php");
        exit();
    }
}
//=============END==============//
//==============================//

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>

    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


    <!-- ASSETS CSS FILES -->
    <link href="../assets/css/toastr.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>
<body>
    <!-- ======= Sidebar ======= -->
    <div class="SideBar">
        <div class="logo">
            <span>KADA HARDWARE</span>
            <span class="logo-2">KADA</span>
        </div>

        <ul class="Nav_Links">
            <li>
                <a href="home.php">
                    <i class="bx bxs-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="customer.php">
                    <i class="bx bxs-user"></i>
                    <span>Customer</span>
                </a>
            </li>

            <li>
                <a href="category.php">
                    <i class="bx bxs-category"></i>
                    <span>Category</span>
                </a>
            </li>

            <li>
                <a href="supplier.php" class="active">
                    <i class="bx bxs-truck"></i>
                    <span>Supplier</span>
                </a>
            </li>

            <li>
                <a href="product.php">
                    <i class="bx bxs-package"></i>
                    <span>Product</span>
                </a>
            </li>

            <li>
                <a href="purchase.php">
                    <i class="bx bxs-shopping-bag"></i>
                    <span>Purchase</span>
                </a>
            </li>

            <li>
                <a href="order.php">
                    <i class="bx bxs-receipt"></i>
                    <span>Orders</span>
                </a>
            </li>

            <li>
                <a href="user.php">
                    <i class="bx bxs-user-account"></i>
                    <span>User Registration</span>
                </a>
            </li>
        </ul>
        
    </div><!-- End Sidebar -->


    <!-- Home Section Start -->
    <section class="Home">
        <!-- Navbar -->
        <nav>
            <div class="SideBarButton">
                <i class="bx bx-menu-alt-right"></i>
                <span class="dashboard-date">Current Date and Time:<span class="date"></span></span>
            </div>

            <div class="Profile">
                <?php
                    $id = $_SESSION['user_id'];
                    $query = "SELECT * FROM tbl_user WHERE userID ='$id'";
                    $result = mysqli_query($con,$query);
                      if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                <span><?php echo $row['email']?></span>
                <i class="bx bxs-chevron-down"></i>
                <div class="profile-menu">
                    <h3><?php echo $row['role']?> <br><span>Role</span></h3>
                    <ul>
                        <li><a href="#" id="account"><i class="bx bx-cog"></i> My Account</a></li>
                        <li><a href="../include/logout.php"><i class="bx bx-power-off"></i> Logout</a></i></li>
                    </ul>
                </div>
                <?php
                      }
                    }
                ?>
            </div>
        </nav>


        <div class="popup-profile">
            <div class="form-box">
                <h3>Update Account?</h3>
                <form action="" method="POST">
                    <?php
                        $id = $_SESSION['user_id'];
                        $sql = "SELECT * FROM tbl_user WHERE userID = '$id'";
                        $query = mysqli_query($con, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_array($query)) {
                    ?>

                    <div class="input-box">
                        <input type="hidden" name="userID" value="<?php echo $row['userID'];?>">
                        <input type="text" name="name" placeholder="Name" value="<?php echo $row['name'];?>" required>
                        <span class="icon"><i class="bx bxs-user"></i></span>
                    </div>

                    <div class="input-box">
                        <input type="text" name="address" placeholder="Address" value="<?php echo $row['address'];?>" required>
                        <span class="icon"><i class="bx bxs-map"></i></span>
                    </div>

                    <div class="input-box">
                        <input type="text" name="phone" placeholder="Phone" value="<?php echo $row['phone'];?>" required>
                        <span class="icon"><i class="bx bxs-phone"></i></span>
                    </div>

                    <div class="input-box">
                        <input type="email" name="email" placeholder="Email" value="<?php echo $row['email'];?>" required>
                        <span class="icon"><i class="bx bxs-envelope"></i></span>
                    </div>

                    <hr>

                    <div class="close-submit">
                        <button type="submit" name="editSubmit">Submit</button>
                        <button class="close-form-profile">Close</button>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </form>
            </div>
        </div>


        <?php include('message.php');?>
        <div class="popup-supplier">
            <div class="form-box">
                <h3>Add new Supplier?</h3>
                <form action="../include/server.php" method="POST">

                    <div class="input-box">
                        <input type="text" name="name" placeholder="Name" required>
                        <span class="icon"><i class="bx bxs-truck"></i></span>
                    </div>
    
                    <div class="input-box">
                        <input type="text" name="address" placeholder="Address" required>
                        <span class="icon"><i class="bx bxs-map"></i></span>
                    </div>
    
                    <div class="input-box">
                        <input type="text" name="phone" placeholder="Phone" required>
                        <span class="icon"><i class="bx bxs-phone"></i></span>
                    </div>

                    <div class="input-box">
                        <input type="text" name="url" placeholder="URL (optional)">
                        <span class="icon"><i class="bx bx-globe"></i></span>
                    </div>

                    <hr>

                    <div class="close-submit">
                        <button type="submit" name="adminAddSupplier">Submit</button>
                        <button class="close-form">Close</button>
                    </div>
        
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="table-container">
            <div class="table-header">
                <h1>Supplier</h1>

                <div class="search">
                    <input type="search" id="search" placeholder="Search..">
                </div>
                
                <button type="button" class="button-primary" id="addSupplier">
                    <span class="button-icon"><i class="bx bx-plus"></i></span>
                    <span class="button-text">Add Supplier</span>
                </button>
            </div>
            <div class="table-body">
                <table>
                    <thead>
                        <tr>
                            <th width="100">#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Last Edited by</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="record">
                        <?php
                            $query = "SELECT * FROM tbl_supplier supp LEFT JOIN tbl_user user ON supp.lastEditedBy = user.userID";
                            $result = mysqli_query($con,$query);
                            if(mysqli_num_rows($result) > 0){
                                $no = 1;
                                while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $row['supplierName']?></td>
                            <td><?php echo $row['supplierAddress']?></td>
                            <td><?php echo $row['supplierPhone']?></td>
                            <td><?php echo $row['supplierURL']?></td>
                            <td>
                                <?php
                                    if($row['supplierStatus'] == 1){
                                        echo '<span><a href="suppStatus.php?supplierID='.$row['supplierID'].'&supplierStatus=0" class="stat-active" style="color:#fff; background:#3aa856;border-radius: 5px; padding: 2px 5px;">Active</a></span>';
                                    }else{
                                        echo '<span><a href="suppStatus.php?supplierID='.$row['supplierID'].'&supplierStatus=1" class="stat-inactive" style="color:#fff; background:#e63946;border-radius: 5px; padding: 2px 5px;">Inactive</a></span>';
                                    }
                                ?>
                            </td>
                            <td><?php echo $row['email']?></td>
                            <td>
                                <a href="#" class="btn-td" data-modal-target="#supplierEdit<?php echo $row['supplierID']?>"><i class="bx bx-edit" title="Edit"></i></a>
                                <a href="#" class="btn-td" data-modal-target="#supplierDelete<?php echo $row['supplierID']?>"><i class="bx bx-trash" title="Delete"></i></a>
                            </td>
                        </tr>
                        <?php   
                                include('supplierModal.php');
                                $no++;
                                }
                            }
                        ?>
                    </tbody>
                </table>    
            </div>
        </div>
        <!-- End Content -->
        

    </section><!-- End Home Section -->

    

    
    <!-- ASSETS JS FILES -->
    <script src="../assets/js/main.js"></script>
    <script>
        const popupSupplier = document.querySelector('.popup-supplier');
        const btnAddSupplier = document.querySelector('#addSupplier');
        const btnCloseSupplier = document.querySelector('.close-form');
        btnAddSupplier.onclick = () => {
            popupSupplier.classList.add('active-modal');
        }
        btnCloseSupplier.onclick = () => {
            popupSupplier.classList.remove('active-modal');
        }

        const openModalEdit = document.querySelectorAll('[data-modal-target]');
        openModalEdit.forEach(button => {
            button.addEventListener('click', () => {
                const modal = document.querySelector(button.dataset.modalTarget)
                openModal(modal)
            })
        })
        function openModal(modal) {
            if (modal == null)return
            modal.classList.add('active-modal')
        }

        const popupProfile = document.querySelector('.popup-profile');
        const btnProfile = document.querySelector('#account');
        const btnCloseProfile = document.querySelector('.close-form-profile');
        btnProfile.onclick = () => {
            popupProfile.classList.add('active-modal');
        }
        btnCloseProfile.onclick = () => {
            popupProfile.classList.remove('active-modal');
        }

        var $rows = $('#record tr');
        $('#search').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
            
            $rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });
    </script>
    
  </body>
</html>