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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $barcode = $_POST['barcode'];

        $sql = "UPDATE products SET name = ?, description = ?, price = ?, quantity = ?, barcode = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $price, $quantity, $barcode, $id]);

        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!-- HTML form for editing -->
<form method="post">
    Name: <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>
    Description: <input type="text" name="description" value="<?= htmlspecialchars($product['description']) ?>" required><br>
    Price: <input type="text" name="price" value="<?= htmlspecialchars($product['price']) ?>" required><br>
    Quantity: <input type="text" name="quantity" value="<?= htmlspecialchars($product['quantity']) ?>" required><br>
    Barcode: <input type="text" name="barcode" value="<?= htmlspecialchars($product['barcode']) ?>" required><br>
    <input type="submit" value="Update Product">
</form>
