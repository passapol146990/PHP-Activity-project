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
?>