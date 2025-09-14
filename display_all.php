<?php
// display_all.php - Version refactorisée

// Configuration spécifique à cette page
$page_title = "All Products - Ecommerce Store";
$brand_name = "Demo Store";
$store_title = "My Potential E-commerce";
$store_subtitle = "Practice is the key to learn";
$show_dropdown = true;
$call_cart_function = true; // Active la fonction cart() dans navbar

// Inclusions nécessaires
include('includes/connect.php');
include('functions/common_function.php');
session_start();

// Inclusion de l'en-tête
include('includes/header.php');

// Inclusion de la navbar
include('includes/navbar.php');
?>

    <!-- Main Content Area -->
    <div class="row">
        <!-- Products Section -->
        <div class="col-md-10">
            <div class="row px-3">
                <?php
                // Appel des fonctions spécifiques à cette page
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
// Inclusion du footer et scripts
include('includes/footer.php');
include('includes/footer_scripts.php');
?>