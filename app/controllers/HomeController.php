<?php
class HomeController {
    public function index() {
        $message = "Welcome to " . APP_NAME;
        require_once '../app/views/home.php';
    }

    public function about() {
        $message = "About Us - Learn more about " . APP_NAME;
        require_once '../app/views/home.php';
    }
}
