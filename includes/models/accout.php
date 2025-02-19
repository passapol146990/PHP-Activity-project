<?php
    require_once '../includes/db.php';

    function login($username, $password) {
        global $conn;

        $username = isset($_POST["username"]) ? $_POST["username"] : '';
        $password = isset($_POST["password"]) ? $_POST["password"] : '';
        $isLogin = false;
        $message = "";

        if (empty($username) || empty($password)) {
            $message = "กรุณากรอก username และ password";
            return ["status"=>400,"message"=>$message];
        } else {
            $sql = 'SELECT sid, username, password FROM user WHERE username = ?';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $isLogin = true;
                    $_SESSION['login'] = $row['sid'];
                    $_SESSION['login_time'] = time();
                    $message = "login success";
                    return ["status"=>200,"message"=>$message];
                } else {
                    $message = "username or password ไม่ถูกต้อง.";
                    return ["status"=>400,"message"=>$message];
                }
            } else {
                $message = "username or password ไม่ถูกต้อง.";
                return ["status"=>400,"message"=>$message];
            }
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