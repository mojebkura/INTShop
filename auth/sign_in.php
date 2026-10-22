<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

$name = $_POST['name'];
$password = $_POST['password'];

//if ($name === '' || $password === '') {
//    $_SESSION['msg_error'] = 'Заполните все поля';
//    header('Location: ../index.php');
//    exit;
//}

$user = getUserLogin($pdo, $name);

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['msg_error'] = 'Неверный логин или пароль';
    header('Location: ../index.php');
    exit;
}

$_SESSION['Clients'] = [
        'id'   => $user['id'],
        'name' => $user['name'],
        'role' => $user['role'],
];

$name = $_SESSION['Clients']['name'];
$role = $_SESSION['Clients']['role'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Основная страница</title>

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
    
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
    <h1>Главная страница</h1>
    <p>Пользователь: <b><?php echo $name; ?></b></p>
    <p>Твоя роль: <?php echo $role; ?></p>
</div>

</body>
</html>