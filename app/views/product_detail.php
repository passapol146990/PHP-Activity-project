<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $product['name'] ?> - Product Detail</title>
</head>
<body>
<?php require_once __DIR__ . '/component/navbar.php'; ?>
    <h1><?= $product['name'] ?></h1>
    <p>Price: $<?= $product['price'] ?></p>
    <a href="/products">Back to Products</a>
</body>
</html>
