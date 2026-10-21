<?php

require_once __DIR__ . '/../function.php';
$id = $_GET['id'];
$result = DeleteProduct($pdo, $id);
if ($result){
    header('Location: show_product.php');
    exit;
}
?>