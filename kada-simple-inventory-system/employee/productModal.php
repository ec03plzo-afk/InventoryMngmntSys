<div class="popup-product" id="productDelete<?php echo $row['productID']?>">
    <div class="form-box">
        <h3>Are you sure?</h3>

        <form action="../include/empDelProduct.php" method="POST">

            <div class="input-box">
                <input type="hidden" name="productID" value="<?php echo $row['productID']?>">
                <input type="text" value="<?php echo $row['categoryName']?>" disabled>
                <span class="icon"><i class="bx bxs-category"></i></span>
            </div>

            <div class="input-box">
                <input type="text" value="<?php echo $row['productName']?>" disabled>
                <span class="icon"><i class="bx bxs-package"></i></span>
            </div>

            <div class="input-box">
                <img src="../assets/img/product/<?php echo $row['productPhoto']?>" style="border-radius:10%;" width="60px"; height="60px"; alt="Product">
            </div>
            
            <div class="input-box">
                <input type="text" value="<?php echo $row['productPrice']?>" disabled>
                <span class="icon"><i class="bx bxs-purchase-tag"></i></span>
            </div>

            <div class="input-box">
                <input type="text" value="<?php echo $row['productQuantity']?>" disabled>
                <span class="icon"><i class="bx bxs-component"></i></span>
            </div>

            <div class="input-box">
                <input type="text" value="<?php echo $row['supplierName']?>" disabled>
                <span class="icon"><i class="bx bxs-truck"></i></span>
            </div>

            <hr>

            <div class="close-submit">
                <button class="close-form">Cancel</button>
                <button type="submit" name="deleteProduct">Delete</button>
            </div>
        
        </form>
    </div>
</div>



<div class="popup-product" id="productEdit<?php echo $row['productID']?>">
    <div class="form-box">
        <h3>Update Product?</h3>

        <form action="../include/empEditProduct.php" method="POST">   
            
            <div class="input-box">
                <input type="hidden" name="productID" value="<?php echo $row['productID']?>">
                <input type="text" name="productName" value="<?php echo $row['productName']?>" required>
                <span class="icon"><i class="bx bxs-package"></i></span>
            </div>

            <div class="input-box">
                <input type="text" name="price" value="<?php echo $row['productPrice']?>" required>
                <span class="icon"><i class="bx bxs-purchase-tag"></i></span>
            </div>

            <div class="input-box">
                <input type="text" name="qty" value="<?php echo $row['productQuantity']?>" required>
                <span class="icon"><i class="bx bxs-component"></i></span>
            </div>

            <div class="input-box">  
                <select name="category">
                    <option value="" disabled selected>Choose Category..</option>
                    <?php
                        $sql = "SELECT * FROM tbl_category WHERE categoryStatus ='1'";
                        $query = mysqli_query($con,$sql);
                        if(mysqli_num_rows($query) > 0){
                            while($row = mysqli_fetch_array($query)){
                    ?>
                    <option value="<?php echo $row['categoryID'];?>"><?php echo $row['categoryName'];?></option>
                    <?php
                            }
                        }
                    ?>
                </select>       
            </div>

            <div class="input-box">
                <select name="supplier">
                    <option value="" disabled selected>Choose Supplier..</option>
                    <?php
                        $sql = "SELECT * FROM tbl_supplier WHERE supplierStatus = '1'";
                        $query = mysqli_query($con,$sql);
                        if(mysqli_num_rows($query) > 0){
                            while($row = mysqli_fetch_array($query)){
                    ?>
                    <option value="<?php echo $row['supplierID'];?>"><?php echo $row['supplierName'];?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>

            <hr>

            <div class="close-submit">
                <button type="submit" name="updateProduct">Submit</button>
                <button class="close-form">Close</button>
            </div>
        
        </form>
    </div>
</div>