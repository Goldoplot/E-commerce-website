<?php

// specific configurations for users_area
$page_title = "Welcome " . (isset($_SESSION['username']) ? $_SESSION['username'] : 'User');
$brand_name = "Demo Store";
$store_title = "My potential ecommerce";
$store_subtitle = "Practice is the key to learn";
$show_dropdown = true;
$call_cart_function = true;
$css_path = "../";
$home_path = "../";
$users_path = "./";

// Includes and session start
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();

// optional config with default values
if (file_exists('../includes/config.php')) {
    include('../includes/config.php');
    // Override defaults if variables are set
    $default_page_config['css_path'] = "../";
    $default_page_config['home_path'] = "../";
    $default_page_config['users_path'] = "./";

    setup_page_config([
            'page_title' => $page_title,
            'brand_name' => $brand_name,
            'store_title' => $store_title,
            'store_subtitle' => $store_subtitle,
            'show_dropdown' => $show_dropdown,
            'call_cart_function' => $call_cart_function
    ]);
}

// Custom inline CSS for profile page
$inline_css = '
    .profile_image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #17a2b8;
        transition: transform 0.3s ease;
    }
    .profile_image:hover {
        transform: scale(1.05);
    }
    .profile-sidebar {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        min-height: calc(100vh - 200px);
        border-radius: 0 10px 10px 0;
    }
    .profile-sidebar .nav-link {
        transition: all 0.3s ease;
        margin: 2px 0;
        border-radius: 5px;
    }
    .profile-sidebar .nav-link:hover {
        background-color: rgba(255,255,255,0.1);
        transform: translateX(10px);
    }
    .profile-content {
        background-color: #f8f9fa;
        min-height: calc(100vh - 200px);
        padding: 30px;
        border-radius: 10px 0 0 10px;
        box-shadow: inset 0 0 20px rgba(0,0,0,0.05);
    }
';

// header inclusion with paths adjusted
include('../includes/header.php');

// navbar inclusion with paths adjusted
?>

    <!-- navbar for user_area -->
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
                        <li class="nav-item">
                            <a class="nav-link active" href="profile.php">My Account</a>
                        </li>
                        <?php if($show_dropdown): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    More
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Help</a></li>
                                    <li><a class="dropdown-item" href="#">Contact</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Support</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="../cart.php">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <sup><?php cart_item(); ?></sup>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total price <?php total_cart_price(); ?></a>
                        </li>
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search products..." name="Search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- Cart function call -->
        <?php if($call_cart_function) cart(); ?>

        <!-- Secondary navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php if(isset($_SESSION['username'])): ?>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome <?php echo $_SESSION['username']; ?></a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='logout.php'>Logout</a>
                    </li>
                <?php else: ?>
                    <li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome Guest</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='user_login.php'>Login</a>
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

    <!-- Profile Content -->
    <div class="container-fluid">
        <div class="row g-0">
            <!-- Profile Sidebar -->
            <div class="col-md-2 profile-sidebar">
                <ul class="navbar-nav text-center py-3">
                    <li class="nav-item bg-info mb-3 rounded">
                        <a class="nav-link text-light py-3" href="#">
                            <h4><i class="fas fa-user-circle"></i> Your Profile</h4>
                        </a>
                    </li>

                    <!-- User Image -->
                    <?php
                    if(isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        $user_image_query = "SELECT * FROM `user_table` WHERE username='$username'";
                        $result_image = mysqli_query($con, $user_image_query);
                        $row_image = mysqli_fetch_array($result_image);
                        $user_image = $row_image['user_image'];

                        echo "<li class='nav-item mb-3'>
                            <img src='./user_images/$user_image' class='profile_image' alt='Profile image'>
                          </li>";
                    }
                    ?>

                    <!-- Profile Menu -->
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php">
                            <i class="fas fa-clock"></i> Pending Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?edit_account">
                            <i class="fas fa-user-edit"></i> Edit Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="profile.php?my_orders">
                            <i class="fas fa-shopping-bag"></i> My Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light text-warning" href="profile.php?delete_account">
                            <i class="fas fa-user-times"></i> Delete Account
                        </a>
                    </li>
                    <li class="nav-item border-top mt-3 pt-3">
                        <a class="nav-link text-light" href="logout.php">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-10 profile-content">
                <?php
                // Display user details by default
                get_user_details();

                // Include different sections based on URL parameters
                if(isset($_GET['edit_account'])){
                    include('edit_account.php');
                }
                if(isset($_GET['my_orders'])){
                    include('user_orders.php');
                }
                if(isset($_GET['delete_account'])){
                    include('delete_account.php');
                }
                ?>
            </div>
        </div>
    </div>

<?php
// footer and scripts
include('../includes/footer.php');
include('../includes/footer_scripts.php');
?>