<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = $_POST['name'];
    $price       = $_POST['price'];
    $remains     = $_POST['remains'];
    $category_id = $_POST['category_id'];

    if (AddProduct($pdo, $name, $price, $remains, $category_id)) {
        $_SESSION['message_success'] = 'Товар добавлен';
        header('Location: show_product.php');
        exit;
    } else {
        $_SESSION['msg_error'] = 'Не удалось добавить товар';
        header('Location: add_product.php');
        exit;
    }
}
$categorytable = SelectCategory($pdo);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление товара</title>

</head>
<body>

<?php if (!empty($_SESSION['msg_error'])): ?>
    <p><?php echo ($_SESSION['msg_error']); ?></p>
    <?php unset($_SESSION['msg_error']); ?>
<?php endif; ?>

<form method="post" action="">
    <label>Название</label><br>
    <input type="text" name="name" required><br><br>

    <label>Цена</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Количество</label><br>
    <input type="number" name="remains" value="0"><br><br>

    <label>Категория</label><br>
    <select name="category_id" required>
        <option value="">выберите категорию</option>
        <?php foreach ($categorytable as $category): ?>
            <option value="<?php echo $category['id']; ?>">
                <?php echo ($category['category']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Сохранить</button>
</form>

<a href="show_product.php">Назад</a>

</body>
</html>