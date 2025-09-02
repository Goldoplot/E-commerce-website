<?php
if(isset($_GET['delete_order'])){
    $order_id = $_GET['delete_order'];
    $delete_order = "DELETE FROM `user_orders` WHERE order_id='$order_id'";
    $result_delete = mysqli_query($con, $delete_order);
    if($result_delete){
        echo "<script>alert('Product has been deleted successfully');
        window.open('index.php?list_orders','_self')</script>";
    }
}
?>