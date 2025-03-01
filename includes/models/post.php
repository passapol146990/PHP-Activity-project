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
    function getPostById($id){
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
    function getPostUserCreate($id){
        
    }
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