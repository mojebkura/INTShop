<?php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../function.php';

$categorytable = SelectCategory($pdo);
?>
<!doctype html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>товары</title>
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
            </ul>
        </div>
    </div>
</nav>
</head>
<body>
<h1>Категории</h1>
    <table class="table">
        <a href="add_categories.php" class="btn btn-success mb-3">Добавить категорию</a>
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
                <th>
                <a href="/categories/delete_categories.php?id=<?php echo $category['id'] ?>">Удалить</a>
                <a href="edit_categories.php?id=<?php echo $category['id'] ?>">Изменить</a>
                </th>
            
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
