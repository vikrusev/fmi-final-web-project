<?php

session_start();
$_SESSION = array();
unset($GLOBALS['histories']);
session_destroy();

header("Location: ../");
exit();

?>