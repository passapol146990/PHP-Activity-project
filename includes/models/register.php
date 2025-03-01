<?php
require_once '../includes/db.php'; // ไฟล์เชื่อมต่อฐานข้อมูล

function registerUser($pid, $aid, $status = 'รอการตรวจสอบ') {
    global $conn;

    // ตรวจสอบว่า pid มีอยู่ในตาราง post หรือไม่
    $checkPostStmt = $conn->prepare("SELECT p_id FROM post WHERE p_id = ?");
    $checkPostStmt->bind_param("s", $pid);
    $checkPostStmt->execute();
    $checkPostStmt->store_result();

    if ($checkPostStmt->num_rows == 0) {
        return ["status" => 404, "message" => "Post not found"];
    }

    // ตรวจสอบว่า aid มีอยู่ในตาราง account หรือไม่
    $checkAccountStmt = $conn->prepare("SELECT aid FROM account WHERE aid = ?");
    $checkAccountStmt->bind_param("s", $aid);
    $checkAccountStmt->execute();
    $checkAccountStmt->store_result();

    if ($checkAccountStmt->num_rows == 0) {
        return ["status" => 404, "message" => "Account not found"];
    }

    // ตรวจสอบว่าผู้ใช้เคยลงทะเบียนในโพสต์นี้แล้วหรือไม่
    $checkRegisterStmt = $conn->prepare("SELECT id FROM register WHERE pid = ? AND aid = ?");
    $checkRegisterStmt->bind_param("ss", $pid, $aid);
    $checkRegisterStmt->execute();
    $checkRegisterStmt->store_result();

    if ($checkRegisterStmt->num_rows > 0) {
        return ["status" => 400, "message" => "User already registered for this post"];
    }

    // เพิ่มข้อมูลลงในตาราง register
    $stmt = $conn->prepare("INSERT INTO register (pid, aid, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $pid, $aid, $status);

    if ($stmt->execute()) {
        return ["status" => 200, "message" => "ลงทะเบียนสำเร็จ"];
    } else {
        return ["status" => 500, "message" => "Database error: " . $stmt->error];
    }
}