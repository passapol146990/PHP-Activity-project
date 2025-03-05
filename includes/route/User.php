<?php
require_once("../includes/models/accout.php");
class USER{
    function update(){
        if(!isset($_SESSION['login_time'])){
            echo json_encode(["status"=>440,"message"=>"ไม่พบเซสชั่นกรุณาเข้าสู่ระบบด้วยวิธีปกติด้วยครับ"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $inactive = time() - $_SESSION['login_time'];
        if ($inactive > 600) {
            echo json_encode(["status"=>440,"message"=>"เซสชั่นหมดอายุกรุณาเข้าสู่ระบบใหม่"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $login_token = $_SESSION["login_token"];
        if(!isset($login_token) || empty($login_token)){
            session_destroy();
            echo json_encode(["status"=>440,"message"=>"ไม่พบเซสชั่นกรุณาเข้าสู่ระบบด้วยวิธีปกติด้วยครับ"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        if(!isset($_POST['fname']) || empty($_POST['fname'])){
            echo json_encode(["status"=>400,"message"=>"กรุณาระบุชื่อจริงด้วย"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        if(!isset($_POST['lname']) || empty($_POST['lname'])){
            echo json_encode(["status"=>400,"message"=>"กรุณาระบุนามสกุล"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        if(!isset($_POST['birthday']) || empty($_POST['birthday'])){
            echo json_encode(["status"=>400,"message"=>"กรุณาระบุวันเดือนปีเกิดของท่าน"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        if(!isset($_POST['gender']) || empty($_POST['gender'])){
            echo json_encode(["status"=>400,"message"=>"กรุณาระบุเพศของท่าน"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $birthday = $_POST["birthday"];
        $birthDate = DateTime::createFromFormat('Y-m-d', $birthday);
        if (!$birthDate || $birthDate->format('Y-m-d') !== $birthday) {
            echo json_encode(["status"=>400,"message"=>"รูปแบบวันเกิดไม่ถูกต้อง"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $today = new DateTime();
        $age = $today->diff($birthDate)->y;

        if ($age < 12) {
            echo json_encode(["status"=>400,"message"=>"อายุของท่าต้องมากว่า 12 ปีถึงจะสามารถเข้าใช้งานระบบได้"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $id = $_SESSION["login_token"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $birthday = $_POST["birthday"];
        $gender = $_POST["gender"] ?? "ไม่ระบุเพศ";
        if($gender!="ชาย"||$gender!="หญิง"||$gender!="ไม่ระบุเพศ"){
            $gender = "ไม่ระบุเพศ";
        }
        setName($fname, $lname, $id);
        setBirthday($birthday, $id);
        setGender($gender, $id);
        echo json_encode(["status"=>200,"message"=>"อัพเดทข้อมูลของท่าสำเร็จ"], JSON_UNESCAPED_UNICODE);
        exit();
    }
    function get(){
        isLogin();
        if (!isset($_POST["pid"]) || empty(isset($_POST["pid"]))) {
            echo json_encode(["status" => 400, "message" => "id post is null!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        if (!isset($_POST["uid"]) || empty(isset($_POST["uid"]))) {
            echo json_encode(["status" => 400, "message" => "id user is null!"], JSON_UNESCAPED_UNICODE);
            exit();
        }
        $pid = $_POST["pid"];
        $uid = $_POST["uid"];
        $aid = $_SESSION["login_token"];
        $data = getUserByIdPostAndIdUser($aid, $pid, $uid);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
$User = new USER();
?>