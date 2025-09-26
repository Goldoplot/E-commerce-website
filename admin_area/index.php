<?php
include('../includes/connect.php');
// include the function file
include('../functions/common_function.php');
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin dashboard</title>
    <!-- bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css link -->
    <link rel="stylesheet" href="../style.css">

    <style>
        .admin_image {
            width: 100px;
            object-fit: contain;
        }

        .product_img{
            width: 30%;
            object-fit: contain;
        }
    </style>

</head>
<body>


<!-- navigation bar -->
<div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="#" alt="" class="logo"> <!-- Logo à changer -->
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <?php
                        if(isset($_SESSION['admin_name'])){
                            echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome ".$_SESSION['admin_name']."</a>
                </li>";
                        }
                        ?>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>


    <!-- second child-->
    <div class="bg-light">
        <h3 class="text-center p-2">Manage details</h3>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
        </ul>
    </nav>

    <!-- third child -->
    <div class="row">
        <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
            <div class="p-3">
                <a href="#"><img src="../img/dessert.jpg" alt=" " class="admin_image"></a>

            </div>
            <div class="button text-center">
                <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1 p-2">Insert Product</a></button>
                <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1 p-2">View Products</a></button>
                <button><a href="index.php?insert_category" class="nav-link text-light bg-info my-1 p-2">Insert Categories</a></button>
                <button><a href="index.php?view_categories" class="nav-link text-light bg-info my-1 p-2">View Categories</a></button>
                <button><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1 p-2">Insert Brands</a></button>
                <button><a href="index.php?view_brands" class="nav-link text-light bg-info my-1 p-2">View Brands</a></button>
                <button><a href="index.php?list_orders" class="nav-link text-light bg-info my-1 p-2">All orders</a></button>
                <button><a href="index.php?list_payment" class="nav-link text-light bg-info my-1 p-2">All payment</a></button>
                <button><a href="index.php?list_users" class="nav-link text-light bg-info my-1 p-2">List users</a></button>
                <button><a href="admin_logout.php" class="nav-link text-light bg-info my-1 p-2">Logout</a></button>
            </div>
        </div>
    </div>

        <!-- fourth child -->
        <div class="container my-5">
            <?php
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_brand'])){
                include('insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }
            if(isset($_GET['edit_product'])){
                include('edit_product.php');
            }
            if(isset($_GET['delete_product'])){
                include('delete_product.php');
            }
            if(isset($_GET['view_categories'])){
                include('view_categories.php');
            }
            if(isset($_GET['view_brands'])){
                include('view_brands.php');
            }
            if(isset($_GET['edit_category'])){
                include('edit_category.php');
            }
            if(isset($_GET['edit_brand'])){
                include('edit_brand.php');
            }
            if(isset($_GET['delete_category'])){
                include('delete_category.php');
            }
            if(isset($_GET['delete_brand'])){
                include('delete_brand.php');
            }
            if(isset($_GET['list_orders'])){
                include('list_orders.php');
            }
            if(isset($_GET['delete_order'])){
                include('delete_order.php');
            }
            if(isset($_GET['list_payment'])){
                include('list_payment.php');
            }
            if(isset($_GET['list_users'])){
                include('list_users.php');
            }
            if(isset($_GET['delete_user'])){
                include('delete_user.php');
            }
            ?>
        </div>

        <!-- last child -->
    <!-- include footer -->
    <?php include('../includes/footer.php'); ?>
</div>


<!-- bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html>