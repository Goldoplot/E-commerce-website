<h3 class="text-center ">All orders</h3>
<table class="table table-bordered mt-5">
    <thead class="table-info text-light">
    <?php
        // fetching orders
         $get_orders = "SELECT * FROM `user_orders`";
         $result = mysqli_query($con, $get_orders);
         $row_count= mysqli_num_rows($result);
         if($row_count == 0){
            echo "<h2 class ='text-center text-danger'>No orders found.</h2>";
         }else{
            echo    "<tr>
                        <th>Order No</th>
                        <th>Due Amount</th>
                        <th>Invoice No</th>
                        <th>Total Products</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class='bg-secondary text-light'>";

                $number = 0;
                while($row_data = mysqli_fetch_assoc($result)){
                    $order_id = $row_data['order_id'];
                    $amount_due = $row_data['amount_due'];
                    $invoice_number = $row_data['invoice_number'];
                    $total_products = $row_data['total_products'];
                    $order_date = $row_data['order_date'];
                    $order_status = $row_data['order_status'];
                    $number++;
                    ?>
                        <tr>
                            <td><?php echo $order_id; ?></td>
                            <td><?php echo $amount_due; ?></td>
                            <td><?php echo $invoice_number; ?></td>
                            <td><?php echo $total_products; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td><?php echo $order_status; ?></td>
                            <td><a href="index.php?delete_order=<?= $order_id ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this product?');">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php }}?>
                        </tbody>
                    </table>