<?php
session_start();
header('Content-Type: text/html; charset=utf-8'); // ต้องเรียกก่อนมี output
header("Access-Control-Allow-Origin: *");

$google_client_id = "656159499613-m1ql830ogktmslu2pecormultjc8m9r0.apps.googleusercontent.com";
$google_client_secret = "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";
// $google_redirect_uri = "https://caiman-steady-flounder.ngrok-free.app/auth/google/callback";
$google_redirect_uri = "http://localhost/auth/google/callback";


require_once '../includes/router.php';
?>