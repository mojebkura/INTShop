<?php
require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../db.php';

DeleteClient($pdo, $_GET['id']);
header('Location: show_customer.php');