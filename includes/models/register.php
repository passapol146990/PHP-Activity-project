<?php
require_once '../includes/db.php';
require_once 'post.php';

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
    $count = getCounApproveRegister($pid);
    if(!$count){
        return ["status" => 400, "message" => "กิจกรรมนี้คนสมัครเต็มแล้ว"];
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
function getRegisteredActivities($aid, $limit, $page, $keyword = '', $date_start = '', $date_end = '') {
    global $conn;

    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;

    $where = "register.aid = ?";
    $params = [$aid];
    $param_types = "s"; // $aid เป็น string

    if (!empty($keyword)) {
        $where .= " AND post.p_name LIKE ?";
        $params[] = "%$keyword%";
        $param_types .= "s";
    }

    if (!empty($date_start) && !empty($date_end)) {
        $where .= " AND (post.p_date_start <= ? AND post.p_date_end >= ?)";
        $params[] = $date_end;
        $params[] = $date_start;
        $param_types .= "ss";
    }

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
        WHERE $where
        ORDER BY register.datetime DESC
        LIMIT ?, ?
    "; 

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }

    // เพิ่ม offset และ limit
    $params[] = $offset;
    $params[] = $limit;
    $param_types .= "ii"; 

    $stmt->bind_param($param_types, ...$params);
    if (!$stmt->execute()) {
        return ["status" => 400, "message" => "execute error!"];
    }

    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return ["status" => 201, "message" => "ไม่พบข้อมูล", "data" => []];
    }

    $data = $result->fetch_all(MYSQLI_ASSOC);
    return ["status" => 200, "message" => "successfully.", "data" => $data];
}


function DeleteRegister($rid,$pid,$aid) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM register WHERE id = ? AND pid = ? AND aid = ?;");
    $stmt->bind_param("iss", $rid,$pid,$aid);
    $stmt->execute();
    return ["status" => 200, "message" => "ยกเลิกคำขอเข้าร่วมสำเร็จ"];
}

function updateStatusSubmit($pid,$aid,$login_token,$status){
    isLogin();
    global $conn;
    $sql  = `UPDATE 	register
    JOIN 	post ON post.p_id = register.pid
    SET 	status_submit = ?
    WHERE 	post.p_id = ?
    AND		register.aid = ?
    AND		post.p_aid = ?`;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss",$status,$pid,$aid,$login_token);
    $stmt->execute();
    return ["status" => 200, "message" => "อัพเดทสถานะส่งภาพยืนยันสำเร็จแล้ว"];
}

function getTop10register(){
    global $conn;
    $sql = 'SELECT
            COUNT(register.status) AS total_regis,
            post.p_name
            FROM register
            JOIN post ON register.pid = post.p_id
            GROUP BY register.pid, post.p_name
            ORDER BY total_regis DESC
            LIMIT 10';
    $stmt = $conn->prepare($sql);
    if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
    if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
    $result = $stmt->get_result();
    if($result->num_rows === 0){return ["status"=>201,"message"=>"ไม่พบข้อมูล"];}
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return ["status"=>200,"message"=>"successfully.","data"=>$data];
}
function getCountUser_reqRoundYear($login_token, $month) {
    global $conn;
    $sql = "SELECT 
                MONTH(r.datetime) AS month, 
                COUNT(*) AS total_requests
            FROM register r
            JOIN post p ON p.p_id = r.pid
            WHERE p.p_aid = ? 
            AND YEAR(r.datetime) = YEAR(CURDATE()) 
            AND MONTH(r.datetime) = ?
            GROUP BY MONTH(r.datetime)
            ORDER BY month;";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }
    $stmt->bind_param("si", $login_token, $month);
    
    if (!$stmt->execute()) {
        return ["status" => 400, "message" => "execute error!"];
    }
    $result = $stmt->get_result();
    if($result->num_rows == 0){
        return 0;
    }
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return  $data[0]["total_requests"];
}
function getRegisterByMonth($login_token){
    $data = [];
    for($i=1;$i<13;$i++){
        $data[] = getCountUser_reqRoundYear($login_token,$i);
    }
    return $data;
}
 
function getCountStatus_1($login_token){
    global $conn;
    $sql = "SELECT 
                    SUM(CASE WHEN status = 'อนุมัติ' THEN 1 ELSE 0 END) AS approved,
                    SUM(CASE WHEN status = 'ปฏิเสธ' THEN 1 ELSE 0 END) AS rejected,
                    SUM(CASE WHEN status = 'รอการตรวจสอบ' THEN 1 ELSE 0 END) AS pending
                    FROM register
                    WHERE pid IN (SELECT p_id FROM post WHERE p_aid = ?)";
     $stmt = $conn->prepare($sql);
     if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
     $stmt->bind_param("s", $login_token);
     if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
     $result = $stmt->get_result();
     
     $data = $result->fetch_all(MYSQLI_ASSOC);
     return ["status"=>200,"message"=>"successfully.","data"=>$data];
}

function getCountStatus_2($login_token){
    global $conn;
    $sql = "SELECT   SUM(CASE WHEN status = 'อนุมัติ' THEN 1 ELSE 0 END) AS approved,
                    SUM(CASE WHEN status = 'ปฏิเสธ' THEN 1 ELSE 0 END) AS rejected,
                    SUM(CASE WHEN status = 'รอการตรวจสอบ' THEN 1 ELSE 0 END) AS pending
                    FROM register
                    WHERE aid = ? ";
     $stmt = $conn->prepare($sql);
     if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
     $stmt->bind_param("s", $login_token);
     if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
     $result = $stmt->get_result();
     
     $data = $result->fetch_all(MYSQLI_ASSOC);
     return ["status"=>200,"message"=>"successfully.","data"=>$data];

}
?>