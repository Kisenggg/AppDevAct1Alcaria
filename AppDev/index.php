<?php
// Database connection
$host = 'localhost';
$dbname = 'product_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Fetch all products
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Input Products</h2>
    <form action="create.php" method="post">
        Name: <input type="text" name="name" required><br>
        Description: <input type="text" name="description" required><br>
        Price: <input type="text" name="price" required><br>
        Quantity: <input type="text" name="quantity" required><br>
        Barcode: <input type="text" name="barcode" required><br>
        <input type="submit" value="Add Product">
    </form>

    <h2>Items</h2>
    <table border="2">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Barcode</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td><?= htmlspecialchars($product['price']) ?></td>
            <td><?= htmlspecialchars($product['quantity']) ?></td>
            <td><?= htmlspecialchars($product['barcode']) ?></td>
            <td><?= htmlspecialchars($product['created_at']) ?></td>
            <td><?= htmlspecialchars($product['updated_at']) ?></td>
            <td>
                <a href="update.php?id=<?= $product['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $product['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
