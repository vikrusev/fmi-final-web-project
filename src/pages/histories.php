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
            <button class="back" onclick="goBack('form.php')">Назад</button>

            <?php
                if (isset($_SESSION) && count($_SESSION['histories'])) {
                    $index = 0;
                    foreach ($_SESSION['histories'] as $key => $history) {
                        $history_display = json_decode($history);
                        unset($history_display->name);
                        $history_display = json_encode($history_display, JSON_PRETTY_PRINT);

                        $history_name = json_decode($history)->name;
?>
                        <div class="history-item">
                            <span class="config-name">Име: <?= $history_name; ?></span>
                            <span class="config-name">ID: <?= $key ?></span>

                            <pre><?= $history_display; ?></pre>

                            <div class="actions">
                                <button class="copy" onclick='copyToClipboard(<?= $history_display; ?>)'>Запазване в клипборда</button>
                                <a href="../pages/form.php?history_id=<?= $key; ?>">
                                    <button class="edit">Промени</button>
                                </a>
                                <button onclick="deleteHistoryItem(<?= $key; ?>, '<?= $history_name ?>')" class="delete">Изтрий</button>
                            </div>
                        </div>
<?php
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