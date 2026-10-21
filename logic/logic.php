<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

$totalmoney  = TotalMoney($pdo);
$topcategory   = PopularCategory($pdo);
$toproduct    = PopularProduct($pdo);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
</head>
<body>
<div>Общая выручка</div>
<div class="card-value"><?php echo number_format($totalmoney, 2, '.', ' '); ?></div>
<div>Топ категория</div>
<div class="card-value"><?php echo ($topcategory); ?></div>
<div>Топ продукт</div>
<div class="card-value"><?php echo ($topproduct); ?></div>
</body>
</html>
