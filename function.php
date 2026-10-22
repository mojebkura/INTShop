<?php
require_once __DIR__ . '/db.php';
//______________РЕГИСТРАЦИЧ___________

function getUserLogin($pdo, $name) {
    $sql = "SELECT * FROM Clients WHERE name = :name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getUserByEmail($pdo, $email) {
    $sql = "SELECT * FROM Clients WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
};
function getClientById($pdo, $id) {
    $sql = "SELECT * FROM Clients WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function emailExists($pdo, $email) {
    return getUserByEmail($pdo, $email);
}

//________________Продуктность_______________
function AddProduct($pdo, $name, $price, $remains, $category_id) {
    $sql = "INSERT INTO Product(name, price, remains, category_id)
            VALUES (:name, :price, :remains, :category_id)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
            ':name' => $name,
            ':price'  => $price,
            ':remains' => $remains,
            ':category_id' => $category_id
    ]);
}

function SelectProduct($pdo) {
    $sql = "SELECT * FROM Product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductById($pdo, $id) {
    $sql = "SELECT * FROM Product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function UpdateProduct($pdo, $id, $name, $price, $remains, $category_id) {
    $sql = "UPDATE Product
            SET name = :name,
                price = :price,
                remains = :remains,
                category_id = :category_id
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':price' => $price,
            ':remains' => $remains,
            ':category_id' => $category_id
    ]);
}

function DeleteProduct($pdo, $id){
    $sql = "DELETE FROM Product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}
//_____________________Пользвлтель________________________

function SelectUser($pdo) {
    $sql = "SELECT * FROM Clients";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
};
function UpdateClient($pdo, $id, $name, $email, $phone, $role = 'User') {
    $sql = "UPDATE Clients
            SET name = :name,
                email = :email,
                phone = :phone,
                role = :role
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id'    => $id,
        ':name'  => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':role'  => $role
    ]);
}
function DeleteClient($pdo, $id) {
    $sql = "DELETE FROM Clients WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
};
function AddClient($pdo, $name, $email, $phone, $password, $role = 'User', $is_blocked = 0) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO Clients(name, email, phone, password, role, is_blocked)
            VALUES (:name, :email, :phone, :password, :role, :is_blocked)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':name'     => $name,
        ':email'    => $email,
        ':phone'    => $phone,
        ':password' => $passwordHash,
        ':role'     => $role,
        ':is_blocked' => $is_blocked
    ]);
};
//--------------категории------------------
function AddCategory($pdo, $category) {
    $sql = "INSERT INTO Product_category(category) VALUES (:category)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':category' => $category]);
};
function SelectCategory($pdo) {
    $sql = "SELECT * FROM Product_category";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
};
function DeleteCategory($pdo, $id) {
    $sql = "DELETE FROM Product_category WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
};
function UpdateCategory($pdo, $id, $category) {
    $sql = "UPDATE Product_category SET category = :category WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id'       => $id,
        ':category' => $category
    ]);
};
function getCategoryById($pdo, $id) {
    $sql = "SELECT * FROM Product_category WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
};
//______________заказы________________
function AddOrder($pdo, $client_id, $product_id, $total_amount, $status = 'paid') {
    $sql = "INSERT INTO Orders(client_id, product_id, total_amount, status)
            VALUES (:client_id, :product_id, :total_amount, :status)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':client_id'    => $client_id,
        ':product_id'   => $product_id,
        ':total_amount' => $total_amount,
        ':status'       => $status
    ]);
}
function SelectOrders($pdo) {
    $sql = "SELECT 
            Orders.id, 
                Orders.client_id, 
        Clients.name AS client_name, 
                Orders.product_id, 
            Product.name AS product_name, 
        Orders.created_at, 
            Orders.total_amount, 
            Orders.status 
            FROM Orders
            LEFT JOIN Clients ON Orders.client_id = Clients.id
            LEFT JOIN Product ON Orders.product_id = Product.id
            ORDER BY Orders.created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function UpdateOrder($pdo, $id, $client_id, $total_amount, $status) {
    $sql = "UPDATE Orders
            SET client_id    = :client_id,
                total_amount = :total_amount,
                status       = :status
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':id'           => $id,
        ':client_id'    => $client_id,
        ':total_amount' => $total_amount,
        ':status'       => $status
    ]);
};
function DeleteOrder($pdo, $id) {
    $sql = "DELETE FROM Orders WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
};

// function TotalMoney($pdo) {
//     $sql = "SELECT SUM(total_amount) FROM Orders";
//     $stmt = $pdo->query($sql);
//     return $stmt->fetchColumn() ?: 0;
// };
// function PopularCategory($pdo) {
//     $sql = "SELECT Product_category.category AS category_name, COUNT(Orders.id) AS order_count
//             FROM Orders
//             JOIN Product ON Product.id = Orders.product_id
//             JOIN Product_category ON Product_category.id = Product.category_id
//             GROUP BY Product_category.id, Product_category.category
//             ORDER BY order_count DESC
//             LIMIT 1";
//     $stmt = $pdo->query($sql);
//     return $stmt->fetch(PDO::FETCH_ASSOC);
// };

// function PopularProduct($pdo) {
//     $sql = "SELECT Product.name AS product_name, COUNT(Orders.id) AS order_count
//             FROM Order
//             JOIN Product ON Product.id = Orders.product_id
//             GROUP BY Product.id, Product.name
//             ORDER BY order_count DESC
//             LIMIT 1";
//     $stmt = $pdo->query($sql);
//     return $stmt->fetch(PDO::FETCH_ASSOC);
// };

