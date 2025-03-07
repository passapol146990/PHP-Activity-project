<?php
require_once("../includes/models/accout.php");
require_once("../includes/models/post.php");
require_once("../includes/models/register.php");
class ACTIVITY{
    function PageShow(){
        isLogin();
        $login_token = $_SESSION["login_token"];
        $total_registers = getCountWaitRegister($login_token);
        $waitReg = getWaitRegister($login_token);

        $keyword = $_GET['search'] ?? "";
        $date_start = $_GET['start_date'] ?? "";
        $date_end = $_GET['end_date'] ?? "";
        $page = $_GET['page'] ?? 1;
        
        $data = getPostUserCreateX($login_token, 10, $page, $keyword, $date_start, $date_end); 
        if($data["status"]!=200){
            $data["data"] = [];
        }

        require_once('../app/views/activity/show.php');
        exit();
    }
    function PageCreate(){
        isLogin();
        $login_token = $_SESSION["login_token"];
        $total_registers = getCountWaitRegister($login_token);
        $waitReg = getWaitRegister($login_token);
        require_once('../app/views/activity/create.php');
        exit();
    }
    function PageUpdate(){
        isLogin();
        if (!isset($_GET["pid"]) || empty($_GET["pid"])) {
            header("location:/");
            exit();
        }
        $p_id = $_GET["pid"];
        $p_aid = $_SESSION["login_token"];
        $data = getPosttoedit($p_id, $p_aid);
        if ($data["status"] != 200) {
            header("Location: /");
            exit();
        }
        $result = $data['data'];
        require_once('../app/views/activity/edit.php');
        exit();
    }
    function Delete(){
        isLogin();
        $login_token = $_SESSION["login_token"];
        $total_registers = getCountWaitRegister($login_token);
        $waitReg = getWaitRegister($login_token);
        $pid = $_GET["pid"];
        deletePostByIdPostAndIdUser($pid, $login_token);
        header("location:/activity/create/show?status=success&message=ลบกิจกรรมสำเร็จ");
        exit();
    }
    function create(){
        isLogin();
        if (!isset($_POST["title"]) || empty($_POST["title"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่ชื่อกิจกรรม.");
            exit();
        }
        if (!isset($_POST["description"]) || empty($_POST["description"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่รายละเอียดกิจกรรม.");
            exit();
        }
        if (!isset($_POST["max_count"]) || empty($_POST["max_count"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่จำนวนคนที่รับ.");
            exit();
        }
        if ($_POST["max_count"] > 1000) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่จำนวนคนไม่เกิน 1000.");
            exit();
        }
        if (!isset($_POST["start_date"]) || empty($_POST["start_date"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่วันที่เริ่มกิจกรรม.");
            exit();
        }
        if (!isset($_POST["end_date"]) || empty($_POST["end_date"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่วันที่สิ้นสุดกิจกรรม.");
            exit();
        }
        if (!isset($_POST["location"]) || empty($_POST["location"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่สถานที่จัดกิจกรรม.");
            exit();
        }
        if (!isset($_POST["p_give"]) || empty($_POST["p_give"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่ของรางวัล.");
            exit();
        }
        if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
            header("Location:/activity/create?vmessage=กรุณาใส่รูปภาพ.");
            exit();
        }
        if (count($_FILES['images']['tmp_name']) > 10) {
            header("Location:/activity/create?status=warning&message=อัปโหลดได้สูงสุด 10 รูป.");
            exit();
        }

        try {
            $aid = $_SESSION["login_token"];
            $title = $_POST["title"];
            $pid = hash('sha256', $aid . uniqid() . $title);
            $description = $_POST["description"];
            $max_count = $_POST["max_count"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $location = $_POST["location"];
            $p_give = $_POST["p_give"] ?? ""; 
            $p_status = "open";
            
            createPost($pid, $aid, $title, $description, $max_count, $location, $start_date, $end_date, $p_give, $p_status);

            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['images']['error'][$key] === 0) {
                    $name = date('Ymd') . $_SESSION["login_token"] . '_' . uniqid() . '.png';
                    $fileName = $_FILES['images']['name'][$key];
                    $fileSize = $_FILES['images']['size'][$key];
                    $fileTmp = $_FILES['images']['tmp_name'][$key];
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $allowedExtensions = ['jpg', 'png'];

                    if (in_array($fileExt, $allowedExtensions)) {
                        if ($fileSize < 2000000) {
                            if ($fileExt === 'jpg' || $fileExt === 'jpeg') {
                                $image = imagecreatefromjpeg($fileTmp);
                            } elseif ($fileExt === 'png') {
                                $image = imagecreatefrompng($fileTmp);
                            }
                            if ($image) {
                                $width = imagesx($image);
                                $height = imagesy($image);
                                $newWidth = intval($width * 0.5);
                                $newHeight = intval($height * 0.5);
                                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                                imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                                $destination = '../image/post/' . $name;
                                if ($fileExt === 'png') {
                                    imagepng($newImage, $destination);
                                } else {
                                    imagejpeg($newImage, $destination, 50);
                                }
                                imagedestroy($image);
                                imagedestroy($newImage);
                                createImage($name, $pid);
                            }
                        }
                    }
                }
            }
        } catch (Exception $err) {
            error_log($err->getMessage());
            header("Location:/?status=error&message=เกิดปัญหาไม่สามารถสร้างกิจกรรมได้");
            exit();
        }
       header("Location:/?status=success&message=สร้างกิจกรรมสำเร็จ");
        exit();
        
    }
    function update(){
        isLogin();
        if (!isset($_POST["title"]) || empty($_POST["title"])) {
            header("Location:/activity/edit?status=warnign&message=กรุณาใส่ชื่อกิจกรรม.");
            exit();
        }
        if (!isset($_POST["description"]) || empty($_POST["description"])) {
            header("Location:/activity/edit?status=warnign&message=กรุณาใส่รายละเอียดกิจกรรม.");
            exit();
        }
        if (!isset($_POST["max_count"]) || empty($_POST["max_count"])) {
            header("Location:/activity/edit?status=warnign&message=กรุณาใส่จำนวนคนที่รับ.");
            exit();
        }
        if (!isset($_POST["start_date"]) || empty($_POST["start_date"])) {
            header("Location:/activity/edit?status=warnign&message=กรุณาใส่วันที่เริ่มกิจกรรม.");
            exit();
        }
        if (!isset($_POST["end_date"]) || empty($_POST["end_date"])) {
            header("Location:/activity/edit?status=warnign&message=กรุณาใส่วันที่สิ้นสุดกิจกรรม.");
            exit();
        }
        if (!isset($_POST["location"]) || empty($_POST["location"])) {
            header("Location:/activity/edit?status=warnign&message=กรุณาใส่สถานที่จัดกิจกรรม.");
            exit();
        }
        if (!isset($_POST["p_give"]) || empty($_POST["p_give"])) {
            header("Location:/activity/edit?status=warnign&message=กรุณาใส่สถานที่จัดกิจกรรม.");
            exit();
        }
        
        $aid = $_SESSION["login_token"];
        $p_id = $_POST["p_id"] ?? "";
        $title = $_POST["title"];
        $description = $_POST["description"];
        $max_count = (int)$_POST["max_count"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $location = $_POST["location"];
        $p_give = $_POST["p_give"];
        $action = $_POST["action_type"] ?? "";
        $p_status = $_POST["p_status"] ?? "";
        
        $data = updatePost($p_id, $aid, $title, $description, $max_count, $location, $start_date, $end_date, $p_give, $action);
       
        header("location:/activity/create/show?status=success&message=อัพเดทกิจกรรมสำเร็จ");
        exit();
    }

    function userSubmitpic() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['pid'])) {
                $pid = $_POST['pid'];
            }else{
                echo("null pid");
            }
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $name = date('Ymd') . $_SESSION["login_token"] . '_' . uniqid() . '.png';
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
                $fileSize = $_FILES['image']['size'];
                $fileType = $_FILES['image']['type'];
                
                $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'png'];

                if (in_array($fileExt, $allowedExtensions)) {
                    if ($fileSize < 2000000) {
                        if ($fileExt === 'jpg' || $fileExt === 'jpeg') {
                            $image = imagecreatefromjpeg($fileTmpPath);
                        } elseif ($fileExt === 'png') {
                            $image = imagecreatefrompng($fileTmpPath);
                        }
                        if ($image) {
                            $width = imagesx($image);
                            $height = imagesy($image);
                            $newWidth = intval($width * 0.5);
                            $newHeight = intval($height * 0.5);
                            $newImage = imagecreatetruecolor($newWidth, $newHeight);
                            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                            $destination = '../image/submit/' . $name;
                            if ($fileExt === 'png') {
                                imagepng($newImage, $destination);
                            } else {
                                imagejpeg($newImage, $destination, 50);
                            }
                            imagedestroy($image);
                            imagedestroy($newImage);
                            createImage($name, $pid);
                        }
                    }
                }
                
            }else{
                echo("ไม่มีไฟล์ส่งมา");
            }
        }else {
            echo("ส่งไม่ถูก");
        }

        header("location:/activity/create/show?status=success&message=ส่งรูปภาพสำเร็จ");
        exit();
        }
    }

    $Activity = new Activity();
?>