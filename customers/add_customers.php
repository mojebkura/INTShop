<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $password = $_POST['password'];
    $role     = $_POST['role'] ?? 'User';

    if (!$name || !$email || !$password) {
        $_SESSION['msg_error'] = 'Заполните обязательные поля';
        header('Location: add_customer.php');
        exit;
    }

    if (getUserLogin($pdo, $name)) {
        $_SESSION['msg_error'] = 'Такое имя уже занято';
        header('Location: add_customer.php');
        exit;
    }

    if (emailExists($pdo, $email)) {
        $_SESSION['msg_error'] = 'Такая почта уже используется';
        header('Location: add_customer.php');
        exit;
    }

    AddClient($pdo, $name, $email, $phone, $password, $role);
    $_SESSION['message_success'] = 'Клиент добавлен';
    header('Location: show_customer.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Добавление клиента</title>
</head>
<body>
<form method="post">
    <label>Имя</label><br>
    <input type="text" name="name" required><br><br>

    <label>Почта</label><br>
    <input type="email" name="email" required><br><br>

    <label>Телефон</label><br>
    <input type="text" name="phone"><br><br>

    <label>Пароль</label><br>
    <input type="password" name="password" required><br><br>


    <button type="submit">Сохранить</button>
    <a href="show_customer.php">Назад</a>
</form>
</body>
</html>