
<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User registration</title>
    <!-- bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Registration</h2>
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-lg-12 col-xl-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- username field -->
                        <div class="form-outline mb-4">
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" id="user_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="user_username"/>
                        </div>
                        <!-- user_email field -->
                        <div class="form-outline mb-4">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="text" id="user_email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="user_email"/>
                        </div>
                        <!-- user_image field -->
                        <div class="form-outline mb-4">
                            <label for="user_image" class="form-label">User Image</label>
                            <input type="file" id="user_image" class="form-control" required="required" name="user_image"/>
                        </div>
                        <!-- user_password -->
                        <div class="form-outline mb-4">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
                        </div>
                        <!-- confirm user_password -->
                        <div class="form-outline mb-4">
                            <label for="user_confirm_password" class="form-label">Confirm</label>
                            <input type="password" id="user_confirm_password" class="form-control" placeholder="Confirm your password" autocomplete="off" required="required" name="user_confirm_password"/>
                        </div>
                        <!-- address field -->
                        <div class="form-outline mb-4">
                            <label for="user_address" class="form-label">Address</label>
                            <input type="text" id="user_address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="user_address"/>
                        </div>
                        <!-- contact field -->
                        <div class="form-outline mb-4">
                            <label for="user_contact" class="form-label">Contact</label>
                            <input type="text" id="user_contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" name="user_contact"/>
                        </div>
                        <div class="text-center">
                            <input type="submit" value="Register" class="btn btn-info btn-lg" name="user_register"/>
                            <p class="small fw-bold mt-2 pt-1 mb-0">You have an account ? <a href="user_login.php" class="link-danger">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>

</body>
</html>

<?php
    if(isset($_POST['user_register'])) {
        $user_username = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $password_hash = password_hash($user_password, PASSWORD_DEFAULT);
        $user_confirm_password = $_POST['user_confirm_password'];
        $user_address = $_POST['user_address'];
        $user_contact = $_POST['user_contact'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        $user_ip = getIPAddress();

        // select query
        $select_query="Select * from `user_table` where `username`='$user_username' or `user_email`='$user_email'";
        $result=mysqli_query($con, $select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0) {
            echo "<script>alert('Username or Email already exists')</script>";
        }else if($user_password!=$user_confirm_password){
            echo "<script>alert('Passwords do not match')</script>";
        }
        else{
                // insert query
                move_uploaded_file($user_image_tmp, "./user_images/$user_image");
                $insert_query = "insert into `user_table` (username, user_email, user_password, user_image, user_ip_address, user_address, user_mobile) 
                                    values ('$user_username', '$user_email', '$password_hash', '$user_image', '$user_ip', '$user_address', '$user_contact')";
                $sql_execute = mysqli_query($con, $insert_query);
                if($sql_execute) {
                    echo "<script>alert('User Registration Successful');</script>";
                }else{
                    die(mysqli_error($con));
                }
                // selecting cart items
                $select_cart_items = "Select * from `cart_details` where ip_address='$user_ip'";
                $result_cart = mysqli_query($con, $select_cart_items);
                $rows_count = mysqli_num_rows($result_cart);
                if($rows_count>0) {
                    $_SESSION['username'] = $user_username;
                    echo "<script>alert('Products in your cart');</script>";
                    echo "<script>window.open('checkout.php','_self')</script>";
                }else{
                    echo "<script>window.open('../index.php','_self')</script>";
                }
            }
        }

    ?>