<?php
// search_product.php - Version refactorisée

// Configuration spécifique à cette page
$search_term = isset($_GET['Search_data']) ? $_GET['Search_data'] : '';
$page_title = $search_term ? "Search Results for '$search_term'" : "Search Products";
$brand_name = "Demo Store";
$store_title = "My Potential E-commerce";
$store_subtitle = "Practice is the key to learn";
$show_dropdown = true;
$call_cart_function = true;

// Inclusions nécessaires
include('includes/connect.php');
include('functions/common_function.php');
session_start();

// Configuration optionnelle avec config.php
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

// CSS spécifique pour la recherche
$inline_css = '
    .search-results-header {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        text-align: center;
    }
    .search-term {
        background-color: rgba(255,255,255,0.2);
        padding: 5px 15px;
        border-radius: 20px;
        display: inline-block;
        margin: 10px 0;
    }
    .no-results {
        text-align: center;
        padding: 50px 20px;
        color: #6c757d;
    }
    .no-results i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }
';

// Inclusion de l'en-tête et navigation
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
                    // Vérifier s'il y a des résultats avant d'afficher
                    if($search_term) {
                        // Appel de la fonction de recherche
                        search_product();
                    } else {
                        echo "<div class='no-results col-12'>
                            <i class='fas fa-search'></i>
                            <h3>Start Your Search</h3>
                            <p>Enter a product name or keyword in the search box above to find what you're looking for.</p>
                          </div>";
                    }

                    // Fonctions pour les catégories et marques
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
// Inclusion du footer et scripts
include('includes/footer.php');
include('includes/footer_scripts.php');
?>