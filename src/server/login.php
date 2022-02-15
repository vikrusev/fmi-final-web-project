<?php

require_once('session.php');
require_once('../database/requires.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $conn->real_escape_string($_POST['username']);
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