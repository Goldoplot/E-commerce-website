<?php
// index.php - Version refactorisée

// Configuration des chemins et variables pour cette page
$page_title = "Home - Ecommerce Store";
$brand_name = "Demo Store";
$store_title = "My Potential E-commerce";
$store_subtitle = "Practice is the key to learn";
$show_dropdown = true;

// Inclusions nécessaires
include('includes/connect.php');
include('functions/common_function.php');
session_start();

// calling cart function
cart();

// header and navbar
include('includes/header.php');
include('includes/navbar.php');
?>

    <!-- Main Content Area -->
    <div class="row">
        <!-- Products Section -->
        <div class="col-md-10">
            <div class="row px-3">
                <?php
                // functions to display products
                get_all_products();
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