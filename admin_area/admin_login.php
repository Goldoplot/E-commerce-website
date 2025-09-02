<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <!-- bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css link -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container-fluid m-3">
    <h1 class="text-center">Admin Login</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="admin_name" class="form-label">Admin Name</label>
            <input type="text" id="admin_name" class="form-control" placeholder="Enter your name" autocomplete="off" required="required" name="admin_name">
        </div>

        <div class="form-outline mb-4 w-50 m-auto">
            <label for="admin_password" class="form-label">Admin Password</label>
            <input type="password" id="admin_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="admin_password">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" class="btn btn-info mb-3 px-3" value="Login" name="admin_login">

            <p class="small fw-bold mt-2 pt-1">No account? <a href="admin_registration.php" class="link-danger">Register</a></p>
        </div>
</body>

<?php

if(isset($_POST['admin_login'])) {
    $admin_username = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];

    $select_query = "Select * from `admin_table` where admin_name='$admin_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if ($row_count > 0) {
        $_SESSION['admin_name'] = $admin_username;
        if (password_verify($admin_password, $row_data['admin_password'])) {
            if ($row_count == 1) {
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            } else {
                echo "<script>alert('Invalid credentials')</script>";
            }
        }else{
                echo "<script>alert('Invalid credentials')</script>";
            }
        }else{
            echo "<script>alert('Invalid credentials')</script>";
    }
}
?>