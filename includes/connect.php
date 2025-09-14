<?php
// includes/connect.php - upgraded version with error handling and comments

// databse connection parameters
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mystore');

// connexion to the database
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Set the character set to utf8
mysqli_set_charset($con, "utf8");

?>