<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered table-striped mt-5">
    <thead>
    <tr class="table-info text-light text-center">
        <th>#</th>
        <th>Category Title</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
<tbody class="bg-secondary text-light text-center align-middle">

<?php
    //fetching categories
    $get_categories = "SELECT * FROM `categories`";
    $result = mysqli_query($con, $get_categories);
    $number = 0;
    while($row = mysqli_fetch_assoc($result)){
        $category_id = $row['category_id'];
        $category_title = $row['category_title'];
        $number++;
?>
        <tr>
            <td><?php echo $number;?></td>
            <td><?php echo $category_title;?></td>
        <td>
            <a href='index.php?edit_category=<?php echo $category_id ?>' class='btn btn-sm btn-warning'>
                <i class='fa-solid fa-pen-to-square'></i> Edit
            </a>
        </td>
        <td>
            <a href='index.php?delete_category=<?php echo $category_id ?>' class='btn btn-sm btn-danger' onclick="return confirm('Are you sure you want to delete this category?');">
            <i class='fa fa-trash'></i> Delete
            </a>
        </td>
        </tr>
<?php }?>

</tbody>

</table>
