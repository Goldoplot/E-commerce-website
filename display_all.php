<?php

// specific variables for this page
$page_title = "All Products - Ecommerce Store";
$brand_name = "Demo Store";
$store_title = "My Potential E-commerce";
$store_subtitle = "Practice is the key to learn";
$show_dropdown = true;
$call_cart_function = true; // cart function

// necessary includes
include('includes/connect.php.bak');
include('functions/common_function.php');
session_start();

// header
include('includes/header.php');

// navbar
include('includes/navbar.php');
?>

    <!-- Main Content Area -->
    <div class="row">
        <!-- Products Section -->
        <div class="col-md-10">
            <div class="row px-3">
                <?php
                // functions to display products
                getproducts();
                get_unique_categories();
                get_unique_brands();
                ?>
            </div>
        </div>

        <!-- Sidebar -->
        <?php
        $brands_title = "Delivery Brands";
        $categories_title = "Categories";
        include('includes/sidebar.php');
        ?>
    </div>

<?php
// footer and scripts
include('includes/footer.php');
include('includes/footer_scripts.php');
?>