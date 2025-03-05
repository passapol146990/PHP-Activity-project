<?php
require_once("../includes/models/register.php");
class REGISTER{
    function Show(){
        isLogin();
        $login_token = $_SESSION["login_token"];
        $page = $_GET['page'] ?? 1;
        $total_registers = getCountWaitRegister($login_token);
        $waitReg = getWaitRegister($login_token);
        $myactivities = getRegisteredActivities($login_token, 10, $page);
        require_once('../app/views/register/show.php');
        exit();
    }
    function cancelRegister(){
        isLogin();
        if (!isset($_GET["rid"]) || empty($_GET["rid"])) {
            echo json_encode(["status" => 400, "message" => "Register ID is required"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        if (!isset($_GET["pid"]) || empty($_GET["pid"])) {
            echo json_encode(["status" => 400, "message" => "Post ID is required"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $rid = $_GET["rid"];
        $pid = $_GET["pid"];
        $login_token = $_SESSION["login_token"];
        $result = DeleteRegister($rid, $pid, $login_token);
        header("location:/activity/register/show?status=success&message=ยกเลิกคำขอเข้าร่วมสำเร็จ");
        exit();
    }
    function get(){
        isLogin();
        if (!isset($_POST["id_post"]) || empty(isset($_POST["id_post"]))) {
            echo json_encode(["status" => 400, "message" => "id post is null!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $page = $_POST['page'] ?? 1;
        $id_post = $_POST["id_post"];
        $id_user = $_SESSION["login_token"];
        $data = getRegisterByIdPostAndIdUser($id_post, $id_user, 100, $page);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }
    function update(){
        isLogin();
        if (!isset($_POST["pid"]) || empty(isset($_POST["pid"]))) {
            echo json_encode(["status" => 400, "message" => "pid is null!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        if (!isset($_POST["uid"]) || empty(isset($_POST["uid"]))) {
            echo json_encode(["status" => 400, "message" => "uid is null!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        if (!isset($_POST["status"]) || empty(isset($_POST["status"]))) {
            echo json_encode(["status" => 400, "message" => "status is null!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $pid = $_POST["pid"];
        $pstatus = $_POST["status"];
        $aid = $_SESSION["login_token"];
        $uid = $_POST["uid"];
        $status = "รอการตรวจสอบ";
        if ($pstatus == 1) {
            $status = "อนุมัติ";
        } else {
            $status = "ปฏิเสธ";
        }
        $data = upadteResgister($pid, $aid, $uid, $status);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
$Register = new REGISTER();
?>