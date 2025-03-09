<?php
require_once("../includes/models/register.php");
require_once("../includes/models/post.php");
class REGISTER
{
    function Show()
    {
        isLogin();
        $keyword = $_GET['search'] ?? "";
        $date_start = $_GET['start_date'] ?? "";
        $date_end = $_GET['end_date'] ?? "";
        $page = $_GET['page'] ?? 1;

        $login_token = $_SESSION["login_token"];
        $page = $_GET['page'] ?? 1;
        $total_registers = getCountWaitRegister($login_token);
        $waitReg = getWaitRegister($login_token);

        // $myactivities = getRegisteredActivities($login_token, 10, $page);
        $myactivities = getRegisteredActivities($login_token, 10, $page, $keyword, $date_start, $date_end);
        require_once('../app/views/register/show.php');
        exit();
    }
    function cancelRegister()
    {
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
    function get()
    {
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
    function update()
    {
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
            $count = getCounApproveRegister($pid);
            if(!$count){
                echo json_encode(["status" => 400, "message" => "จำนวนคนที่อนุมัติเต็มแล้ว กรุณาขยายจำนวนคนเพิ่มก่อน"], JSON_UNESCAPED_UNICODE);
                exit();
            }
        } else {
            $status = "ปฏิเสธ";
        }
        $data = upadteResgister($pid, $aid, $uid, $status);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }
    function updateStatusSubmit()
    {
        isLogin();
        if (!isset($_POST["pid"]) || empty($_POST["pid"])) {
            echo json_encode(["status" => 400, "message" => "pid is null!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        if(!isset($_POST["uid"])||empty($_POST["uid"])){
            echo json_encode(["status" => 400, "message" => "uid is null!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        if (!isset($_POST["status"]) || empty($_POST["status"])) {
            echo json_encode(["status" => 400, "message" => "status is null!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $login_token = $_SESSION["login_token"];
        $pid = $_POST["pid"];
        $uid = $_POST["uid"];
        $status = ($_POST["status"]==1)?"ผ่านกิจกรรม":"ไม่ผ่านกิจกรรม";
        $res = updateRegisterStatusSubmit($pid,$uid,$login_token,$status);
        echo json_encode($res , JSON_UNESCAPED_UNICODE);
        exit();
    }
    function getsubmitRegister()
    {
        isLogin();
        if (!isset($_POST["pid"]) || empty($_POST["pid"])) {
            echo json_encode(["status" => 400, "message" => "pid is null!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $login_token = $_SESSION['login_token'];
        $pid = $_POST['pid'];

        $result = getSubpicBy_Creater($login_token, $pid);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
$Register = new REGISTER();
