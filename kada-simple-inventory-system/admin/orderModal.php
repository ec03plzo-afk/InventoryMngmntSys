<div class="popup-order" id="orderDelete<?php echo $row['orderID']?>">
    <div class="form-box">
        <h3>Are you sure?</h3>

        <form action="../include/adminDelOrder.php" method="POST">

            <div class="input-box">
                <input type="hidden" name="orderID" value="<?php echo $row['orderID']?>">
                <input type="hidden" name="product" value="<?php echo $row['productID']?>">
                <input type="hidden" name="qty" value="<?php echo $row['totalProduct']?>">

                <input type="text" value="<?php echo $row['customerName']?>" disabled>
                <span class="icon"><i class="bx bxs-user"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" value="<?php echo $row['productName']?>" disabled>
                <span class="icon"><i class="bx bxs-package"></i></span>
            </div>
    
            <div class="input-box">
                <input type="text" value="<?php echo $row['totalProduct']?>" disabled>
                <span class="icon"><i class="bx bxs-component"></i></span>
            </div>

            <hr>

            <div class="close-submit">
                <button class="close-form">Cancel</button>
                <button type="submit" name="deleteOrder">Delete</button>
            </div>
        
        </form>
    </div>
</div>