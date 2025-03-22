<?php
    require_once '../includes/db.php';
    require_once 'image.php';
    
    function getAccountID($id){
        global $conn;
        $sql = 'SELECT * FROM account WHERE aid = ?';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('s',$id);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        $data = $stmt->get_result();
        return ["status"=>200,"message"=>"successfuly.","data"=>$data];
    };
    function createAccount($id,$fname,$lname,$gmail,$image){
        global $conn;
        $sql = 'INSERT INTO account(aid,fname,lname,gmail,image) VALUES(?,?,?,?,?)';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('sssss',$id,$fname,$lname,$gmail,$image);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        $data = $stmt->get_result();
        return ["status"=>200,"message"=>"successfuly.","data"=>$data];
    };
    function login($id,$fname,$lname,$gmail,$image) {
        $getaccount = getAccountID($id);
        if($getaccount['status']!=200){
            header('location:/login?message='.$getaccount["message"]);
            exit();
        }
        if($getaccount['data']->num_rows === 0){
            $image = saveGoogleProfileImage($image, $id);
            $create = createAccount($id,$fname,$lname,$gmail,$image);
            if($getaccount['status']!=200){
                header('location:/login?message='.$getaccount["message"]);
                exit();
            }
        }
        $getaccount = getAccountID($id);
        $data = $getaccount["data"]->fetch_assoc();
        $_SESSION['login_token'] = $id;
        $_SESSION['login_image'] = $data["image"];
        $_SESSION['login_name'] = ($data["fname"] ?? "") . " " . ($data["lname"] ?? "");
        $_SESSION['login_time'] = time();
    };
    function setBirthday($date,$id){
        global $conn;
        $sql = 'UPDATE account SET birthday = ? WHERE aid = ?';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('ss', $date, $id);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        if ($stmt->affected_rows > 0) {
            return ["status" => 200, "message" => "Successfully updated."];
        } else {
            return ["status" => 204, "message" => "No changes made."];
        }
    };
    function setGender($gender,$id){
        global $conn;
        $sql = 'UPDATE account SET gender = ? WHERE aid = ?';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('ss', $gender, $id);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        if ($stmt->affected_rows > 0) {
            return ["status" => 200, "message" => "Successfully updated."];
        } else {
            return ["status" => 204, "message" => "No changes made."];
        }
    };
    function setName($fname,$lname,$id){
        global $conn;
        $sql = 'UPDATE account SET fname = ? , lname = ? WHERE aid = ?';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('sss', $fname,$lname,$id);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        if ($stmt->affected_rows > 0) {
            return ["status" => 200, "message" => "Successfully updated."];
        } else {
            return ["status" => 204, "message" => "No changes made."];
        }
    };
    function getUserByIdPostAndIdUser($aid,$pid,$uid){
        global $conn;
        $sql = 'SELECT account.*
                FROM account
                JOIN register ON register.aid = account.aid
                JOIN post ON post.p_id = register.pid
                WHERE post.p_aid = ?
                AND post.p_id = ?
                AND account.aid = ?;
        ';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('sss',$aid,$pid,$uid);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        $data = $stmt->get_result();
        if($data->num_rows === 0){return ["status"=>201,"message"=>"ไม่พบข้อมูล"];}
        $data = $data->fetch_all(MYSQLI_ASSOC);
        return ["status"=>200,"message"=>"successfuly.","data"=>$data];

    };
    function addStatusColumnIfNotExists() {
        global $conn;
        $checkColumnQuery = "SHOW COLUMNS FROM `account` LIKE 'status'";
        $result = $conn->query($checkColumnQuery);
    
        if ($result->num_rows == 0) {
            $alterTableQuery = "ALTER TABLE `account` 
                                ADD COLUMN `status` ENUM('active', 'banned') 
                                COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active'";
             if ($conn->query($alterTableQuery) === TRUE) {
                return ["status" => 200, "message" => "เพิ่มคอลัมน์ status สำเร็จ!"];
            } else {
                return ["status" => 500, "message" => "เกิดข้อผิดพลาดในการเพิ่มคอลัมน์: " . $conn->error];
            }
        }
    }
    
?>