<?php
    require_once '../includes/db.php';
    
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
        $data = $getaccount["data"]->fetch_assoc();
        if($getaccount['status']!=200){
            header('location:/login?message='.$getaccount["message"]);
            exit();
        }
        if($getaccount['data']->num_rows === 0){
            $create = createAccount($id,$fname,$lname,$gmail,$image);
            if($getaccount['status']!=200){
                header('location:/login?message='.$getaccount["message"]);
                exit();
            }
        }
        $_SESSION['login_token'] = $id;
        $_SESSION['login_image'] = $image;
        $_SESSION['login_name'] = $data["fname"]??""." ".$data["lname"]??"";
        $_SESSION['login_time'] = time();
    }
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
    }
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
    }
    function setName($fname,$lname,$id){
        global $conn;
        $sql = 'UPDATE account SET fname = ? , lname = ? WHERE aid = ?';
        $stmt = $conn->prepare($sql);
        if(!$stmt){return ["status"=>400,"message"=>"prepare error!"];}
        $stmt->bind_param('sss', $fname,$fname,$id);
        if(!$stmt->execute()){return ["status"=>400,"message"=>"execute error!"];}
        if ($stmt->affected_rows > 0) {
            return ["status" => 200, "message" => "Successfully updated."];
        } else {
            return ["status" => 204, "message" => "No changes made."];
        }
    }


    function addaccout($sid,$username, $password, $fname, $lname, $birthday, $phone) {
        global $conn;

        $sql = 'INSERT INTO user (sid, username,password, fname, lname, birthday, phone) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssss', $sid,$username, $password, $fname, $lname, $birthday,$phone);
        $stmt->execute();
    }
    // addaccout(password_hash("a01"."123456",PASSWORD_DEFAULT),"a01",password_hash("123456",PASSWORD_DEFAULT),"พัสพล","สุทาธรรม","12/2/2568","0929029712");
?>