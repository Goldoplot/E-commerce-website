<h3 class="text-center ">All payment</h3>
<table class="table table-bordered mt-5">
    <thead class="table-info text-light">
    <?php
    // fetching payment
    $get_payments = "SELECT * FROM `user_payments`";
    $result = mysqli_query($con, $get_payments);
    $row_count= mysqli_num_rows($result);
    if($row_count == 0){
        echo "<h2 class ='text-center text-danger'>No payment found.</h2>";
    }else{
        echo    "<tr>
                        <th>Order No</th>
                        <th>Invoice No</th>
                        <th>Amount</th>
                        <th>Payment mode</th>
                        <th>Order date</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class='bg-secondary text-light'>";

            $number = 0;
            while($row_data = mysqli_fetch_assoc($result)){
                $order_id = $row_data['order_id'];
                $payment_id = $row_data['payment_id'];
                $invoice_number = $row_data['invoice_number'];
                $amount_due = $row_data['amount'];
                $payment_mode = $row_data['payment_mode'];
                $payment_date = $row_data['date'];
                $number++;
                ?>
                <tr>
                    <td><?php echo $order_id; ?></td>
                    <td><?php echo $invoice_number; ?></td>
                    <td><?php echo $amount_due; ?></td>
                    <td><?php echo $payment_mode; ?></td>
                    <td><?php echo $payment_date; ?></td>
                    <td><a href="index.php?delete_order=<?= $order_id ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this payment?');">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php }}?>
    </tbody>
</table>