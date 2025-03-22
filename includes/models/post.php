<?php
require_once '../includes/db.php';
function getPostx($user_aid, $limit, $page, $keyword = '', $date_start = '', $date_end = '') {
    global $conn;
    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;
    $where = "1=1";
    $params = [];

    if (!empty($keyword)) {
        $where .= " AND post.p_name LIKE ?";
        $params[] = "%$keyword%";
    }
    if (!empty($date_start) && !empty($date_end)) {
        $where .= " AND (post.p_date_start BETWEEN ? AND ?)";
        $params[] = $date_start;
        $params[] = $date_end;
    } else if (!empty($date_start)) {
        $where .= " AND post.p_date_start >= ?";
        $params[] = $date_start;
    }

    $sql = "SELECT 
                post.*, 
                (SELECT image.image FROM image WHERE image.pid = post.p_id LIMIT 1) AS image, 
                (SELECT status FROM register 
                WHERE register.pid = post.p_id 
                AND register.aid = ? 
                LIMIT 1) AS user_status,
                COUNT(register.pid) AS total_registers,
                SUM(CASE WHEN register.status = 'อนุมัติ' THEN 1 ELSE 0 END) AS approved_count
            FROM post
            LEFT JOIN register ON register.pid = post.p_id
            WHERE $where
            GROUP BY post.p_id
            ORDER BY post.p_datetime DESC
            LIMIT ?, ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $param_types = "s" . str_repeat("s", count($params)) . "ii";
    array_unshift($params, $user_aid);
    $params[] = $offset;
    $params[] = $limit;

    $stmt->bind_param($param_types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return ["status" => 200, "message" => "successfully.", "data" => $data];
}
function getPost($limit, $page)
{
    global $conn;
    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;
    $stmt = $conn->prepare("
            SELECT
                post.*, 
                (SELECT image.image FROM image WHERE image.pid = post.p_id LIMIT 1) AS image, 
                COUNT(register.pid) AS total_registers,
                SUM(CASE WHEN register.status = 'รอการตรวจสอบ' THEN 1 ELSE 0 END) AS waiting,
                SUM(CASE WHEN register.status = 'อนุมัติ' THEN 1 ELSE 0 END) AS approved,
                SUM(CASE WHEN register.status = 'ปฏิเสธ' THEN 1 ELSE 0 END) AS rejected
            FROM post
            LEFT JOIN register ON register.pid = post.p_id
            GROUP BY post.p_id
            ORDER BY post.p_datetime DESC
            LIMIT ?, ?;
        ");
    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }
    $stmt->bind_param("ii", $offset, $limit);
    if (!$stmt->execute()) {
        return ["status" => 400, "message" => "execute error!"];
    }
    $result = $stmt->get_result();
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    return ["status" => 200, "message" => "successfully.", "data" => $posts];
};
function getPostDetailById($id, $id_user)
{
    global $conn;
    $stmt = $conn->prepare("
            SELECT 
                account.image AS img,
                account.fname AS fname,
                account.lname AS lname,
                post.p_id AS post_id,
                post.p_name AS post_name,
                post.p_about AS post_about,
                post.p_max AS post_people,
                post.p_address AS post_address,
                post.p_date_start AS post_start, 
                post.p_date_end AS post_end,
                post.p_give AS post_give,
                post.p_datetime AS post_create,
                register.status AS user_status,
                GROUP_CONCAT(image.image) AS images
            FROM post
            JOIN account ON account.aid = post.p_aid
            LEFT JOIN image ON image.pid = post.p_id
            LEFT JOIN register ON register.pid = post.p_id AND register.aid = ?
            WHERE post.p_id = ? 
            GROUP BY 
                post.p_id, 
                account.image, 
                account.fname, 
                account.lname, 
                post.p_name, 
                post.p_about, 
                post.p_max, 
                post.p_address, 
                post.p_date_start, 
                post.p_date_end, 
                post.p_give, 
                post.p_datetime, 
                register.status;
        ");

    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }
    $stmt->bind_param("ss", $id_user, $id);
    if (!$stmt->execute()) {
        return ["status" => 400, "message" => "execute error!"];
    }
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return ["status" => 400, "message" => "ไม่พบข้อมูล"];
    }
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    return ["status" => 200, "message" => "successfully.", "data" => $posts];
}
function getPostUserCreateX($id, $limit, $page, $keyword = '', $date_start = '', $date_end = '') {
    global $conn;
    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;

    $where = "account.aid = ?";
    $params = [$id];
    $param_types = "s"; // account.aid เป็น String

    if (!empty($keyword)) {
        $where .= " AND post.p_name LIKE ?";
        $params[] = "%$keyword%";
        $param_types .= "s";
    }
    if (!empty($date_start) && !empty($date_end)) {
        $where .= " AND (post.p_date_start BETWEEN ? AND ?)";
        $params[] = $date_start;
        $params[] = $date_end;
        $param_types .= "ss";
    } else if (!empty($date_start)) {
        $where .= " AND post.p_date_start >= ?";
        $params[] = $date_start;
        $param_types .= "s";
    }

    $sql = "
        SELECT 
            post.*, 
            (SELECT image.image FROM image WHERE image.pid = post.p_id LIMIT 1) AS image, 
            COUNT(register.pid) AS total_registers, 
            SUM(CASE WHEN register.status = 'รอการตรวจสอบ' THEN 1 ELSE 0 END) AS pending_registers,
            SUM(CASE WHEN register.status = 'อนุมัติ' THEN 1 ELSE 0 END) AS approved_registers,
            SUM(CASE WHEN register.status = 'ปฏิเสธ' THEN 1 ELSE 0 END) AS rejected_registers
        FROM post
        JOIN account ON post.p_aid = account.aid
        LEFT JOIN register ON post.p_id = register.pid
        WHERE $where
        GROUP BY post.p_id
        ORDER BY post.p_datetime DESC
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
        return ["status" => 400, "message" => "ไม่พบข้อมูล"];
    }

    $posts = $result->fetch_all(MYSQLI_ASSOC);
    return ["status" => 200, "message" => "successfully.", "data" => $posts];
}

