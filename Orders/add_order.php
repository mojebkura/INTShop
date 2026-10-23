<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
    $client_id  = $_POST['client_id'];
    $product_id = $_POST['product_id'];
    $total_amount = $_POST['total_amount'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    

    {
    if (AddOrder($pdo, $client_id, $product_id, $total_amount,$quantity, $status)) {
        $_SESSION['message_success'] = 'Заказ добавлен';
        header('Location: show_order.php');
        exit;
    }
    $_SESSION['msg_error'] = 'Не удалось добавить заказ';
    }
}

$clients   = SelectUser($pdo);
$productiv = SelectProduct($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить заказ</title>
</head>
<body>
<?php if (!empty($_SESSION['msg_error'])): ?>
    <p ><?php echo $_SESSION['msg_error']; ?></p>
    <?php unset($_SESSION['msg_error']); ?>
<?php endif; ?>
<form method="post">
    <label>Клиент</label><br>
    <select name="client_id" required>
        <?php foreach ($clients as $client): ?>
            <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <label>Товар</label><br>
    <select name="product_id" required>
        <?php foreach ($productiv as $product): ?>
            <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <label>Сумма</label><br>
    <input type="number" step="0.01" name="total_amount" required><br><br>
    <label>Статус</label><br>
    <select name="status">
        <option value="paid">Оплачено</option>
        <option value="cancelled">Отмена</option>
        <option value="shipped">Отправленный</option>
        <option value="completed">Заказ закрыт</option>
    </select><br><br>
        <label>Количество</label><br>
    <input type="number" step="1" name="quantity" required><br><br>
    <button type="submit">Сохранить</button>
    <a href="show_order.php">Назад</a>
</form>
</body>
</html>