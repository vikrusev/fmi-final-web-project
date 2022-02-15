<?php

require_once('session.php');

$_SESSION = array();
unset($GLOBALS['histories']);
session_destroy();

header("Location: ../");
exit();

?>