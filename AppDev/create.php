<?php
// Add Product

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];

    $sql = "INSERT INTO products (name, description, price, quantity, barcode) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $price, $quantity, $barcode]);

    header("Location: index.php"); // Redirect to the main page
    exit();
}
?>
