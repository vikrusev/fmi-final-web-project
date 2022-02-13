<!DOCTYPE html>

<html lang="bg">

<head>
    <title>WEB Final Project</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php require('main.php'); ?>

    <div class="container">
        <div id="main">
            <form id="validate" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

                <?php
                    foreach ($config_vars as $field_name => $class) {
                        echo (define_build_function($class))($field_name, $class);
                    }
                ?>

                <button type="submit">Генерирай</button>
            </form>
        </div>

    </div>
</body>

</html>