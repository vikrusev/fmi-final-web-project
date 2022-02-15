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

function insertHistory($conn, $history_data) {
    $query = "INSERT INTO histories (user_id, configuration) VALUES (?,?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $_SESSION['user_id'], $history_data);
    $stmt->execute();

    if ($stmt->error) {
        echo "Failed adding history to DB. Error: $conn->error";
    }
    else {
        echo "History added to DB.";
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

function getHistories($conn, $user_id) {
    $query = "SELECT * FROM histories WHERE user_id=?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all();
}


?>