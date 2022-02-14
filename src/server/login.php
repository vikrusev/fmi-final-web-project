<?php

session_start();

$_SESSION['user_id'] = 123;

header("Location: ../pages/form.php");
exit();

?>