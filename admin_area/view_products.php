<h3 class="text-center text-success">All Products</h3>
<table class="table table-bordered table-striped mt-5">
    <thead>
    <tr class="table-info text-light text-center">
        <th>#</th>
        <th>Product Title</th>
        <th>Image</th>
        <th>Price</th>
        <th>Sold</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody class="text-center align-middle">
    <?php
    $get_products = "SELECT * FROM `products`";
    $result = mysqli_query($con, $get_products);
    $number = 0;

    while($row = mysqli_fetch_array($result)){
        $product_id   = $row['product_id'];
        $product_title= $row['product_title'];
        $product_image1 = $row['product_image1'];
        $product_price= $row['product_price'];
        $status       = $row['status'];
        $number++;

        // counting the number of sold items
        $get_count = "SELECT * FROM `orders_pending` WHERE product_id=$product_id";
        $result_count = mysqli_query($con, $get_count);
        $rows_count   = mysqli_num_rows($result_count);

        echo "
            <tr>
                <td>$number</td>
                <td>$product_title</td>
                <td><img src='./product_images/$product_image1' alt='Product Image' class='product_img'></td>
                <td>$product_price</td>
                <td>$rows_count</td>
                <td>$status</td>
                <td>
                    <a href='index.php?edit_product=$product_id' class='btn btn-sm btn-warning'>
                        <i class='fa-solid fa-pen-to-square'></i> Edit
                    </a>
                </td>
                <td>
                    <a href='index.php?delete_product=$product_id' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this brand?');\">
                        <i class='fa fa-trash'></i> Delete
                    </a>
                </td>
            </tr>
            ";
    }
    ?>
    </tbody>
</table>
