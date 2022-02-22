<?php

require_once('session.php');
require_once('../db/requires.php');

if (!isset($_SESSION['user_id']) || !isset($_GET['history_id'])) {
    header('Location: ../');
    exit();
}

$history = getHistoryById($conn, $_SESSION['user_id'], $_GET['history_id']);

if (!is_null($history)) {
    deleteHistoryById($conn, $_GET['history_id']);
    unset($_SESSION['histories'][$_GET['history_id']]);
}

header('Location: ../pages/histories.php');
exit();

?>