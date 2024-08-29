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
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
