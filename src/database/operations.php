<?php

/**
 * Queries w/ variables MUST be build w/ prepared statements
 * 
 * https://stackoverflow.com/a/7537500/13213781
 * 
 * In this project, we are doing it the "easy" way
 *  surrounding the variable w/ quotes
 */

function insertUser($conn, $user_name) {
    $query = "INSERT INTO users (username) VALUES (?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $user_name);
    $stmt->execute();

    if ($stmt->error) {
        echo "Failed adding user '$user_name' to DB. Error: $conn->error";
    }
    else {
        echo "User '$user_name' added to DB.";
    }

    return mysqli_stmt_insert_id($stmt);
}

function insertHistory($conn, $historyData) {
    $result = mysqli_query($conn, "INSERT INTO histories (configuration) VALUES ($historyData)");

    if ($result) {
        echo "History added to DB.";
    }
    else {
        echo "Failed adding history to DB. Error: $conn->error";
    }
}

function getUser($conn, $user_name) {
    $query = "SELECT * FROM users WHERE username=?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $user_name);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_assoc();
}


?>