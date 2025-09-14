<?php
// includes/sidebar.php
?>

<!-- Sidebar -->
<div class="col-md-2 bg-secondary p-0 sidebar">
    <!-- Brands Section -->
    <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light">
                <h4><?php echo isset($brands_title) ? $brands_title : 'Brands'; ?></h4>
            </a>
        </li>
        <?php getbrands(); ?>
    </ul>

    <!-- Categories Section -->
    <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light">
                <h4><?php echo isset($categories_title) ? $categories_title : 'Categories'; ?></h4>
            </a>
        </li>
        <?php getcategories(); ?>
    </ul>
</div>