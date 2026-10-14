<div class="popup-category" id="categoryEdit<?php echo $row['categoryID']?>">
    <div class="form-box">
        <h3>Update Category?</h3>
        
        <form action="../include/empEditCateg.php" method="POST">
            
            <div class="input-box">
                <input type="hidden" name="categoryID" value="<?php echo $row['categoryID']?>">
                <input type="text" name="name" value="<?php echo $row['categoryName']?>" required>
                <span class="icon"><i class="bx bxs-category"></i></span>
            </div>

            <hr>

            <div class="close-submit">
                <button type="submit" name="updateCategory">Submit</button>
                <button class="close-form-edit">Close</button>
            </div>
        
        </form>
    </div>
</div>


<div class="popup-category" id="categoryDelete<?php echo $row['categoryID']?>">
    <div class="form-box">
        <h3>Are you sure?</h3>
        
        <form action="../include/empDelCateg.php" method="POST">
            
            <div class="input-box">
                <input type="hidden" name="categoryID" value="<?php echo $row['categoryID']?>">
                <input type="text" name="name" value="<?php echo $row['categoryName']?>" disabled>
                <span class="icon"><i class="bx bxs-user"></i></span>
            </div>

            <hr>

            <div class="close-submit">
                <button class="close-form-edit">Cancel</button>
                <button type="submit" name="deleteCategory">Delete</button>
            </div>
        
        </form>
    </div>
</div>