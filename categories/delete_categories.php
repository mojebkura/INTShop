<?php
require_once __DIR__ . '/../function.php';
$id = $_GET['id'];
$result = DeleteCategory($pdo, $id);
if ($result){
    header('Location: show_categories.php');
    exit;
}
?>