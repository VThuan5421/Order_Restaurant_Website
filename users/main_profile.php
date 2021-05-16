<?php
// Include functions and connect to the database using PDO MySQL
include 'config.php';
// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && 
file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'profile';

// Include and show the requested page
include $page . '.php';
?>