<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

$selectClient = SelectUser($pdo);
?>
<!doctype html>
<html lang="en">
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
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Клиенты</title>

</head>

<body>
<h1>Пользователи</h1>
<table class="table">

    <thead>
    <tr>
        <th>id</th>
        <th >имя</th>
        <th>почта</th>
        <th>телефон</th>
        <th>пароль</th>
        <th>роль</th>
        <th>Действие</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($selectClient as $client): ?>
        <tr>
            <td><?php echo $client['id'] ?></td>
            <td><?php echo $client['name'] ?></td>
            <td><?php echo$client['email'] ?></td>
            <td><?php echo $client['phone'] ?></td>
            <td><?php echo $client['password'] ?></td>
            <td><?php echo$client['role'] ?></td>
            <th>
                <a href="/customers/delete_customer.php?id=<?php echo $client['id'] ?>">Удалить</a>

                <a href="/customers/edit_customer.php?id=<?php echo ($client['id']) ?>">Изменить</a>

            </th>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
<a href="/../index.php" class="btn btn-success mb-3">Выйти с аккаунта</a>
</html>
