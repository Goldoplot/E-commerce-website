<?php

// specific config for the page
$search_term = isset($_GET['Search_data']) ? $_GET['Search_data'] : '';
$page_title = $search_term ? "Search Results for '$search_term'" : "Search Products";
$brand_name = "Demo Store";
$store_title = "My Potential E-commerce";
$store_subtitle = "Practice is the key to learn";
$show_dropdown = true;
$call_cart_function = true;

// necessary includes and session start
include('includes/connect.php.bak');
include('functions/common_function.php');
session_start();

// optional config include
if (file_exists('includes/config.php')) {
    include('includes/config.php');
    setup_page_config([
            'page_title' => $page_title,
            'brand_name' => $brand_name,
            'store_title' => $store_title,
            'store_subtitle' => $store_subtitle,
            'show_dropdown' => $show_dropdown,
            'call_cart_function' => $call_cart_function
    ]);
}

// header and navbar
include('includes/header.php');
include('includes/navbar.php');
?>

    <!-- Search Results Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10">
                <!-- Search Results Header -->
                <?php if($search_term): ?>
                    <div class="search-results-header">
                        <h2><i class="fas fa-search"></i> Search Results</h2>
                        <div class="search-term">
                            <i class="fas fa-quote-left"></i>
                            <?php echo htmlspecialchars($search_term); ?>
                            <i class="fas fa-quote-right"></i>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="search-results-header">
                        <h2><i class="fas fa-search"></i> Search Products</h2>
                        <p>Use the search bar above to find products</p>
                    </div>
                <?php endif; ?>

                <!-- Products Grid -->
                <div class="row px-3">
                    <?php
                    // check if search term is provided
                    if($search_term) {
                        // search function
                        search_product();
                    } else {
                        echo "<div class='no-results col-12'>
                            <i class='fas fa-search'></i>
                            <h3>Start Your Search</h3>
                            <p>Enter a product name or keyword in the search box above to find what you're looking for.</p>
                          </div>";
                    }

                    // functions for brands and categories
                    get_unique_categories();
                    get_unique_brands();
                    ?>
                </div>

                <!-- Back to Products Link -->
                <div class="text-center mt-4 mb-4">
                    <a href="display_all.php" class="btn btn-outline-info">
                        <i class="fas fa-arrow-left"></i> View All Products
                    </a>
                    <a href="index.php" class="btn btn-info ms-2">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <?php
            $brands_title = "Delivery Brands";
            $categories_title = "Categories";
            include('includes/sidebar.php');
            ?>
        </div>
    </div>

<?php
// footer and scripts
include('includes/footer.php');
include('includes/footer_scripts.php');
?>