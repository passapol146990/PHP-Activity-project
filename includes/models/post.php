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
?>