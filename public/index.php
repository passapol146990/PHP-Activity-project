<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
function formatThaiDate($d) {
    return date("j ", strtotime($d)) . ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."][date("n", strtotime($d))-1] . " " . (date("Y", strtotime($d)) + 543);
}


require_once '../includes/router.php';
?>