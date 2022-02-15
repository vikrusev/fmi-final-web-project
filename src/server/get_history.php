<?php

session_start();

require_once('../database/db.php');
require_once('../database/operations.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../');
    exit();
}

$histories = getHistories($conn, $_SESSION['user_id']);

$_SESSION['histories'] = [];

foreach ($histories as $history) {
    array_push($_SESSION['histories'], json_encode(json_decode($history[2]), JSON_PRETTY_PRINT));
}

header('Location: ../pages/histories.php');
exit();

?>