<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

$id = $_GET['id'];
$orders = getOrderById($pdo, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $product_id = $_POST['product_id'];
    $total_amount = $_POST['total_amount'];
    $status = $_POST['status'];

    if (!$name || $price <= 0) {
        $_SESSION['msg_error'] = 'Заполните название и цену';
        header("Location: edit_product.php?id=$id");
        exit;
    }

    UpdateOrder($pdo, $client_id, $product_id, $total_amount, $status, $quantity);
    $_SESSION['message_success'] = 'Товар обновлён';
    header('Location: show_product.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменить</title>
</head>
<body>
<form method="post">
<label>клиент</label>
<br><input type="text" name="client_id"
        value="<?php echo $orders['client_id'] ?>" required>

    <br><br><label>продукт</label>
    <br><input type="text" name="product_id"
        value="<?php echo $orders['product_id'] ?>" required>

    <br><br><label>общая сумма</label>
    <br><input type="text" name="total_amount"
        value="<?php echo $orders['total_amount'] ?>" required>

    <br><br><label>статус</label>
    <br><input type="text" name="status"
        value="<?php echo $orders['status'] ?>" required>

    <br><br><button type="submit">Сохранить</button>

    <br><a href="show_order.php">Назад</a>
</form>
</body>
</html>