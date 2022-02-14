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
    $result = mysqli_query($conn, "INSERT INTO users (username) VALUES ('$user_name')");

    if ($result) {
        echo "User '$user_name' added to DB.";
    }
    else {
        echo "Failed adding user '$user_name' to DB. Error: $conn->error";
    }
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


?>