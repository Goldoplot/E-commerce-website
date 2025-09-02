<h3 class="text-center ">All users</h3>
<table class="table table-bordered mt-5">
    <thead class="table-info text-light ">
    <?php
    // fetching users
    $get_users = "SELECT * FROM `user_table`";
    $result = mysqli_query($con, $get_users);
    $row_count= mysqli_num_rows($result);
    if($row_count == 0){
        echo "<h2 class ='text-center text-danger'>No user found.</h2>";
    }else{
        echo    "<tr class='table-info text-center'>
                        <th>User No</th>
                        <th>Username</th>
                        <th>User email</th>
                        <th>User image</th>
                        <th>User address</th>
                        <th>User mobile</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class='bg-secondary text-center text-light'>";

            $number = 0;
            while($row_data = mysqli_fetch_assoc($result)){
                $user_id = $row_data['user_id'];
                $username = $row_data['username'];
                $user_email = $row_data['user_email'];
                $user_image = $row_data['user_image'];
                $user_address = $row_data['user_address'];
                $user_mobile = $row_data['user_mobile'];
                $number++;
                ?>
                <tr>
                    <td><?php echo $user_id; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $user_email; ?></td>
                    <td><img src='../users_area/user_images/<?= $user_image ?>' alt="$username" class='product_img'></td>
                    <td><?php echo $user_address; ?></td>
                    <td><?php echo $user_mobile; ?></td>
                    <td><a href="index.php?delete_user=<?= $user_id ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this user?');">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php }}?>
    </tbody>
</table>