<!DOCTYPE html>

<html lang="bg">

<head>
    <title>WEB Final Project</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css" />
    <script src="main.js"></script>
</head>

<body>
    <?php require('main.php'); ?>

    <div class="container">
        <div id="main">
            <form id="validate" method="POST" action="server.php">

                <?php
                    foreach ($config_vars as $field_name => $class) {
                        echo (define_build_function($class))($field_name, $class, false, 'main');
                    }
                ?>

                <button type="submit">Генерирай <b>tasks.json</b></button>
            </form>
        </div>
    </div>
</body>

</html>