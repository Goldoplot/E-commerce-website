    <?php
        if(isset($_GET['edit_account'])){
            $user_session_name=$_SESSION['username'];
            $select_query="Select * from `user_table` where username='$user_session_name'";
            $result_query=mysqli_query($con,$select_query);
            $row_fetch=mysqli_fetch_array($result_query);
            $user_id=$row_fetch['user_id'];
            $username=$row_fetch['username'];
            $user_email=$row_fetch['user_email'];
            $user_address=$row_fetch['user_address'];
            $user_mobile=$row_fetch['user_mobile'];
        }

    if(isset($_POST['user_update'])){
        $update_id = $user_id;

        // Sécuriser les entrées utilisateur
        $username   = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile  = $_POST['user_mobile'];

        // Gestion de l'image
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        if(!empty($user_image)){
            move_uploaded_file($user_image_temp,"./user_images/$user_image");
        } else {
            // si pas d'image envoyée → garder l'ancienne
            $user_image = $row_fetch['user_image'];
        }

        // Requête préparée
        $update_data = "UPDATE `user_table` 
                    SET username = ?, 
                        user_email = ?, 
                        user_image = ?, 
                        user_address = ?, 
                        user_mobile = ?
                    WHERE user_id = ?";

        $stmt = mysqli_prepare($con, $update_data);

        if($stmt){
            // Liaison des paramètres (s = string, i = integer)
            mysqli_stmt_bind_param($stmt, "sssssi",
                $username,
                $user_email,
                $user_image,
                $user_address,
                $user_mobile,
                $update_id
            );

            // Exécution
            $result = mysqli_stmt_execute($stmt);

            if($result){
                echo "<script>alert('Data updated successfully')</script>";
                echo "<script>window.open('logout.php','_self')</script>";
            } else {
                echo "Erreur lors de la mise à jour : " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Erreur de préparation : " . mysqli_error($con);
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit account</title>
</head>
<body>
    <h3 class="text-center text-success mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4">
             <input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>" name="user_username" autocomplete="off" required="required">
        </div>
        <div class="form-outline mb-4">
             <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email" autocomplete="off" required="required">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" placeholder="Enter your image" name="user_image" autocomplete="off" >
            <img src="./user_images/<?php echo $user_image ?>" class="profile_image" alt="">
        </div>
        <div class="form-outline mb-4">
             <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>" name="user_address" autocomplete="off" required="required">
        </div>
        <div class="form-outline mb-4">
             <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile ?>" name="user_mobile" autocomplete="off" required="required">
        </div>
        <div class="form-outline mb-4 ">
             <input type="submit" class="form-control w-50 m-auto btn btn-info" value="Update" name="user_update">
        </div>
    </form>
</body>
</html>