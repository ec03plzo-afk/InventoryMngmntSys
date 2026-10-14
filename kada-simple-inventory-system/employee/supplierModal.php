<div class="popup-supplier" id="supplierEdit<?php echo $row['supplierID']?>">
    <div class="form-box">
        <h3>Update Supplier?</h3>

        <form action="../include/empEditSupp.php" method="POST">

            <div class="input-box">
                <input type="hidden" name="supplierID" value="<?php echo $row['supplierID']?>">
                <input type="text" name="name" value="<?php echo $row['supplierName']?>" required>
                <span class="icon"><i class="bx bxs-truck"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" name="address" value="<?php echo $row['supplierAddress']?>" required>
                <span class="icon"><i class="bx bxs-map"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" name="phone" value="<?php echo $row['supplierPhone']?>" required>
                <span class="icon"><i class="bx bxs-phone"></i></span>
            </div>

            <div class="input-box">
                <input type="text" name="url" value="<?php echo $row['supplierURL']?>">
                <span class="icon"><i class="bx bx-globe"></i></span>
            </div>

            <hr>

            <div class="close-submit">
                <button type="submit" name="updateSupplier">Submit</button>
                <button class="close-form">Close</button>
            </div>
        
        </form>
    </div>
</div>


<div class="popup-supplier" id="supplierDelete<?php echo $row['supplierID']?>">
    <div class="form-box">
        <h3>Are you sure?</h3>

        <form action="../include/empDelSupp.php" method="POST">

            <div class="input-box">
                <input type="hidden" name="supplierID" value="<?php echo $row['supplierID']?>">
                <input type="text" name="name" value="<?php echo $row['supplierName']?>" disabled>
                <span class="icon"><i class="bx bxs-truck"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" name="address" value="<?php echo $row['supplierAddress']?>" disabled>
                <span class="icon"><i class="bx bxs-map"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" name="phone" value="<?php echo $row['supplierPhone']?>" disabled>
                <span class="icon"><i class="bx bxs-phone"></i></span>
            </div>

            <div class="input-box">
                <input type="text" name="url" value="<?php echo $row['supplierURL']?>" disabled>
                <span class="icon"><i class="bx bx-globe"></i></span>
            </div>

            <hr>

            <div class="close-submit">
                <button class="close-form">Cancel</button>
                <button type="submit" name="deleteSupplier">Delete</button>
            </div>
        
        </form>
    </div>
</div>