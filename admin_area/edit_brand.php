<div class="container my-3">
    <h2 class="text-center text-success">Edit brand</h2>
    <?php
    if (isset($_GET['edit_brand'])) {
        $brand_id = $_GET['edit_brand'];
        $get_brand = "SELECT * FROM `brands` WHERE brand_id='$brand_id'";
        $result = mysqli_query($con, $get_brand);
        $row = mysqli_fetch_assoc($result);
        $brand_title = $row['brand_title'];
    }
    ?>
    <form action="" method="post" class="mt-4">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label font-weight-bold">brand Title</label>
            <input type="text" class="form-control" name="brand_title" value="<?php echo $brand_title; ?>" required>
        </div>
        <div class="form-outline mb-4 w-50 m-auto text-center">
            <input type="submit" class="btn btn-info" name="edit_brand" value="Update brand">
        </div>
    </form>
    <?php
    if (isset($_POST['edit_brand'])) {
        $brand_title = $_POST['brand_title'];
        $update_brand = "UPDATE `brands` SET brand_title='$brand_title' WHERE brand_id='$brand_id'";
        $result = mysqli_query($con, $update_brand);
        if ($result) {
            echo "<script>alert('brand updated successfully')</script>";
            echo "<script>window.open('index.php?view_brands','_self')</script>";
        }
    }
    ?>

</div>