<?php
class ProductController {
    public function index() {
        $products = [
            ['id' => 1, 'name' => 'Laptop', 'price' => 1000],
            ['id' => 2, 'name' => 'Phone', 'price' => 500],
            ['id' => 3, 'name' => 'Tablet', 'price' => 300],
        ];
        require_once '../app/views/products.php';
    }

    public function show($id) {
        $products = [
            1 => ['name' => 'Laptop', 'price' => 1000],
            2 => ['name' => 'Phone', 'price' => 500],
            3 => ['name' => 'Tablet', 'price' => 300],
        ];
        if (isset($products[$id])) {
            $product = $products[$id];
            require_once '../app/views/product_detail.php';
        } else {
            http_response_code(404);
            echo "Product not found";
        }
    }
}
