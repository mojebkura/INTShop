<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../function.php';

$Producttable  = SelectProduct($pdo);
$categorytable = SelectCategory($pdo);
?>
<!doctype html>
<html lang="ru">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товары</title>

</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid justify-content-center">
        <div class="text-left">
        </div>

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

<div>
    <h1>Продукты</h1>
    <a href="add_product.php" class="btn btn-success mb-3">Добавить продукт</a>

    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>название</th>
            <th>цена(руб)</th>
            <th>кол-во</th>
            <th>Категория</th>
            <th>действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($Producttable as $product): ?>
            <?php $category = getCategoryById($pdo, $product['category_id']); ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['remains']; ?></td>
                <td><?php echo $category['category']; ?></td>
                <td>
                    <a href="delete_product.php?id=<?php echo $product['id']; ?>">Удалить</a>
                    <a href="edit_product.php?id=<?php echo $product['id']; ?>">Изменить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>