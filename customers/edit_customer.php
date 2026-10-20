<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

$id     = ($_GET['id']);
$client = getClientById($pdo, $id);

if ($client) {
    $_SESSION['msg_error'] = 'Клиент не найден';
    header('Location: show_customer.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'];
    $email =$_POST['email'];
    $phone = $_POST['phone'];
    $role  = $_POST['role'] ?? 'User';

    UpdateClient($pdo, $id, $name, $email, $phone, $role);
    $_SESSION['message_success'] = 'Данные обновлены';
    header('Location: show_customer.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Редактирование клиента</title>
</head>
<body>
<form method="post">
    <label>Имя</label><br>
    <input type="text" name="name" value="<?php echo $client ['name'] ?>" required><br><br>

    <label>Почта</label><br>
    <input type="email" name="email" value="<?php echo $client['email'] ?>" required><br><br>

    <label>Телефон</label><br>
    <input type="text" name="phone" value="<?php echo $client['phone'] ?>" required><br><br>


    <button type="submit">Сохранить</button>
    <a href="show_customer.php">Назад</a>
</form>
</body>
</html>