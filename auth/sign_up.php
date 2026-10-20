<?php
require_once __DIR__ . '/../function.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$role = 'User';
$is_blocked = 0;


// if (!$name|| !$email || !$password) {
// $_SESSION['msg_error'] = 'Заполните все поля';
// header('Location: registration.php');
// exit;
// }

if ($password !== $password_confirm) {
$_SESSION['msg_error'] = 'Пароли не совпадают';
header('Location: registration.php');
exit;
}

if (getUserLogin($pdo, $name)) {
$_SESSION['msg_error'] = "Пользователь с логином '{$name}' уже существует.";
header('Location: registration.php');
exit;
}

if (AddClient($pdo, $name, $email, $phone, $password, $role, $is_blocked)) {
$_SESSION['message_success'] = 'Регистрация успешна!';
header('Location: /../index.php');
exit;
}
else{
$_SESSION['msg_error'] = 'Не удалось зарегистрировать пользователя.';
header('Location: registration.php');
exit;
}
