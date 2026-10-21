<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>
<form action="/auth/sign_in.php" method="POST">
    <label for="name">Логин:</label>
    <input type="text" id="name" name="name">
    <br><br>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password">

    <br><br>
    <button type="submit">Войти</button>
    <br><br>
    <a href="./auth/registration.php">Регистрация</a>

    <?php
    if (!empty($_SESSION['msg_error'])) {
        echo '<p>' . ($_SESSION['msg_error']) . '</p>';
        unset($_SESSION['msg_error']);
    }
    if (!empty($_SESSION['message_success'])) {
        echo '<p>' . ($_SESSION['message_success']) . '</p>';
        unset($_SESSION['message_success']);
    }
    ?>
</form>
</body>
</html>