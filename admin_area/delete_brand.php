<?php
if(isset($_GET['delete_brand'])){
    $brand_id = $_GET['delete_brand'];

    // Vérifier s'il existe encore des produits liés à cette marque
    $check_products = "SELECT * FROM `products` WHERE brand_id='$brand_id'";
    $result_check = mysqli_query($con, $check_products);

    if(mysqli_num_rows($result_check) > 0){
        // Des produits existent encore, on bloque la suppression
        echo "<script>alert('Impossible de supprimer : des produits utilisent encore cette marque.')</script>";
        echo "<script>window.open('index.php?view_brands','_self')</script>";
    } else {
        // Aucun produit associé → on peut supprimer
        $delete_brand = "DELETE FROM `brands` WHERE brand_id='$brand_id'";
        $result = mysqli_query($con, $delete_brand);

        if($result){
            echo "<script>alert('Marque supprimée avec succès')</script>";
            echo "<script>window.open('index.php?view_brands','_self')</script>";
        } else {
            echo "<script>alert('Erreur lors de la suppression')</script>";
        }
    }
}
?>