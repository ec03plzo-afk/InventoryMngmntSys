<div class="popup-purchase" id="purchaseDelete<?php echo $row['purchaseID']?>">
    <div class="form-box">
        <h3>Are you sure?</h3>

        <form action="../include/adminDelPurchase.php" method="POST">

            <div class="input-box">
                <input type="hidden" name="purchaseID" value="<?php echo $row['purchaseID']?>">
                <input type="hidden" name="name" value="<?php echo $row['productID']?>">
                <input type="hidden" name="qty" value="<?php echo $row['quantity']?>">
                <input type="text" value="<?php echo $row['productName']?>" disabled>
                <span class="icon"><i class="bx bxs-package"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" value="<?php echo $row['quantity']?>" disabled>
                <span class="icon"><i class="bx bxs-component"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" value="<?php echo $row['supplierName']?>" disabled>
                <span class="icon"><i class="bx bxs-truck"></i></span>
            </div>

            <hr>

            <div class="close-submit">
                <button class="close-form">Cancel</button>
                <button type="submit" name="deletePurchase">Delete</button>
            </div>
        
        </form>
    </div>
</div>