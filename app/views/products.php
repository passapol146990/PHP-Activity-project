<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - <?= APP_NAME ?></title>
</head>
<body>
<?php require_once __DIR__ . '/component/navbar.php'; ?>
    <h1>Our Products</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <a href="/products/<?= $product['id'] ?>">
                    <?= $product['name'] ?> - $<?= $product['price'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/home">Go Back Home</a>
</body>
</html>
