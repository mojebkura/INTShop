<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['msg_error'] = 'Сначала войдите';
    header('Location: index.php');
    exit;
}

if ($_SESSION['role'] !== 'Admin') {
    $_SESSION['msg_error'] = 'Доступ запрещён';
    header('Location: main.php');
    exit;
}

?>