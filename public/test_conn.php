<?php
// Include the database configuration file
require_once '../config/Database.php';

// Create a new instance of the database class
$db = new Database();

// If a connection was successfully made, the success message will be displayed
// Otherwise, the error message will be echoed from the catch block in Database.php
?>