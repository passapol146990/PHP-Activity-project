<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?></title>
</head>
<body>
    <?php require_once __DIR__ . '/component/navbar.php'; ?>
    <h1><?= $message ?></h1>
    <a href="/products">View Products</a>
    <a href="/about">About Us</a>
</body>
</html>
