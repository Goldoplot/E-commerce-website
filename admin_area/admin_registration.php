<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Registration</title>
    <!-- bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css link -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container-fluid m-3">
    <h1 class="text-center">Admin Registration</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="admin_name" class="form-label">Admin Name</label>
            <input type="text" id="admin_name" class="form-control" placeholder="Enter your name" autocomplete="off" required="required" name="admin_name">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="admin_email" class="form-label">Admin Email</label>
            <input type="email" id="admin_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="admin_email">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="admin_password" class="form-label">Admin Password</label>
            <input type="password" id="admin_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="admin_password">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" placeholder="Enter the same password " autocomplete="off" required="required" class="form-control" name="admin_confirm_password">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" class="btn btn-info mb-3 px-3" value="Register" name="admin_registration">

            <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="admin_login.php" class="link-danger">Login</a></p>
</div>
</body>
<?php
if(isset($_POST['admin_registration'])) {
    $admin_username = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $password_hash = password_hash($admin_password, PASSWORD_DEFAULT);
    $admin_confirm_password = $_POST['admin_confirm_password'];

    // select query
    $select_query="Select * from `admin_table` where `admin_name`='$admin_username' or `admin_email`='$admin_email'";
    $result=mysqli_query($con, $select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0) {
        echo "<script>alert('username or Email already exists')</script>";
    }else if($admin_password!=$admin_confirm_password){
        echo "<script>alert('Passwords do not match')</script>";
    }
    else{
        // insert query
        $insert_query = "insert into `admin_table` (admin_name, admin_email, admin_password) 
                                    values ('$admin_username', '$admin_email', '$password_hash')";
        $sql_execute = mysqli_query($con, $insert_query);
        if($sql_execute) {
            echo "<script>alert('admin Registration Successful');</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }else{
            die(mysqli_error($con));
        }
    }
}

?>