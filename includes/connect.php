<?php

// database connection parameters (from railway)
define('DB_HOST', getenv('DB_HOST') ?: 'mysql.railway.internal');
define('DB_USERNAME', getenv('DB_USER') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'railway');
define('DB_PORT', getenv('DB_PORT') ?: 3306); // default MySQL = 3306

// connexion to the database
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Set the character set to utf8
mysqli_set_charset($con, "utf8");

?>
