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
    <?php require('../main.php'); authenticate('form.php', ['user_id', 'generated_json']); ?>

    <div class="container">
        <div id="response">
            <?php
                $key = array_key_first($_SESSION['generated_json']);

                $history_display = json_decode($_SESSION['generated_json'][$key]);
                unset($history_display->name);
                $history_display = json_encode($history_display, JSON_PRETTY_PRINT);
            ?>

            <span class="config-name">Име: <?= json_decode($_SESSION['generated_json'][$key])->name ?></span>

            <pre><?= $history_display; ?></pre>

            <div class="actions">
                <button class="copy" onclick='copyToClipboard(<?= $history_display; ?>)'>Запазване в клипборда</button>
                <a href="../pages/form.php?history_id=<?= $key; ?>">
                    <button class="edit">Промени</button>
                </a>
                <a href="../server/get_history.php"><button type="button" class="history">История</button></a>
                <button class="back" onclick="goBack('form.php')">Назад</button>
            </div>
        </div>
    </div>
</body>

</html>