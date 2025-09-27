<?php
$con = mysqli_connect(
    getenv('DB_HOST'),
    getenv('DB_USER'),
    getenv('DB_PASSWORD'),
    getenv('DB_NAME'),
    getenv('DB_PORT') ?: 3306
);

if (!$con) {
    die("❌ Erreur connexion DB: " . mysqli_connect_error());
}
echo "✅ Connexion MySQL réussie avec mysqli !";