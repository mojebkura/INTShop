<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

$orders = SelectOrders($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid justify-content-center">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/Orders/show_order.php">Заказ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/categories/show_categories.php">Категории</a></li>
                    <li class="nav-item"><a class="nav-link" href="/product/show_product.php">Продукты</a></li>
                    <li class="nav-item"><a class="nav-link" href="/customers/show_customer.php">Пользователи</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logic/logic.php">Аналитика</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <meta charset="UTF-8">
    <title>Заказы</title>

</head>

<h1>Заказы</h1>
<a href="add_order.php" class="btn btn-success mb-3">Добавить заказ</a>

<?php if (!empty($_SESSION['message_success'])): ?>
    <p><?php echo ($_SESSION['message_success']) ?></p>
    <?php unset($_SESSION['message_success']); ?>
<?php endif; ?>

<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>клиент</th>
        <th>товар</th>
        <th>время</th>
        <th>сумма(руб)</th>
        <th>статус</th>
        <th>действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?php echo $order['id']; ?></td>
            <td><?php echo $order['client_name']; ?></td>
            <td><?php echo $order['product_name']; ?></td>
            <td><?php echo $order['created_at']; ?></td>
            <td><?php echo $order['total_amount']; ?></td>
            <td><?php echo $order['status']; ?></td>
            <td>
                <a href="delete_order.php?id=<?php echo $order['id']; ?>">Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>