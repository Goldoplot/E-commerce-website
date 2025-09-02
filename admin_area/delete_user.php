<?php
if(isset($_GET['delete_user'])){
    $user_id = $_GET['delete_user'];
    $delete_user = "DELETE FROM `user_table` WHERE user_id='$user_id'";
    $result_delete = mysqli_query($con, $delete_user);
    if($result_delete){
        echo "<script>alert('User has been deleted successfully');
        window.open('index.php?list_users','_self')</script>";
    }
}
?>