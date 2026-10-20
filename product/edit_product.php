<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

$id = $_GET['id'];
$product = getProductById($pdo, $id);

if (!$product) {
    $_SESSION['msg_error'] = 'Товар не найден';
    header('Location: show_product.php');
    exit;
}
    $name = $_POST['name'];
    $price = $_POST['price'];
    $remains = $_POST['remains'];
    $category_id = $_POST['category_id'];

    if (!$name || $price <= 0) {
        $_SESSION['msg_error'] = 'Заполните название и цену';
        header("Location: edit_product.php?id=$id");
        exit;
    }

    UpdateProduct($pdo, $id, $name, $price, $remains, $category_id);
    $_SESSION['message_success'] = 'Товар обновлён';
    header('Location: show_product.php');

$categorytable = SelectCategory($pdo);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Редактирование товара</title>
</head>
<body>
<form method="post">
    <label>Название</label><br>
    <input type="text" name="name" value="<?php echo $product['name'] ?>" required><br><br>

    <label>Цена</label><br>
    <input type="number" step="0.01" name="price" value="<?php echo $product['price'] ?>" required><br><br>

    <label>Количество</label><br>
    <input type="number" name="remains" value="<?php echo $product['remains'] ?>"><br><br>

    <label>Категория</label><br>
    <select name="category_id" required>
        <option value="">выберите категорию</option>
        <?php foreach ($categorytable as $category): ?>
            <option value="<?php echo $category['id']; ?>">
                <?php echo $category['category']; ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>



    <button type="submit">Сохранить</button>
    <a href="show_product.php">Назад</a>
</form>

<?php
if (!empty($_SESSION['msg_error'])) {
    echo '<p>' . $_SESSION['msg_error']. '</p>';
    unset($_SESSION['msg_error']);
}
?>
</body>
</html>