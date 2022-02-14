<?php

function createTableUsers($conn) {
    $query = "CREATE TABLE users (
            id int(11) AUTO_INCREMENT,
            email varchar(255) NOT NULL,
            password varchar(255) NOT NULL,
            PRIMARY KEY (id)
            )";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Users table successfully created.<br/>";
    }
}

function createTableHistories($conn) {
    $query = "CREATE TABLE histories (
            id int(11) AUTO_INCREMENT,
            user_id int(11),
            configuration TEXT NOT NULL,
            PRIMARY KEY (id),
            FOREIGN KEY (user_id)
                REFERENCES users(id)
                ON DELETE CASCADE
            )";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Histories table successfully created.<br/>";
    }
}

function createTables($conn) {
    $queryUsers = "SELECT id FROM users";
    $resultUsers = mysqli_query($conn, $queryUsers);

    $queryHistories = "SELECT id FROM histories";
    $resultHistories = mysqli_query($conn, $queryHistories);

    empty($resultUsers) && createTableUsers($conn);
    empty($resultHistories) && createTableHistories($conn);
}

function createDatabase($conn, $name) {
    $result = mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $name");

    if ($result) {
        echo "Database '$name' is assured to exist.<br/>";
    }

    return $result;
}

?>