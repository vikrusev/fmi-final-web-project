<?php

function prepareQuery($conn, $query) {
    $stmt = $conn->prepare($query);

    if ($conn->error) {
        echo "Error occurred while preparing the query: '$conn->error'";
    }

    return $stmt;
}

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

    $stmt = prepareQuery($conn, $query);
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

function updateHistory($conn, $history_data, $history_id) {
    $query = "UPDATE histories SET configuration=? WHERE id=?";

    $stmt = prepareQuery($conn, $query);
    $stmt->bind_param('si', $history_data, $history_id);
    $stmt->execute();

    if ($stmt->error) {
        echo "Failed updating history in DB. Error: $conn->error";
        return -1;
    }
    else {
        echo "History updated in DB.";
        return $history_id;
    }
}

function insertHistory($conn, $history_data) {
    $query = "INSERT INTO histories (user_id, configuration) VALUES (?,?)";

    $stmt = prepareQuery($conn, $query);
    $stmt->bind_param('is', $_SESSION['user_id'], $history_data);
    $stmt->execute();

    if ($stmt->error) {
        echo "Failed adding history to DB. Error: $conn->error";
        return -1;
    }
    else {
        echo "History added to DB.";
        return $stmt->insert_id;
    }
}

function getUser($conn, $user_name) {
    $query = "SELECT * FROM users WHERE username=?";

    $stmt = prepareQuery($conn, $query);
    $stmt->bind_param('s', $user_name);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_assoc();
}

function getHistoryById($conn, $user_id, $history_id) {
    $query = "SELECT * FROM histories WHERE user_id=? AND id=? ORDER BY id DESC";

    $stmt = prepareQuery($conn, $query);
    $stmt->bind_param('ii', $user_id, $history_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $result = $result->fetch_assoc();

    return $result ? $result['configuration'] : NULL;
}

function getHistories($conn, $user_id) {
    $query = "SELECT * FROM histories WHERE user_id=? ORDER BY id DESC";

    $stmt = prepareQuery($conn, $query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all();
}


?>