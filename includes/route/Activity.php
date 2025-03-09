<?php
require_once("../includes/models/accout.php");
require_once("../includes/models/post.php");
require_once("../includes/models/register.php");
class ACTIVITY
{
    function PageShow()
    {
        isLogin();
        $login_token = $_SESSION["login_token"];
        $total_registers = getCountWaitRegister($login_token);
        $waitReg = getWaitRegister($login_token);

        $keyword = $_GET['search'] ?? "";
        $date_start = $_GET['start_date'] ?? "";
        $date_end = $_GET['end_date'] ?? "";
        $page = $_GET['page'] ?? 1;

        $data = getPostUserCreateX($login_token, 10, $page, $keyword, $date_start, $date_end);
        if ($data["status"] != 200) {
            $data["data"] = [];
        }

        require_once('../app/views/activity/show.php');
        exit();
    }
    function PageCreate()
    {
        isLogin();
        $login_token = $_SESSION["login_token"];
        $total_registers = getCountWaitRegister($login_token);
        $waitReg = getWaitRegister($login_token);
        require_once('../app/views/activity/create.php');
        exit();
    }
    function PageUpdate()
    {
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
    function Delete()
    {
        isLogin();
        $login_token = $_SESSION["login_token"];
        $pid = $_GET["pid"];
        deletePostByIdPostAndIdUser($pid, $login_token);
        header("location:/activity/create/show?status=success&message=ลบกิจกรรมสำเร็จ");
        exit();
    }
    function create()
    {
        isLogin();
        if (!isset($_POST["title"]) || empty($_POST["title"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่ชื่อกิจกรรม.");
            exit();
        }
        if (mb_strlen($_POST["title"],"UTF-8") > 50) {
            header("Location:/activity/create?status=warning&message=ชื่อกิจกรรมต้องไม่เกิน 50 ตัวอักษร.");
            exit();
        }
        if (!isset($_POST["description"]) || empty($_POST["description"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่รายละเอียดกิจกรรม.");
            exit();
        }
        if (mb_strlen($_POST["description"],"UTF-8") > 2000) {
            header("Location:/activity/create?status=warning&message=รายละเอียดกิจกรรม 2000 ตัวอักษร.");
            exit();
        }
        if (!isset($_POST["location"]) || empty($_POST["location"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่สถานที่จัดกิจกรรม.");
            exit();
        }
        if (mb_strlen($_POST["location"],"UTF-8") > 500) {
            header("Location:/activity/create?status=warning&message=สถานที่ต้องน้อยกวา 500 ตัวอักษร.");
            exit();
        }
        if (!isset($_POST["p_give"]) || empty($_POST["p_give"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่ของรางวัล.");
            exit();
        }
        if (mb_strlen($_POST["p_give"],"UTF-8") > 500) {
            header("Location:/activity/create?status=warning&message=ของรางวัลต้องน้อยกว่า 500 ตัวอักษร.");
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
        if (!isset($_POST["max_count"]) || empty($_POST["max_count"])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่จำนวนคนที่รับ.");
            exit();
        }
        if ($_POST["max_count"] > 100000) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่จำนวนคนไม่เกิน 100000.");
            exit();
        }
        $start_date_chk = strtotime($_POST["start_date"]);
        $end_date_chk = strtotime($_POST["end_date"]);
        if ($start_date_chk > $end_date_chk) {
            header("Location:/activity/create?status=warning&message=วันที่เริ่มกิจกรรมต้องไม่มาหลังวันที่สิ้นสุด.");
            exit();
        }
        if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
            header("Location:/activity/create?status=warning&message=กรุณาใส่รูปภาพ.");
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

            createPost($pid, $aid, $title, $description, $max_count, $location, $start_date, $end_date, $p_give);

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
    function update()
    {
        isLogin();
        if (mb_strlen($_POST["title"],"UTF-8") > 50) {
            header("Location:/activity/create/show?status=warning&message=ชื่อกิจกรรมต้องต้องน้อยกว่า 50 ตัวอักษร.");
            exit();
        }
        if (!isset($_POST["description"]) || empty($_POST["description"])) {
            header("Location:/activity/create/show?status=warning&message=กรุณาใส่รายละเอียดกิจกรรม.");
            exit();
        }
        if (mb_strlen($_POST["description"],"UTF-8") > 2000) {
            header("Location:/activity/create/show?status=warning&message=รายละเอียดกิจกรรมต้องน้อยกว่า 2000 ตัวอักษร.");
            exit();
        }
        if (!isset($_POST["location"]) || empty($_POST["location"])) {
            header("location:/activity/create/show?status=warnign&message=กรุณาใส่สถานที่จัดกิจกรรม.");
            exit();
        }
        if (mb_strlen($_POST["location"],"UTF-8") > 500) {
            header("Location:/activity/create/show?status=warning&message=สถานที่จัดกิจกรรมต้องน้อยกว่า 500 ตัวอักษร.");
            exit();
        }
        if (!isset($_POST["p_give"]) || empty($_POST["p_give"])) {
            header("location:/activity/create/show?status=warnign&message=กรุณาใส่สิ่งที่จะได้รับ.");
            exit();
        }
        if (mb_strlen($_POST["p_give"],"UTF-8") > 500) {
            header("Location:/activity/create/show?status=warning&message=สิ่งที่จะได้รับต้องน้อยกว่า 500 ตัวอักษร.");
            exit();
        }
        if (!isset($_POST["max_count"]) || empty($_POST["max_count"])) {
            header("location:/activity/create/show?status=warnign&message=กรุณาใส่จำนวนคนที่รับ.");
            exit();
        }
        $p_id = $_POST["p_id"] ?? "";
        $ApproveRegister = getCountNumberApproveRegisterFromPost($p_id);
        if ((int)$_POST["max_count"] < (int)$ApproveRegister) {
            header("location:/activity/create/show?status=warnign&message=กรุณาใส่จำนวนคนมากกว่าที่อนุมัติ.");
            exit();
        }
        if (!isset($_POST["start_date"]) || empty($_POST["start_date"])) {
            header("location:/activity/create/show?status=warnign&message=กรุณาใส่วันที่เริ่มกิจกรรม.");
            exit();
        }
        if (!isset($_POST["end_date"]) || empty($_POST["end_date"])) {
            header("location:/activity/create/show?status=warnign&message=กรุณาใส่วันที่สิ้นสุดกิจกรรม.");
            exit();
        }
        $start_date_chk = strtotime($_POST["start_date"]);
        $end_date_chk = strtotime($_POST["end_date"]);
        if ($start_date_chk > $end_date_chk) {
            header("Location:/activity/create/show?status=warning&message=วันที่เริ่มกิจกรรมต้องไม่มาหลังวันที่สิ้นสุด.");
            exit();
        }

        $aid = $_SESSION["login_token"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $max_count = (int)$_POST["max_count"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $location = $_POST["location"];
        $p_give = $_POST["p_give"];
        if (isset($_FILES['images']) || !empty($_FILES['images']['name'][0])) {
            $Countimage = getCountImageByIdpostAndIduser($p_id, $aid);
            if (count($_FILES['images']['tmp_name']) + $Countimage["count"] > 10) {
                header("location:/activity/create/show?status=warning&message=อัปโหลดได้สูงสุด 10 รูป.");
                exit();
            }
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
                                createImage($name, $p_id);
                            }
                        }
                    }
                }
            }
        }
        updatePost($p_id, $aid, $title, $description, $max_count, $location, $start_date, $end_date, $p_give);
        header("location:/activity/create/show?status=success&message=อัพเดทกิจกรรมสำเร็จ");
        exit();
    }
    function userSubmitpic()
    {
        isLogin();
        if (!isset($_POST['pid']) || empty($_POST["pid"])) {
            header("location:/activity/register/show?status=warning&message=pid is null");
            exit();
        }
        if ((!isset($_FILES['image']))) {
            header("location:/activity/register/show?status=warning&message=กรุณาใส่รูปภาพ3.");
            exit();
        }
        $pid = $_POST['pid'];
        $name = date('Ymd') . $_SESSION["login_token"] . '_' . uniqid() . '.png';
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $aid = $_SESSION["login_token"];

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
                    submitRegister($name, $pid, $aid);
                }
            }
        }
        header("location:/activity/register/show?status=success&message=ส่งรูปภาพสำเร็จ");
        exit();
    }
}
$Activity = new Activity();
