<?php
// Fetch all products
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

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
