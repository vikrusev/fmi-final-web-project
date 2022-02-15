<?php

require_once('prepare_db.php');
require_once('operations.php');

$server_name = "localhost";
$user_name = "vikrusev";
$database_name = "fmi_web_project";
$password = "test123";

// Create connection
$conn = new mysqli($server_name, $user_name, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to '$server_name' successfully<br/>";

if (createDatabase($conn, $database_name)) {
    if (mysqli_select_db($conn, $database_name)) {
        echo "Successfully connected to DB '$database_name'<br/>";
        createTables($conn);
    }
    else {
        echo "Failed connecting to DB '$database_name'<br/>";
    }
}

?>