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

// echo "Connected to '$server_name' successfully<br/>";

if (assureDatabaseExistence($conn, $database_name)) {
    if (mysqli_select_db($conn, $database_name)) {
        // echo "Successfully connected to DB '$database_name'<br/>";
        // Deprecated due to Phinx
        // createTables($conn);
    }
    else {
        echo "Failed connecting to DB '$database_name'<br/>";
        exit();
    }
}
else {
    echo "Something went wrong while assuring DB '$database_name' existence.";
    exit();
}

?>