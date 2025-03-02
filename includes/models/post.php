<?php
    require_once '../includes/db.php';
    function getPost($limit, $page){
        global $conn;
        $page = isset($page) ? (int)$page : 1;
        $limit = isset($limit) ? (int)$limit : 10;
        $offset = ($page - 1) * $limit;

        $stmt = $conn->prepare("
            SELECT post.*, 
                (SELECT image.image FROM image WHERE image.pid = post.p_id LIMIT 1) AS image
            FROM post
            ORDER BY post.p_datetime DESC
            LIMIT ?, ?;
        ");
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param("ii", $offset, $limit);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        $result = $stmt->get_result();
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        return ["status"=>200,"message"=>"successfully.","data"=>$posts];
    };
    function getPostBySearch($limit, $page, $search) {
        global $conn;
        $page = isset($page) ? (int)$page : 1;
        $limit = isset($limit) ? (int)$limit : 10;
        $offset = ($page - 1) * $limit;
        if (empty($search)) {
            return getPost($limit, $page); // ถ้าค้นหาว่าง ให้ดึงโพสต์ทั้งหมดแทน
        }
    
        // เพิ่มเงื่อนไขค้นหาผ่าน title หรือ description
        $stmt = $conn->prepare("
            SELECT post.*, 
                (SELECT image.image FROM image WHERE image.pid = post.p_id LIMIT 1) AS image
            FROM post
            WHERE (post.p_name LIKE ?) 
            ORDER BY post.p_datetime DESC
            LIMIT ?, ?;
        ");
    
        if (!$stmt) {
            return ["status" => 400, "message" => "prepare error!"];
        }
    
        // ใช้ wildcard '%' เพื่อค้นหาคำที่คล้ายกัน
        $searchTerm = "%$search%";
        $stmt->bind_param("sii", $searchTerm, $offset, $limit);
    
        if (!$stmt->execute()) {
            return ["status" => 400, "message" => "execute error!"];
        }
    
        $result = $stmt->get_result();
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        
        return ["status" => 200, "message" => "successfully.", "data" => $posts];
    }
    
    function getPostDetailById($id){
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
                GROUP_CONCAT(image.image) AS images
            FROM post
            JOIN account ON account.aid = post.p_aid
            LEFT JOIN image ON image.pid = post.p_id
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
                post.p_datetime;
        ");
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param("s", $id);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        $result = $stmt->get_result();
        if($result->num_rows === 0){return ["status"=>400,"message"=>"ไม่พบข้อมูล"];}
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        return ["status"=>200,"message"=>"successfully.","data"=>$posts];
    };
    function getPostUserCreate($id,$limit, $page){
        global $conn;
        $page = isset($page) ? (int)$page : 1;
        $limit = isset($limit) ? (int)$limit : 10;
        $offset = ($page - 1) * $limit;
        $stmt = $conn->prepare("
            SELECT 
                post.*, 
                (SELECT image.image FROM image WHERE image.pid = post.p_id LIMIT 1) AS image, 
                COUNT(register.id) AS total_registers, 
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
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param("sii", $id,$offset, $limit);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        $result = $stmt->get_result();
        if($result->num_rows === 0){return ["status"=>400,"message"=>"ไม่พบข้อมูล"];}
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        return ["status"=>200,"message"=>"successfully.","data"=>$posts];
    };
    function createPost($p_id,$p_aid,$p_name,$p_about,$p_max,$p_address,$p_date_start,$p_date_end,$p_give){
        global $conn;
        $sql = 'INSERT INTO post(p_id,p_aid,p_name,p_about,p_max,p_address,p_date_start,p_date_end,p_give) VALUES(?,?,?,?,?,?,?,?,?)';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('ssssdssss',$p_id,$p_aid,$p_name,$p_about,$p_max,$p_address,$p_date_start,$p_date_end,$p_give);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        $data = $stmt->get_result();
        return ["status"=>200,"message"=>"successfuly.","data"=>$data];
    };
    function deletePostByIdPostAndIdUser($pid,$aid){
        global $conn;
        $sql = 'DELETE FROM post WHERE post.p_id = ? AND post.p_aid = ?;';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('ss',$pid,$aid);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        $data = $stmt->get_result();
        return ["status"=>200,"message"=>"successfuly.","data"=>$data];
    }

    function updatePost($p_id, $p_aid, $p_name, $p_about, $p_max, $p_address, $p_date_start, $p_date_end, $p_give) {
        global $conn;
        $sql = 'UPDATE post 
                SET p_name = ?, p_about = ?, p_max = ?, p_address = ?, p_date_start = ?, p_date_end = ?, p_give = ? 
                WHERE p_id = ? AND p_aid = ?';
        $stmt = $conn->prepare($sql);
        if (!$stmt) {return ["status" => 400, "message" => "Prepare error: " . $conn->error];}
        $stmt->bind_param('ssissssss', $p_name, $p_about, $p_max, $p_address, $p_date_start, $p_date_end, $p_give, $p_id, $p_aid);
        if (!$stmt->execute()) {return ["status" => 400, "message" => "Execute error: " . $stmt->error];}    
        if ($stmt->affected_rows === 0) {return ["status" => 204, "message" => "No changes made."];}
        return ["status" => 200, "message" => "Updated successfully."];
    }
   
    function getPosttoedit($p_id, $p_aid) {
    global $conn;
    
        $stmt = $conn->prepare("SELECT 
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
            post.p_datetime;"
    );
    if (!$stmt) {return ["status" => 400, "message" => "Prepare error!"];}
    $stmt->bind_param("ss", $p_id, $p_aid);
    if (!$stmt->execute()){return ["status" => 400, "message" => "Execute error!"];}
    $data = $stmt->get_result();
    if ($data->num_rows === 0) {return ["status" => 400, "message" => "ไม่พบข้อมูล"];}
    $result = $data->fetch_assoc(); // ดึงแค่ 1 แถว
    return ["status" => 200, "message" => "Successfully.", "data" => $result];
}

?>