<?php
if(isset($_GET['delete_product'])){
    $product_id = $_GET['delete_product'];
    $delete_query = "DELETE FROM `products` WHERE product_id=$product_id";
    $result_delete = mysqli_query($con, $delete_query);
    if($result_delete){
        echo "<script>alert('Product has been deleted successfully');
        window.open('index.php?view_products','_self')</script>";
    }
}
?>