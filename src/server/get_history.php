<?php

require_once('session.php');
require_once('../db/requires.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: ../');
    exit();
}

$histories = getHistories($conn, $_SESSION['user_id']);

$_SESSION['histories'] = array();

foreach ($histories as $history) {
    $_SESSION['histories'][$history[0]] = json_encode(json_decode($history[2]), JSON_PRETTY_PRINT);
}

header('Location: ../pages/histories.php');
exit();

?>