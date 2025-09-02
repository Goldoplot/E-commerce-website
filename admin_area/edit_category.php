<div class="container mt-3">
    <h3 class="text-center text-success">Edit Category</h3>
    <?php
    if(isset($_GET['edit_category'])){
        $category_id = $_GET['edit_category'];
        $get_category = "SELECT * FROM `categories` WHERE category_id=$category_id";
        $result = mysqli_query($con, $get_category);
        $row = mysqli_fetch_assoc($result);
        $category_title = $row['category_title'];
    }
    ?>
    <form action="" method="post" class="mt-4">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label font-weight-bold">Category Title</label>
            <input type="text" class="form-control" name="category_title" value="<?php echo $category_title; ?>" required>
        </div>
        <div class="form-outline mb-4 w-50 m-auto text-center">
            <input type="submit" class="btn btn-info" name="edit_category" value="Update Category">
        </div>
    </form>
    <?php
    if(isset($_POST['edit_category'])){
        $category_title = $_POST['category_title'];
        $update_category = "UPDATE `categories` SET category_title='$category_title' WHERE category_id=$category_id";
        $result = mysqli_query($con, $update_category);
        if($result){
            echo "<script>alert('Category updated successfully')</script>";
            echo "<script>window.open('index.php?view_categories','_self')</script>";
        }
    }
    ?>

</div>