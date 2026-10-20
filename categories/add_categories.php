<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

$category = $_POST['category'];

if (!$category) {
    $_SESSION['msg_error'] = 'Введите название категории';
    header('Location: add_categories.php');
    exit;
}
AddCategory($pdo, $category);
$_SESSION['message_success'] = 'Категория добавлена';
header('Location: show_categories.php');


?>
<!doctype html>
<html lang="ru">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Добавить категорию</title>
</head>
<body>
<form method="post">
    <label>Название</label><br>
    <input type="text" name="category" required>
    <br><br>
    <button type="submit">Сохранить</button>
    <a href="show_categories.php">Назад</a>
</form>
</body>
</html>