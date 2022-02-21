<!DOCTYPE html>

<html lang="bg">

<head>
    <title>Финален Проект УЕБ</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../style.css" />
    <script src="../main.js"></script>
</head>

<body>
    <?php require('../main.php'); authenticate('../', ['user_id']); ?>

    <div class="container">
        <div id="main">
            <form id="form" method="POST" action="../server/generate_file.php">

                <?php
                    foreach ($config_vars as $field_name => $class) {
                        echo (define_build_function($class))($field_name, $class, 'main');
                    }

                    if (isset($_GET['history_id'])):
?>
                        <input type="hidden" id="history_id" name="history_id" value="<?= $_GET['history_id'] ?>" />
<?php
                    endif;
                ?>

                <div class="actions">
<?php               if (isset($_GET['history_id'])): ?>
                        <button type="submit">Запази промените</button>
<?php               else: ?>
                        <button type="submit">Генерирай <b>tasks.json</b></button>
<?php               endif; ?>

                    <a href="../server/get_history.php"><button type="button" class="history">История</button></a>
                    <button type="button" class="logout" onclick="logout()">Изход</button>
                </div>
            </form>

            <form id="logout" method="POST" action="../server/logout.php">
            </form>
        </div>
    </div>
</body>

</html>