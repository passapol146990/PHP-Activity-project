<?php
session_start();
header('Content-Type: text/html; charset=utf-8'); // ต้องเรียกก่อนมี output
header("Access-Control-Allow-Origin: *");
function formatThaiDate($d) {
    return date("j ", strtotime($d)) . ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."][date("n", strtotime($d))-1] . " " . (date("Y", strtotime($d)) + 543);
}
$google_client_id = "656159499613-m1ql830ogktmslu2pecormultjc8m9r0.apps.googleusercontent.com";
$google_client_secret = "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";
// $google_redirect_uri = "https://caiman-steady-flounder.ngrok-free.app/auth/google/callback";
$google_redirect_uri = "http://localhost/auth/google/callback";


require_once '../includes/router.php';
// print("แก้แปป");
?>