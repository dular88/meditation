<?php
// Site name
if (!defined('SITE_NAME')) define('SITE_NAME', 'Ekta Pyramid Stritual Trust');

// -----------------------------
// DATABASE CONFIGURATION
// -----------------------------
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', '');
if (!defined('DB_NAME')) define('DB_NAME', 'ekta');
if (!defined('URL')) define('URL', 'http://'.DB_HOST."/ekta");

// Create database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}
