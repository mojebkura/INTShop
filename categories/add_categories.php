<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];

    if (!$category) {
        $_SESSION['msg_error'] = 'Введите название категории';
        header('Location: add_categories.php');
        exit;
    }

    if (AddCategory($pdo, $category)) {
        $_SESSION['message_success'] = 'Категория добавлена';
        header('Location: show_categories.php');
        exit;
    } else {
        $_SESSION['msg_error'] = 'Ошибка при добавлении категории';
        header('Location: add_categories.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить категорию</title>
</head>
<body>
<div class="container mt-3">
    <h1>Добавить категорию</h1>

    <?php if (!empty($_SESSION['msg_error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['msg_error']; unset($_SESSION['msg_error']); ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Название</label><br>
        <input type="text" name="category" required>
        <br><br>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="show_categories.php" class="btn btn-secondary">Назад</a>
    </form>
</div>
</body>
</html>