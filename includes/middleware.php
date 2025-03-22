<?php
function isLogin(){
    if(!isset($_SESSION["login_time"]) || !isset($_SESSION["login_token"])){
        header('Location:/logout');
        exit();
    }
    $inactive = time() - $_SESSION['login_time'];
    if ($inactive > 6000) {
        header('Location:/logout');
        exit();
    }
    $login_token = $_SESSION["login_token"];
    $login_image = $_SESSION["login_image"];
    $login_name = $_SESSION["login_name"];
    if (!isset($login_token) || empty($login_token) || !isset($login_image) || empty($login_image) || !isset($login_name) || empty($login_name)) {
        header("Location:/logout");
        exit();
    }
    $getaccount = getAccountID($login_token);
    if ($getaccount["data"]->num_rows == 0) {
        header('Location:/logout');
        exit();
    }
    $row = $getaccount["data"]->fetch_assoc();
    if (!array_key_exists("status", $row)) {
        addStatusColumnIfNotExists();
        header('Location: /logout');
        exit();
    }
    if ($getaccount["status"] == 200) {
        $account_status = $row["status"];
        if ($account_status == "banned") {
            require_once('../app/views/user/banned.html');
            exit();
        }
    } else {
        header('Location:/logout');
        exit();
    }

    if (empty( $row['birthday']) || empty( $row['gender'])) {
        require_once('../app/views/user/update.php');
        exit();
    }
};
?>