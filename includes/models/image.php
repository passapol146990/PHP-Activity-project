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
    function saveGoogleProfileImage($google_image_url, $user_id) {
        if (filter_var($google_image_url, FILTER_VALIDATE_URL) === false) {
            return false;
        }
        $upload_dir = '../image/user/';
        $filename = $user_id . '_' . time() . '.jpg';
        $file_path = $upload_dir . $filename;
        $image_data = @file_get_contents($google_image_url);
        if ($image_data === false) {
            return false;
        }
        if (file_put_contents($file_path, $image_data)) {
            return $filename;
        }
        return false;
    }
    function deleteImage($filename) {
        $filename = basename(filename);
        $file = "../image/$filename";
        if (file_exists($file)) {
            unlink($file);
        }
    }
    
?>