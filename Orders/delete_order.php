<?php
session_start();
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

$id = $_GET['id'];

if (DeleteOrder($pdo, $id)) {
    $_SESSION['message_success'] = 'Заказ удалён';
} else {
    $_SESSION['msg_error'] = 'Не удалось удалить заказ';
}

header('Location: show_orders.php');
exit;