function getPostUserCreate($id, $limit, $page)
{
    global $conn;
    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;
    $stmt = $conn->prepare("
            SELECT 
                post.*, 
                (SELECT image.image FROM image WHERE image.pid = post.p_id LIMIT 1) AS image, 
                COUNT(register.pid) AS total_registers, 
                SUM(CASE WHEN register.status = 'รอการตรวจสอบ' THEN 1 ELSE 0 END) AS pending_registers,
                SUM(CASE WHEN register.status = 'อนุมัติ' THEN 1 ELSE 0 END) AS approved_registers,
                SUM(CASE WHEN register.status = 'ปฏิเสธ' THEN 1 ELSE 0 END) AS rejected_registers
            FROM post
            JOIN account ON post.p_aid = account.aid
            LEFT JOIN register ON post.p_id = register.pid
            WHERE account.aid = ?
            GROUP BY post.p_id
            ORDER BY post.p_datetime DESC
            LIMIT ?, ?;

        ");
    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }
    $stmt->bind_param("sii", $id, $offset, $limit);
    if (!$stmt->execute()) {
        return ["status" => 400, "message" => "execute error!"];
    }
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return ["status" => 400, "message" => "ไม่พบข้อมูล"];
    }
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    return ["status" => 200, "message" => "successfully.", "data" => $posts];
};
function getCountWaitRegister($pid)
{
    global $conn;
    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;
    $stmt = $conn->prepare("
            SELECT COUNT(*) AS total_registers
            FROM register
            JOIN post ON post.p_id = register.pid
            WHERE post.p_aid = ?
            AND register.status = 'รอการตรวจสอบ';
        ");
    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }
    $stmt->bind_param("s", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return 0;
    }
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data[0]["total_registers"];
};
function getCountNumberApproveRegisterFromPost($pid)
{
    global $conn;
    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;
    $stmt = $conn->prepare("
            SELECT COUNT(*) AS total_registers
            FROM register
            JOIN post ON post.p_id = register.pid
            WHERE post.p_id = ?
            AND register.status = 'อนุมัติ';
        ");
    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }
    $stmt->bind_param("s", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return 0;
    }
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data[0]["total_registers"];
};
function getMaxCountNumberFromPost($pid)
{
    global $conn;
    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;
    $stmt = $conn->prepare("
            SELECT p_max as max_count
                FROM post
                WHERE p_id = ?
        ");
    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }
    $stmt->bind_param("s", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return 0;
    }
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data[0]["max_count"];
};
function getCounApproveRegister($pid)
{
    global $conn;
    $page = isset($page) ? (int)$page : 1;
    $limit = isset($limit) ? (int)$limit : 10;
    $offset = ($page - 1) * $limit;
    $stmt = $conn->prepare("
            SELECT COUNT(*) AS total_registers, post.p_max as p_max
            FROM register
            JOIN post ON post.p_id = register.pid
            WHERE post.p_id = ?
            AND register.status = 'อนุมัติ'
            GROUP BY post.p_max;
        ");
    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }
    $stmt->bind_param("s", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    if ($result->num_rows === 0) {
        return true;
    }
    if ($data[0]["total_registers"] >= $data[0]["p_max"]) {
        return false;
    }
    return true;
};
function createPost($p_id, $p_aid, $p_name, $p_about, $p_max, $p_address, $p_date_start, $p_date_end, $p_give)
{
    global $conn;
    $p_max = intval($p_max);
    if ($p_max <= 0) {
        $p_max = 1;
    }
    $sql = 'INSERT INTO post(p_id,p_aid,p_name,p_about,p_max,p_address,p_date_start,p_date_end,p_give) VALUES(?,?,?,?,?,?,?,?,?)';
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }
    $stmt->bind_param('ssssdssss', $p_id, $p_aid, $p_name, $p_about, $p_max, $p_address, $p_date_start, $p_date_end, $p_give);
    if (!$stmt->execute()) {
        return ["status" => 400, "message" => "execute error!"];
    }
    $data = $stmt->get_result();
    return ["status" => 200, "message" => "successfuly.", "data" => $data];
};
function deletePostByIdPostAndIdUser($pid, $aid)
{
    global $conn;
    $sql = 'DELETE FROM post WHERE post.p_id = ? AND post.p_aid = ?;';
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return ["status" => 400, "message" => "prepare error!"];
    }
    $stmt->bind_param('ss', $pid, $aid);
    if (!$stmt->execute()) {
        return ["status" => 400, "message" => "execute error!"];
    }
    $data = $stmt->get_result();
    return ["status" => 200, "message" => "successfuly.", "data" => $data];
};
function updatePost($p_id, $p_aid, $p_name, $p_about, $p_max, $p_address, $p_date_start, $p_date_end, $p_give)
{
    global $conn;
    $p_max = intval($p_max);
    if ($p_max <= 0) {
        $p_max = 1;
    }
    $sql = 'UPDATE post 
            SET p_name = ?, p_about = ?, p_max = ?, p_address = ?, p_date_start = ?, p_date_end = ?, p_give = ?
            WHERE p_id = ? AND p_aid = ?';
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return ["status" => 400, "message" => "Prepare error: " . $conn->error];
    }
    $stmt->bind_param('ssdssssss',  $p_name, $p_about, $p_max, $p_address, $p_date_start, $p_date_end, $p_give, $p_id, $p_aid);
    if (!$stmt->execute()) {
        return ["status" => 400, "message" => "Execute error: " . $stmt->error];
    }
    if ($stmt->affected_rows === 0) {
        return ["status" => 204, "message" => "No changes made."];
    }
    return ["status" => 200, "message" => "Updated successfully."];
};


