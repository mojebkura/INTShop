<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../function.php';

$categorytable = SelectCategory($pdo);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Категории</title>
</head>
<body>


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

<div class="container mt-3">
    <h1>Категории</h1>

    <a href="add_categories.php" class="btn btn-success mb-3">Добавить категорию</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">категория</th>
            <th>действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($categorytable as $category): ?>
            <tr>
                <td><?php echo $category['id'] ?></td>
                <td><?php echo $category['category'] ?></td>
                <td>
                    <a href="delete_categories.php?id=<?php echo $category['id'] ?>">Удалить</a>
                    <a href="edit_categories.php?id=<?php echo $category['id'] ?>">Изменить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>