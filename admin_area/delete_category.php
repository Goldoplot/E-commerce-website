<?php
if(isset($_GET['delete_category'])){
    $category_id = $_GET['delete_category'];
    $delete_category = "DELETE FROM `categories` WHERE category_id='$category_id'";
    $result = mysqli_query($con, $delete_category);
    if($result){
        echo "<script>alert('Category deleted successfully')</script>";
        echo "<script>window.open('index.php?view_categories','_self')</script>";
    }
}
?>