function getPosttoedit($p_id, $p_aid){
    global $conn;
    $stmt = $conn->prepare("
            SELECT 
                post.p_id AS post_id,
                post.p_name AS post_name,
                post.p_about AS post_about,
                post.p_max AS post_max,
                post.p_address AS post_address,
                post.p_date_start AS post_start, 
                post.p_date_end AS post_end,
                post.p_give AS post_give,
                post.p_datetime AS post_create,
            IFNULL(GROUP_CONCAT(image.image SEPARATOR ', '), '') AS images
            FROM post
            JOIN account ON account.aid = post.p_aid
            LEFT JOIN image ON image.pid = post.p_id
            WHERE post.p_id = ? AND post.p_aid = ?
            GROUP BY 
                post.p_id, 
                post.p_name, 
                post.p_about, 
                post.p_max, 
                post.p_address, 
                post.p_date_start, 
                post.p_date_end, 
                post.p_give, 
                post.p_datetime
            ");
    if (!$stmt) {
        return ["status" => 400, "message" => "Prepare error!"];
    }
    $stmt->bind_param("ss", $p_id, $p_aid);
    if (!$stmt->execute()) {
        return ["status" => 400, "message" => "Execute error!"];
    }
    $data = $stmt->get_result();
    if ($data->num_rows === 0) {
        return ["status" => 400, "message" => "ไม่พบข้อมูล"];
    }
    $result = $data->fetch_assoc();
    return ["status" => 200, "message" => "Successfully.", "data" => $result];
};
