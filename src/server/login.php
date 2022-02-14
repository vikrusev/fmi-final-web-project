<?php

session_start();

require_once('../database/db.php');
require_once('../database/operations.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['username'];
    $user = getUser($conn, $user_name);

    if (is_null($user)) {
        $user_id = insertUser($conn, $user_name);
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['is_new'] = true;
    }
    else {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['username'];
    }

    header("Location: ../pages/form.php");
    exit();
}

header("Location: ../");
exit();

?>