<?php
class ProductController {
    // ดึงข้อมูลสินค้าในหน้าแรก
    public function index() {
        $products = [
            ['id' => 1, 'name' => 'Laptop', 'price' => 1000],
            ['id' => 2, 'name' => 'Phone', 'price' => 500],
            ['id' => 3, 'name' => 'Tablet', 'price' => 300],
        ];
        require_once '../app/views/products.php';
    }

    // ฟังก์ชัน show สำหรับแสดงรายละเอียดสินค้าตาม ID
    public function show($id) {
        // สมมุติว่าเรามีข้อมูลสินค้าในรูปแบบ associative array
        $products = [
            1 => ['name' => 'Laptop', 'price' => 1000],
            2 => ['name' => 'Phone', 'price' => 500],
            3 => ['name' => 'Tablet', 'price' => 300],
        ];

        // ตรวจสอบว่ามีสินค้าตาม ID ที่ร้องขอหรือไม่
        if (isset($products[$id])) {
            $product = $products[$id]; // ดึงข้อมูลสินค้าที่มี ID ตรงกับที่ผู้ใช้ร้องขอ
            // แสดงผลข้อมูลสินค้า
            require_once '../app/views/product_detail.php';
        } else {
            // ถ้าไม่พบสินค้าให้แสดง 404
            http_response_code(404);
            echo "Product not found";
        }
    }
}
