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
        return ["status" => 400, "message" => "คุณสมัครกิจกรรมนี้แล้ว"];
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
    if($result->num_rows === 0){return ["status"=>201,"message"=>"ไม่พบข้อมูล"];}
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return ["status"=>200,"message"=>"successfully.","data"=>$data];
};
function upadteResgister($pid,$aid,$uid,$status){
    global $conn;
    $sql = 'UPDATE register 
            JOIN post ON post.p_id = register.pid
            SET register.status = ?
            WHERE register.pid = ?
            AND register.aid = ?
            AND post.p_aid = ?;
    ';
    $stmt = $conn->prepare($sql);
    if (!$stmt) {return ["status" => 400, "message" => "Prepare error: " . $conn->error];}
    $stmt->bind_param('ssss',$status, $pid,$uid,$aid);
    if (!$stmt->execute()) {return ["status" => 400, "message" => "Execute error: " . $stmt->error];}
    return ["status" => 200, "message" => "อัพเดทคำขอเข้าร่วมสำเร็จ"];
}
function getRegisteredActivities($account_id) {
    global $conn;
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
            i.image AS post_image, 
            a.fname AS creator_fname,
            a.lname AS creator_lname,
            a.image AS creator_image,
            (SELECT COUNT(*) FROM register WHERE pid = p.p_id AND status = 'อนุมัติการเข้าร่วม') AS approved_registers
        FROM 
            register r
        JOIN 
            post p ON r.pid = p.p_id
        LEFT JOIN 
            image i ON p.p_id = i.pid
        LEFT JOIN 
            account a ON p.p_aid = a.aid
        WHERE 
            r.aid = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $registered_activities = [];
    while ($row = $result->fetch_assoc()) {
        $registered_activities[] = $row;
    }

    return $registered_activities;
}
function cancelRegistration($register_id) {
    global $conn;

    if (!$conn) {
        return ["status" => 500, "message" => "Database connection error"];
    }

    $stmt = $conn->prepare("DELETE FROM register WHERE id = ?");
    if (!$stmt) {
        return ["status" => 500, "message" => "Prepare statement error"];
    }

    $stmt->bind_param("i", $register_id);
    if (!$stmt->execute()) {
        return ["status" => 500, "message" => "Execute statement error"];
    }

    if ($stmt->affected_rows > 0) {
        return ["status" => 200, "message" => "ยกเลิกการสมัครสำเร็จ"];
    } else {
        return ["status" => 404, "message" => "ไม่พบข้อมูลการสมัคร"];
    }
}
?>