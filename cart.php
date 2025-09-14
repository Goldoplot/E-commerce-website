<?php
// cart.php - Version refactorisée

// Configuration spécifique à cette page
$page_title = "Shopping Cart - Ecommerce Store";
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

// CSS spécifique pour le panier
$inline_css = '
    .cart-table {
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    .cart-item-image {
        width: 100px;
        height: 100px;
        object-fit: contain;
        border-radius: 5px;
    }
    .quantity-input {
        max-width: 80px;
        text-align: center;
    }
    .cart-total {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }
';

// Inclusion de l'en-tête et navigation
include('includes/header.php');
include('includes/navbar.php');
?>

    <!-- Cart Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Shopping Cart</h2>

                <form action="" method="post">
                    <?php
                    $get_ip_address = getIPAddress();

                    // 1️⃣ Mise à jour des quantités si formulaire soumis
                    if(isset($_POST['update_cart'])){
                        if(isset($_POST['qty'])){
                            foreach($_POST['qty'] as $product_id => $quantity){
                                $quantity = intval($quantity);
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

                    // 3️⃣ Récupérer le panier après modifications
                    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
                    $result = mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result);

                    $total_price = 0;

                    if($result_count > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center cart-table">
                                <thead class="bg-info text-white">
                                <tr>
                                    <th>Product</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while($row = mysqli_fetch_array($result)):
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
                                        <td class="align-middle">
                                            <strong><?php echo htmlspecialchars($product_title); ?></strong>
                                        </td>
                                        <td class="align-middle">
                                            <img src="./admin_area/product_images/<?php echo $product_image1; ?>"
                                                 alt="<?php echo htmlspecialchars($product_title); ?>"
                                                 class="cart-item-image">
                                        </td>
                                        <td class="align-middle">
                                            <input type="number"
                                                   name="qty[<?php echo $product_id; ?>]"
                                                   value="<?php echo $quantity; ?>"
                                                   min="1"
                                                   class="form-control quantity-input">
                                        </td>
                                        <td class="align-middle">
                                            <span class="fw-bold text-success"><?php echo $price; ?> €</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="fw-bold text-info"><?php echo $item_total; ?> €</span>
                                        </td>
                                        <td class="align-middle">
                                            <input type="checkbox"
                                                   name="removeitem[]"
                                                   value="<?php echo $product_id; ?>"
                                                   class="form-check-input">
                                        </td>
                                        <td class="align-middle">
                                            <button type="submit" name="update_cart" class="btn btn-sm btn-warning mb-1">
                                                <i class="fas fa-sync-alt"></i> Update
                                            </button>
                                            <button type="submit" name="remove_cart" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Cart Total and Actions -->
                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <div class="cart-total text-center">
                                    <h4>Cart Summary</h4>
                                    <div class="d-flex justify-content-between">
                                        <span>Subtotal:</span>
                                        <span class="fw-bold"><?php echo $total_price; ?> €</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="submit" name="continue_shopping" class="btn btn-info">
                                        <i class="fas fa-shopping-cart"></i> Continue Shopping
                                    </button>
                                    <a href="./users_area/checkout.php" class="btn btn-success">
                                        <i class="fas fa-credit-card"></i> Checkout
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h3 class="text-muted">Your cart is empty</h3>
                            <p class="text-muted">Start shopping to add items to your cart</p>
                            <button type="submit" name="continue_shopping" class="btn btn-info btn-lg">
                                <i class="fas fa-store"></i> Start Shopping
                            </button>
                        </div>
                    <?php endif;

                    // Redirection si continue shopping
                    if(isset($_POST['continue_shopping'])){
                        echo "<script>window.location.href='index.php'</script>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>

<?php
// Inclusion du footer et scripts
include('includes/footer.php');
include('includes/footer_scripts.php');
?>