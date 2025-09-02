<?php
include('../includes/connect.php');
include('../functions/common_function.php');
//@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<!-- php code to access user id -->
    <?php
        $user_ip_address=getIPAddress();
        $get_user="select * from `user_table` where user_ip_address='$user_ip_address'";
        $result=mysqli_query($con,$get_user);
        $run_user=mysqli_fetch_array($result);
        $user_id = $run_user['user_id'];
    ?>


    <div class="container-fluid p-0">
        <!-- Payment Options -->
        <div class="container my-5">
            <h2 class="text-center mb-4">Choose Your Payment Method</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">PayPal</h5>
                            <p class="card-text">Secure and fast payment through PayPal.</p>
                            <a href="https://www.paypal.com" class="btn btn-primary">Pay with PayPal</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Credit/Debit Card</h5>
                            <p class="card-text">We accept Visa, MasterCard, and American Express.</p>
                            <a href="card_payment.php" class="btn btn-primary">Pay with Card</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Credit/Debit Card offline</h5>
                            <p class="card-text">We accept Visa, MasterCard, and American Express.</p>
                            <a href="order.php?user_id=<?php echo $user_id ?>" class="btn btn-primary">Pay offline</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS Bundle -->
</body>