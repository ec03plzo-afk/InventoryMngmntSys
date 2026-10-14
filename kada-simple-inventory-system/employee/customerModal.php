<div class="popup-customer" id="customerEdit<?php echo $row['customerID']?>">
    <div class="form-box">
        <h3>Update Customer?</h3>
        
        <form action="../include/empEditCus.php" method="POST">
            
            <div class="input-box">
                <input type="hidden" name="customerID" value="<?php echo $row['customerID']?>">
                <input type="text" name="name" value="<?php echo $row['customerName']?>" required>
                <span class="icon"><i class="bx bxs-user"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" name="address" value="<?php echo $row['customerAddress']?>" required>
                <span class="icon"><i class="bx bxs-map"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" name="phone" value="<?php echo $row['customerPhone']?>" required>
                <span class="icon"><i class="bx bxs-phone"></i></span>
            </div>

            <div class="input-box">
                <input type="text" name="email" value="<?php echo $row['customerEmail']?>" required>
                <span class="icon"><i class="bx bxs-envelope"></i></span>
            </div>

            <hr>

            <div class="close-submit">
                <button type="submit" name="updateCustomer">Submit</button>
                <button class="close-form-edit">Close</button>
            </div>
        
        </form>
    </div>
</div>


<div class="popup-customer" id="customerDelete<?php echo $row['customerID']?>">
    <div class="form-box">
        <h3>Are you sure?</h3>
        
        <form action="../include/empDelCus.php" method="POST">
            
            <div class="input-box">
                <input type="hidden" name="customerID" value="<?php echo $row['customerID']?>">
                <input type="text" name="name" value="<?php echo $row['customerName']?>" disabled>
                <span class="icon"><i class="bx bxs-user"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" name="address" value="<?php echo $row['customerAddress']?>" disabled>
                <span class="icon"><i class="bx bxs-map"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" name="phone" value="<?php echo $row['customerPhone']?>" disabled>
                <span class="icon"><i class="bx bxs-phone"></i></span>
            </div>

            <div class="input-box">
                <input type="text" name="email" value="<?php echo $row['customerEmail']?>" disabled>
                <span class="icon"><i class="bx bxs-envelope"></i></span>
            </div>

            <hr>

            <div class="close-submit">
                <button class="close-form-edit">Cancel</button>
                <button type="submit" name="deleteCustomer">Delete</button>
            </div>
        
        </form>
    </div>
</div>