<h3 class="text-center text-success">All Brands</h3>
<table class="table table-bordered table-striped mt-5">
    <thead>
    <tr class="table-info text-light text-center">
        <th>#</th>
        <th>Brand Title</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody class="bg-secondary text-light text-center align-middle">

    <?php
    //fetching brands
    $get_brands = "SELECT * FROM `brands`";
    $result = mysqli_query($con, $get_brands);
    $number = 0;
    while($row = mysqli_fetch_assoc($result)){
        $brand_id = $row['brand_id'];
        $brand_title = $row['brand_title'];
        $number++;
        ?>
        <tr>
            <td><?php echo $number;?></td>
            <td><?php echo $brand_title;?></td>
            <td>
                <a href='index.php?edit_brand=<?php echo $brand_id?>' class='btn btn-sm btn-warning'>
                    <i class='fa-solid fa-pen-to-square'></i> Edit
                </a>
            </td>
            <td>
                <a href='index.php?delete_brand=<?php echo $brand_id?>' class='btn btn-sm btn-danger' onclick="return confirm('Are you sure you want to delete this product?');">
                <i class='fa fa-trash'></i> Delete
                </a>
            </td>
        </tr>
    <?php }?>

    </tbody>

</table>