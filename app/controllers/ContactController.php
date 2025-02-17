<?php
class ContactController {
    public function index() {
        require_once '../app/views/contact.php';
    }

    public function submit() {
        // ตรวจสอบว่าข้อมูลถูกส่งมาด้วย POST หรือไม่
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            // ตัวอย่างการแสดงผลข้อมูล (สามารถเปลี่ยนเป็นบันทึกในฐานข้อมูลได้)
            echo "<h1>Thank You!</h1>";
            echo "<p>Name: $name</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Message: $message</p>";
        } else {
            // ถ้าไม่ใช่การส่งแบบ POST กลับไปที่ฟอร์ม
            header('Location: /contact');
            exit();
        }
    }
}
