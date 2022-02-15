<!DOCTYPE html>

<html lang="bg">

<head>
    <title>Финален Проект УЕБ</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../style.css" />

    <script>
        function copyToClipboard(json) {
            navigator.clipboard.writeText(JSON.stringify(json, null, 2));
            alert('Запазено в клипборда!');
        }
    </script>
</head>

<body>
    <?php require('../main.php'); authenticate('form.php', ['user_id', 'generated_json']); ?>

    <div class="container">
        <div id="response">
            <div class="actions">
                <button class="copy" onclick='copyToClipboard(<?= $_SESSION["generated_json"]; ?>)'>Запазване в клипборда</button>
                <button class="back" onclick="history.back()">Назад</button>
            </div>

            <pre><?= $_SESSION['generated_json']; ?></pre>
        </div>
    </div>
</body>

</html>