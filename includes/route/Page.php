<?php
require_once("../includes/models/accout.php");
require_once("../includes/models/post.php");
require_once("../includes/models/register.php");
class PAGE{
    function home(){
        isLogin();
        $login_token = $_SESSION["login_token"];
        $page = $_GET['page'] ?? 1;
        $postsTop = getPost(10, 1);
        $keyword = $_GET['search'] ?? "";
        $date_start = $_GET['start_date'] ?? "";
        $date_end = $_GET['end_date'] ?? "";
        $total_registers = getCountWaitRegister($login_token);
        $waitReg = getWaitRegister($login_token);
        $posts = getPostx($login_token,10, $page, $keyword, $date_start, $date_end,);
        require_once('../app/views/home.php');
        exit();
    }
    function login(){
        if (isset($_SESSION["login_token"])) {
            header("Location:/");
            exit();
        }
        require_once('../app/views/login.php');
        exit();
    }
    
    function logout(){
        session_unset();
        session_destroy();
        header("Location:/login");
        exit();
    }
    function setting(){
        isLogin();
        $login_token = $_SESSION["login_token"];
        $total_registers = getCountWaitRegister($login_token);
        $waitReg = getWaitRegister($login_token);
        $getaccount = getAccountID($login_token);
        $account = $getaccount['data']->fetch_assoc();
        require_once('../app/views/user/setting.php');
        exit();
    }
    function dashboard(){
        isLogin();
        $login_token = $_SESSION["login_token"];
        $getTop10 = getTop10register($login_token);
        $getReqMonth = getRegisterByMonth($login_token);
        $total_Countstatus_1 = getCountStatus_1($login_token);
        $total_Countstatus_2 = getCountStatus_2($login_token);
        require_once('../app/views/dashboard/page.php');
        exit();
    }
    function privacyPolicy(){
        require_once('../app/views/user/privacyPolicy.html');
        exit();
    }
}
$Page = new PAGE();
?>