<!DOCTYPE html>

<html lang="bg">

<head>
    <title>WEB Final Project</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
        <div id="login">
            <form method="POST" action="server/login.php">
                <div class="row">
                    <label for="username">Потребителско име</label>
                    <input type="text" id="username" name="username" minlength="3" required />
                </div>

                <button type="submit">Вход</button>
            </form>
        </div>
    </div>
</body>

</html>