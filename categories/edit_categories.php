<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

$id = ($_GET['id']);
$category = getCategoryById($pdo, $id);

if (!$category) {
    $_SESSION['msg_error'] = 'Категория не найдена';
    header('Location: show_categories.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['category'];

    if (!$name) {
        $_SESSION['msg_error'] = 'Введите название';
        header("Location: edit_categories.php?id=$id");
        exit;
    }

    UpdateCategory($pdo, $id, $name);
    $_SESSION['message_success'] = 'Категория обновлена';
    header('Location: show_categories.php');
    exit;
}
?>
<!doctype html>
<html lang="ru">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Изменить категорию</title>
</head>
<body>
<form method="post">
    <label>Название</label><br>
    <input type="text" name="category"
        value="<?php echo $category['category'] ?>" required>
    <br><br>
    <button type="submit">Сохранить</button>
    <a href="show_categories.php">Назад</a>
</form>
</body>
</html>