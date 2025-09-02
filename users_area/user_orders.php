<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="../style.css">

</head>
<body>

<?php
    $username=$_SESSION['username'];
    $get_user="Select * from `user_table` where username='$username'";
    $result=mysqli_query($con,$get_user);
    $row_fetch=mysqli_fetch_assoc($result);
    $user_id=$row_fetch['user_id'];

?>

<h3 class="text-success">All my orders</h3>
<table class="table table-bordered mt-5">
    <thead class="table-info text-light text-center">
        <tr>
            <th>Order ID</th>
            <th>Amount Due</th>
            <th>Total Products</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/Incomplete</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>

    <?php
        $get_order_details="Select * from `user_orders` where user_id='$user_id'";
        $result_orders=mysqli_query($con,$get_order_details);
        $number=1;
        while($row_orders=mysqli_fetch_assoc($result_orders)){
            $order_id=$row_orders['order_id'];
            $amount_due=$row_orders['amount_due'];
            $total_products=$row_orders['total_products'];
            $invoice_number=$row_orders['invoice_number'];
            $order_date=$row_orders['order_date'];
            $order_status=$row_orders['order_status'];
            if($order_status=='pending'){
                $display_status="Incompleted";
            }else{
                $display_status='completed';
            }

                echo "<tr>
                        <td>$number</td>
                        <td>$amount_due</td>
                        <td>$total_products</td>
                        <td>$invoice_number</td>
                        <td>$order_date</td>
                        <td>$display_status</td>";

            if($display_status=='completed'){
            echo "<td>Paid</td>";
            }else{
                echo "<td><a href='confirm_payment.php?order_id=$order_id' class='btn btn-primary btn-sm'>Confirm if received</a></td>";
        }
            echo "</tr>";
            $number++;
        }
    ?>
    </tbody>
</table>
</body>
</html>