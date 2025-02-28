<?php
    require_once '../includes/db.php';
    function getImage($id){
        global $conn;
        $sql = 'SELECT * FROM image WHERE iid = ?';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('s',$id);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        $data = $stmt->get_result();
        return ["status"=>200,"message"=>"successfuly.","data"=>$data];
    };
    function createImage($image,$pid){
        global $conn;
        $sql = 'INSERT INTO image(image,pid) VALUES(?,?)';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('ss',$image,$pid);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        $data = $stmt->get_result();
        return ["status"=>200,"message"=>"successfuly.","data"=>$data];
    };
?>