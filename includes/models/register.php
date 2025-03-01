<?php
    require_once '../includes/db.php';
    function createRegister($id_user,$id_post){
        
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
    
?>