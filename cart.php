<!--connect file-->
<?php
include('includes/connect.php');
// include the function file
include('functions/common_function.php');
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ecommerce website - Cart details</title>
    <!-- bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <!-- font awesome link -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation bar -->
<div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid p-0">
            <a class="navbar-brand" href="#">Logo à changer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display_all.php">Products</a>
                    </li>
                    <?php
                    if(isset($_SESSION['username'])){
                        echo "<li class=\"nav-item\">
                                        <a class=\"nav-link\" href=\"./users_area/profile.php\">My Account</a>
                                    </li>";
                    }else{
                        echo "<li class=\"nav-item\">
                                            <a class=\"nav-link\" href=\"./users_area/user_registration.php\">Register</a>
                                        </li>";
                    };
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <sup><?php cart_item(); ?></sup>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- calling cart function -->
    <?php cart(); ?>

    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
            <?php
            if(!isset($_SESSION['username'])){
                echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome guest</a>
                </li>";
            }else{
                echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
                </li>";
            }
            if(!isset($_SESSION['username'])){
                echo "<li class='nav-item'>
                    <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                </li>";
            }else{
                echo "<li class='nav-item'>
                    <a class='nav-link' href='./users_area/logout.php'>Logout</a>
                </li>";
            }
            ?>
        </ul>
    </nav>

    <!-- third child -->
    <div class="bg-light">
        <h3 class="text-center">Hidden Store</h3>
        <p class="text-center">Communication is at the heart</p>
    </div>
</div>

<!-- fourth child table -->
<div class="container">
    <div class="row">
        <form action="" method="post">
            <table class="table table-bordered text-center">

                <?php
                $get_ip_address = getIPAddress();

                // 1️⃣ Mise à jour des quantités si formulaire soumis
                if(isset($_POST['update_cart'])){
                    if(isset($_POST['qty'])){
                        foreach($_POST['qty'] as $product_id => $quantity){
                            $quantity = intval($quantity); // sécurité
                            if($quantity > 0){
                                $update_cart = "UPDATE `cart_details` 
                                SET quantity=$quantity 
                                WHERE ip_address='$get_ip_address' 
                                AND product_id=$product_id";
                                mysqli_query($con, $update_cart);
                            }
                        }
                    }
                }

                // 2️⃣ Supprimer des articles si demandé
                if(isset($_POST['remove_cart'])){
                    if(isset($_POST['removeitem'])){
                        foreach($_POST['removeitem'] as $remove_id){
                            $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id AND ip_address='$get_ip_address'";
                            mysqli_query($con, $delete_query);
                        }
                    }
                }

                // 3️⃣ Récupérer à nouveau le panier après update/suppression
                $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
                $result = mysqli_query($con, $cart_query);
                $result_count = mysqli_num_rows($result);

                $total_price = 0;

                if($result_count > 0){
                    echo "
    <table class='table table-bordered text-center'>
        <thead>
            <tr>
                <th>Product title</th>
                <th>Product image</th>
                <th>Quantity</th>
                <th>Total price</th>
                <th>Remove</th>
                <th colspan='2'>Operations</th>
            </tr>
        </thead>
        <tbody>
    ";

                    while($row = mysqli_fetch_array($result)){
                        $product_id = $row['product_id'];
                        $quantity = $row['quantity'];

                        $select_product = "SELECT * FROM `products` WHERE product_id='$product_id'";
                        $result_product = mysqli_query($con, $select_product);
                        $row_product = mysqli_fetch_array($result_product);

                        $product_title = $row_product['product_title'];
                        $product_image1 = $row_product['product_image1'];
                        $price = $row_product['product_price'];

                        $item_total = $price * $quantity;
                        $total_price += $item_total;
                        ?>
                        <tr>
                            <td><?php echo $product_title; ?></td>
                            <td>
                                <img src="./admin_area/product_images/<?php echo $product_image1; ?>"
                                     alt="<?php echo $product_title; ?>" class="card-img-top" style="width:100px;">
                            </td>
                            <td>
                                <input type="number" name="qty[<?php echo $product_id; ?>]"
                                       value="<?php echo $quantity; ?>" min="1" class="form-input w-50">
                            </td>
                            <td><?php echo $item_total; ?> €</td>
                            <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>"></td>
                            <td>
                                <input type="submit" value="Update cart" class="btn btn-info mx-2" name="update_cart">
                                <input type="submit" value="Remove Cart" class="btn btn-secondary mx-2" name="remove_cart">
                            </td>
                        </tr>
                        <?php
                    }

                    echo "</tbody></table>";

                    // 4️⃣ Affichage du subtotal et des boutons
                    echo "
    <div class='d-flex mb-3'>
        <h4 class='px-3'>
            Subtotal: <strong class='text-info'>$total_price €</strong>
        </h4>
        <input type='submit' value='Continue Shopping' class='btn btn-info mx-2' name='continue_shopping'>
        <a href='./users_area/checkout.php' class='btn btn-secondary mx-2'>Checkout</a>
    </div>
    ";
                } else {
                    echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                    echo "<input type='submit' value='Continue Shopping' class='btn btn-info mx-2' name='continue_shopping'>";
                }

                // 5️⃣ Redirection si continue shopping
                if(isset($_POST['continue_shopping'])){
                    echo "<script>window.open('index.php','_self')</script>";
                }
                ?>

    </div>
</div>

<!-- last child -->
<?php include('./includes/footer.php'); ?>

<!-- bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
