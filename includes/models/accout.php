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
    function loginNormal($gmail, $password) {
        global $conn;
        $sql = "SELECT aid, password, fname, lname, image FROM account WHERE gmail = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            header('Location: /login?message=Error preparing database query');
            exit();
        }
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['login_token'] = $user['aid'];
                $_SESSION['login_image'] = $user['image'];
                $_SESSION['login_name'] = $user['fname'] . " " . $user['lname'];
                $_SESSION['login_time'] = time();
                header('Location: /dashboard');
                exit();
            } else {
                header('Location: /login?message=Invalid password');
                exit();
            }
        } else {
            header('Location: /login?message=Invalid email');
            exit();
        }
    }
    // loginNormal("user1@a.com", "123456");

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
    function createAccountnormal($fname, $lname, $gmail, $password) {
        global $conn;
        $id = hash('sha256', $gmail);
        $Hashpassword = password_hash($password, PASSWORD_DEFAULT);
        $filename = '3ab60813c9df1727e210dc7f58320390ef9f73c8ff9014fd8ee0660fa3e455d4_1742221251.jpg';
        $birthday = "2005-03-06"; // เก็บค่าวันเกิดไว้ในตัวแปร
        $sql = 'INSERT INTO account(aid, fname, lname, gmail, image, password, birthday) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            return ["status" => 400, "message" => "prepare error!"];
        }
        $stmt->bind_param('sssssss', $id, $fname, $lname, $gmail, $filename, $Hashpassword, $birthday);
        if (!$stmt->execute()) {
            return ["status" => 400, "message" => "execute error!"];
        }
        $data = $stmt->get_result(); 
        return ["status" => 200, "message" => "successfully created account.", "data" => $data];
    }
    
    // createAccountnormal('A','B',"user1@a.com","123456");
    // createAccountnormal('C','C',"user2@a.com","123456");
    // createAccountnormal('D','D',"user3@a.com","123456");
    // createAccountnormal('E','E',"user4@a.com","123456");
    // createAccountnormal('F','F',"user5@a.com","123456");
    // createAccountnormal('G','G',"user6@a.com","123456");
    // createAccountnormal('H','H',"user7@a.com","123456");
    // createAccountnormal('I','I',"user8@a.com","123456");
    // createAccountnormal('J','J',"user9@a.com","123456");
    // createAccountnormal('P','P',"user10@a.com","123456");
?>