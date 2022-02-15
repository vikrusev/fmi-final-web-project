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
        <div id="history">
            <button class="back" onclick="history.back()">Назад</button>

            <?php
                if (isset($_SESSION) && count($_SESSION['histories'])) {
                    $index = 0;
                    foreach ($_SESSION['histories'] as $history) {
?>
                        <pre><?= $history; ?></pre>
                        <button class="copy" onclick='copyToClipboard(<?= $history; ?>)'>Запазване в клипборда</button>
<?php
                        if ($index++ != count($_SESSION['histories']) - 1) {
                            echo "<hr>";
                        }
                    }
                }
                else {
                    echo "No histories available.";
                }
            ?>
        </div>
    </div>

</body>

</html>