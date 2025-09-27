<?php
// Database connection parameters (from Railway)
define('DB_HOST', getenv('DB_HOST') ?: 'mysql.railway.internal');
define('DB_USERNAME', getenv('DB_USER') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'railway');
define('DB_PORT', getenv('DB_PORT') ?: 3306); // default MySQL = 3306

try {
    // building PDO
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8";

    // connecting PDO
    $con = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

    // managing errors
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // if it works well
} catch (PDOException $e) {
    // if it doesn't work well
    die("Erreur connexion PDO: " . $e->getMessage());
}
?>
