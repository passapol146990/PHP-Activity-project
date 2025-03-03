<?php
require_once '../includes/db.php';

function registerUser($pid, $aid) {
    global $conn;
    $status = 'รอการตรวจสอบ';
    $checkPostStmt = $conn->prepare("SELECT p_id FROM post WHERE p_id = ?");
    if(!$checkPostStmt){return ["status"=>400,"message"=>"prepare post error!"];}
    $checkPostStmt->bind_param("s", $pid);
    if(!$checkPostStmt->execute()){return ["status"=>400,"message"=>"execute post error!"];}
    $checkPostStmt->store_result();
    if($checkPostStmt->num_rows === 0){return ["status"=>201,"message"=>"post ไม่พบข้อมูล"];}

    $checkRegisterStmt = $conn->prepare("SELECT pid FROM register WHERE pid = ? AND aid = ?");
    if(!$checkRegisterStmt){return ["status"=>400,"message"=>"prepare register error!"];}
    $checkRegisterStmt->bind_param("ss", $pid, $aid);
    if(!$checkRegisterStmt->execute()){return ["status"=>400,"message"=>"execute register error!"];}
    $checkRegisterStmt->store_result();
    if ($checkRegisterStmt->num_rows > 0) {
        return ["status" => 400, "message" => "คุณสมัครกิจกรรมนี้แล้ว"];
    }
    $stmt = $conn->prepare("INSERT INTO register (pid, aid, status) VALUES (?, ?, ?)");
    if(!$stmt){return ["status"=>400,"message"=>"prepare register error!"];}
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
function getWaitRegister($aid){
    global $conn;
    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;
    $stmt = $conn->prepare("
        SELECT  COUNT(*) as wait_register
        FROM 	register
        WHERE	status = 'รอการตรวจสอบ'
        AND 	aid = ?;
    ");
    $stmt->bind_param("s",$aid);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0){
        return 0;
    }
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return  $data[0]["wait_register"];
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
function getRegisteredActivities($aid,$limit,$page) {
    global $conn;
    $sql = "
        SELECT  
            register.id AS register_id,
            register.datetime AS register_datetime,
            register.status AS register_status,
            post.p_id AS post_id,
            post.p_name AS post_name,
            post.p_date_start AS post_date_start,
            post.p_date_end AS post_date_end,
            post.p_max AS post_max,
            post.p_about AS post_about,
            post.p_give AS post_give,
            post.p_datetime AS post_datetime,
            (
                SELECT image 
                FROM image 
                WHERE image.pid = post.p_id 
                LIMIT 1
            ) AS post_image, 
            account.fname AS creator_fname,
            account.lname AS creator_lname,
            account.image AS creator_image,
            (
                SELECT COUNT(*) 
                FROM register 
                WHERE register.pid = post.p_id AND register.status = 'อนุมัติ'
            ) AS approved_registers
        FROM register
        JOIN post ON register.pid = post.p_id
        JOIN account ON post.p_aid = account.aid
        WHERE register.aid = ?;

    ";
    $stmt = $conn->prepare($sql);
    if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
    $stmt->bind_param("s",$aid);
    if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
    $result = $stmt->get_result();
    if($result->num_rows === 0){return ["status"=>201,"message"=>"ไม่พบข้อมูล","data"=>[]];}
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return ["status"=>200,"message"=>"successfully.","data"=>$data];
}
function DeleteRegister($rid,$pid,$aid) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM register WHERE id = ? AND pid = ? AND aid = ?;");
    $stmt->bind_param("iss", $rid,$pid,$aid);
    $stmt->execute();
    return ["status" => 200, "message" => "ยกเลิกคำขอเข้าร่วมสำเร็จ"];
}
?>