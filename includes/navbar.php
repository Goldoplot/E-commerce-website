<?php
// includes/navbar.php
?>

<!-- Navigation bar -->
<div class="container-fluid p-0">
    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid p-0">
            <a class="navbar-brand" href="<?php echo isset($home_path) ? $home_path : './'; ?>index.php">
                <?php
                $brand_text = isset($brand_name) ? $brand_name : 'My E-commerce Store';
                if(isset($brand_logo) && $brand_logo): ?>
                    <img src="<?php echo $brand_logo; ?>" alt="Logo" class="logo">
                <?php else: ?>
                    <?php echo $brand_text; ?>
                <?php endif; ?>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>"
                           href="<?php echo isset($home_path) ? $home_path : './'; ?>index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'display_all.php') ? 'active' : ''; ?>"
                           href="<?php echo isset($home_path) ? $home_path : './'; ?>display_all.php">Products</a>
                    </li>

                    <?php if(isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo isset($users_path) ? $users_path : './users_area/'; ?>profile.php">My Account</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo isset($users_path) ? $users_path : './users_area/'; ?>user_registration.php">Register</a>
                        </li>
                    <?php endif; ?>

                    <?php if(isset($show_dropdown) && $show_dropdown): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                More
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">About Us</a></li>
                                <li><a class="dropdown-item" href="#">Contact</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Support</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'cart.php') ? 'active' : ''; ?>"
                           href="<?php echo isset($home_path) ? $home_path : './'; ?>cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <sup><?php cart_item(); ?></sup>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Total: <?php total_cart_price(); ?></a>
                    </li>
                </ul>

                <!-- Search Form -->
                <form class="d-flex" action="<?php echo isset($home_path) ? $home_path : './'; ?>search_product.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search" name="Search_data">
                    <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                </form>
            </div>
        </div>
    </nav>

    <!-- Call cart function if on cart page -->
    <?php if(isset($call_cart_function) && $call_cart_function): ?>
        <?php cart(); ?>
    <?php endif; ?>

    <!-- Secondary Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
            <?php if(!isset($_SESSION['username'])): ?>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='<?php echo isset($users_path) ? $users_path : './users_area/'; ?>user_login.php'>Login</a>
                </li>
            <?php else: ?>
                <li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome <?php echo $_SESSION['username']; ?></a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='<?php echo isset($users_path) ? $users_path : './users_area/'; ?>logout.php'>Logout</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Store Header -->
    <div class="bg-light store-header">
        <h3 class="text-center"><?php echo isset($store_title) ? $store_title : 'My E-commerce Store'; ?></h3>
        <p class="text-center"><?php echo isset($store_subtitle) ? $store_subtitle : 'Quality products for everyone'; ?></p>
    </div>
</div>