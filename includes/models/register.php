<?php
require_once '../includes/db.php';
function registerUser($pid, $aid) {
    global $conn;
    $status = 'รอการตรวจสอบ';
    $checkPostStmt = $conn->prepare("SELECT p_id FROM post WHERE p_id = ?");
    $checkPostStmt->bind_param("s", $pid);
    $checkPostStmt->execute();
    $checkPostStmt->store_result();
    if ($checkPostStmt->num_rows == 0) {
        return ["status" => 404, "message" => "Post not found"];
    }
    $checkRegisterStmt = $conn->prepare("SELECT id FROM register WHERE pid = ? AND aid = ?");
    $checkRegisterStmt->bind_param("ss", $pid, $aid);
    $checkRegisterStmt->execute();
    $checkRegisterStmt->store_result();
    if ($checkRegisterStmt->num_rows > 0) {
        return ["status" => 400, "message" => "User already registered for this post"];
    }
    $stmt = $conn->prepare("INSERT INTO register (pid, aid, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $pid, $aid, $status);
    if ($stmt->execute()) {
        return ["status" => 200, "message" => "ลงทะเบียนสำเร็จ"];
    } else {
        return ["status" => 500, "message" => "Database error: " . $stmt->error];
    }
}
function getRegisterByIdPostAndIdUser($pid,$aid,$limit,$page){
    global $conn;
    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;
    $stmt = $conn->prepare("
        SELECT 
            account.*, 
            register.status as status
        FROM register
        JOIN account ON account.aid = register.aid
        JOIN post ON register.pid = post.p_id
        WHERE register.pid = ?
        AND post.p_aid = ?;
    ");
    if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
    $stmt->bind_param("ss", $pid,$aid);
    if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
    $result = $stmt->get_result();
    if($result->num_rows === 0){return ["status"=>400,"message"=>"ไม่พบข้อมูล"];}
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return ["status"=>200,"message"=>"successfully.","data"=>$data];
};
function getRegisteredActivities($account_id) {
    global $conn;

    // คำสั่ง SQL เพื่อดึงข้อมูล
    $sql = "
        SELECT 
            r.id AS register_id,
            r.datetime AS register_datetime,
            r.status AS register_status,
            p.p_id AS post_id,
            p.p_name AS post_name,
            p.p_date_start AS post_date_start,
            p.p_date_end AS post_date_end,
            p.p_max AS post_max,
            p.p_about AS post_about,
            p.p_give AS post_give,
            p.p_datetime AS post_datetime,
            i.image AS post_image, -- ดึงรูปภาพจากตาราง image
            (SELECT COUNT(*) FROM register WHERE pid = p.p_id) AS registered_count,
            (SELECT COUNT(*) FROM register WHERE pid = p.p_id AND status = 'approved') AS approved_registers,
            (SELECT COUNT(*) FROM register WHERE pid = p.p_id AND status = 'rejected') AS rejected_registers,
            (SELECT COUNT(*) FROM register WHERE pid = p.p_id AND status = 'pending') AS pending_registers
        FROM 
            register r
        JOIN 
            post p ON r.pid = p.p_id
        LEFT JOIN 
            image i ON p.p_id = i.pid -- เชื่อมกับตาราง image
        WHERE 
            r.aid = ? -- ใช้ Account ID ของคุณ
    ";

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // เก็บผลลัพธ์ในอาร์เรย์
    $registered_activities = [];
    while ($row = $result->fetch_assoc()) {
        $registered_activities[] = $row;
    }

    return $registered_activities;
}
// เรียกใช้ฟังก์ชัน

?>