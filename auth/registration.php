<?php
session_start();
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../function.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
<form action="sign_up.php" method="POST">
    <label>Имя:</label>
    <br><input type="text" name="name" required>
    <br><br><label>Почта:</label>
    <br><input type="email" name="email" required>
    <br><br><label>Телефон:</label>
    <br><input type="text" name="phone">
    <br><br><label>Пароль:</label>
    <br><input type="password" name="password" required>
    <br><br><label>Пароль подтвердить:</label>
    <br><input type="password" name="password_confirm" required>

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
    <br><br><a href="/index.php">Уже есть аккаунт?</a>
    <br><br><button type="submit">Подтвердить</button>
</form>
</body>
</html>