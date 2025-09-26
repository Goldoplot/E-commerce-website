<?php

// specific page configurations
$page_title = "Checkout - Complete Your Order";
$brand_name = "Logo à changer";
$store_title = "Hidden Store";
$store_subtitle = "Communication is at the heart";
$show_dropdown = true;
$css_path = "../";
$home_path = "../";
$users_path = "./";

// Include database connection and start session
include('../includes/connect.php');
session_start();

// Include configuration if exists
if (file_exists('../includes/config.php')) {
    include('../includes/config.php');
    // Override default paths if not set
    $default_page_config['css_path'] = "../";
    $default_page_config['home_path'] = "../";
    $default_page_config['users_path'] = "./";

    setup_page_config([
            'page_title' => $page_title,
            'brand_name' => $brand_name,
            'store_title' => $store_title,
            'store_subtitle' => $store_subtitle,
            'show_dropdown' => $show_dropdown
    ]);
}

// Custom inline CSS for checkout page
$inline_css = '
    .checkout-container {
        background-color: #f8f9fa;
        min-height: calc(100vh - 200px);
        padding: 30px 0;
    }
    .checkout-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 40px;
        margin: 20px 0;
    }
    .checkout-header {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 30px;
    }
    .security-badge {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        margin-top: 20px;
    }
    .login-prompt {
        background: linear-gradient(135deg, #ffc107, #fd7e14);
        color: white;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
    }
';

// Include header with paths adjusted
include('../includes/header.php');
?>

    <!-- adapted navbar -->
    <div class="container-fluid p-0">
        <!-- primary navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid p-0">
                <a class="navbar-brand" href="../index.php"><?php echo $brand_name; ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <?php if($show_dropdown): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    Help
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Shipping Info</a></li>
                                    <li><a class="dropdown-item" href="#">Returns</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Support</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search products..." name="Search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- Secondary navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php if(isset($_SESSION['username'])): ?>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>
                            <i class="fas fa-user"></i> Welcome <?php echo $_SESSION['username']; ?>
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='logout.php'>
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                <?php else: ?>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>
                            <i class="fas fa-user-plus"></i> Welcome Guest
                        </a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='user_login.php'>
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Store header -->
        <div class="bg-light store-header">
            <h3 class="text-center"><?php echo $store_title; ?></h3>
            <p class="text-center"><?php echo $store_subtitle; ?></p>
        </div>
    </div>

    <!-- Checkout Content -->
    <div class="checkout-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Checkout Header -->
                    <div class="checkout-header">
                        <h2><i class="fas fa-shopping-cart"></i> Secure Checkout</h2>
                        <p class="mb-0">Complete your purchase safely and securely</p>
                    </div>

                    <!-- Main Checkout Card -->
                    <div class="checkout-card">
                        <?php if(!isset($_SESSION['username'])): ?>
                            <!-- Login Required Section -->
                            <div class="login-prompt">
                                <h3><i class="fas fa-lock"></i> Login Required</h3>
                                <p class="mb-4">Please log in to your account to complete your purchase</p>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="user_login.php" class="btn btn-light btn-lg">
                                        <i class="fas fa-sign-in-alt"></i> Login to Continue
                                    </a>
                                    <a href="user_registration.php" class="btn btn-outline-light btn-lg">
                                        <i class="fas fa-user-plus"></i> Create Account
                                    </a>
                                </div>
                            </div>

                            <!-- Guest Checkout Option -->
                            <div class="text-center mt-4">
                                <hr class="my-4">
                                <p class="text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Don't have an account? You can still checkout as a guest, but you won't be able to track your order.
                                </p>
                            </div>

                            <!-- Include Login Form -->
                            <?php include('user_login.php'); ?>

                        <?php else: ?>
                            <!-- User is Logged In - Show Payment -->
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="text-success mb-4">
                                        <i class="fas fa-check-circle"></i>
                                        Hello <?php echo $_SESSION['username']; ?>, you're logged in!
                                    </h4>

                                    <!-- Include Payment Form -->
                                    <?php include('payment.php'); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Security Information -->
                        <div class="security-badge">
                            <h5><i class="fas fa-shield-alt"></i> Your Security Matters</h5>
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <i class="fas fa-lock fa-2x mb-2"></i>
                                    <small>SSL Encrypted</small>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-credit-card fa-2x mb-2"></i>
                                    <small>Secure Payment</small>
                                </div>
                                <div class="col-md-4">
                                    <i class="fas fa-user-shield fa-2x mb-2"></i>
                                    <small>Privacy Protected</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Links -->
                    <div class="text-center mt-4">
                        <a href="../cart.php" class="btn btn-outline-secondary me-3">
                            <i class="fas fa-arrow-left"></i> Back to Cart
                        </a>
                        <a href="../index.php" class="btn btn-outline-info">
                            <i class="fas fa-home"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
// Footer inclusion
include('../includes/footer.php');
include('../includes/footer_scripts.php');
?>