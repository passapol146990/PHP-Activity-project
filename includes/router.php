<?php
require_once("models/accout.php");
require_once("models/post.php");
require_once("models/image.php");
require_once("models/register.php");
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($request, PHP_URL_PATH);

function isLogin(){
    if (isset($_SESSION['login_time'])) {
        $inactive = time() - $_SESSION['login_time'];
        if ($inactive > 6000) {
            header('Location:/logout');
            exit();
        }
        $login_token = $_SESSION["login_token"];
        $login_image = $_SESSION["login_image"];
        $login_name = $_SESSION["login_name"];
        if (!isset($login_token) || empty($login_token) || !isset($login_image) || empty($login_image) || !isset($login_name) || empty($login_name)) {
            session_destroy();
            header("Location:/logout");
            exit();
        }
        $getaccount = getAccountID($login_token);
        if ($getaccount["data"]->num_rows == 0) {
            header('Location:/logout');
            exit();
        }
        $account = $getaccount['data']->fetch_assoc();
        if (empty($account['birthday']) || empty($account['gender'])) {
            require_once('../app/views/user/update.php');
            exit();
        }
    } else {
        header('Location:/logout');
        exit();
    }
};

if ($method == "GET") {
    switch ($path) {
        case '/auth/google/callback':
            $code = $_GET['code'] ?? null;
            if (!$code) {
                header("location:/");
                exit();
            }
            $token_url = "https://oauth2.googleapis.com/token";
            $token_data = [
                'client_id' => $google_client_id,
                'client_secret' => $google_client_secret,
                'code' => $code,
                'redirect_uri' => $google_redirect_uri,
                'grant_type' => 'authorization_code'
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $token_url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

            $response = curl_exec($ch);
            curl_close($ch);
            $token_response = json_decode($response, true);
            if (!isset($token_response['access_token'])) {
                header("location:/");
                exit();
            }
            $access_token = $token_response['access_token'];
            $id_token = $token_response['id_token'];
            $profile_url = "https://www.googleapis.com/oauth2/v1/userinfo";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $profile_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $access_token"]);
            $profile_response = curl_exec($ch);
            curl_close($ch);
            $profile = json_decode($profile_response, true);
            $id = hash('sha256', $profile['id']);
            $verified_email = $profile['verified_email'];
            $fname = ($profile["given_name"]) ?? "";
            $lname = ($profile["family_name"]) ?? "";
            $gmail = ($profile["email"]) ?? "";
            $image = ($profile["picture"]) ?? "";
            if ($verified_email != 1) {
                header("location:/");
                exit();
            }
            login($id, $fname, $lname, $gmail, $image);
            header('location:/');
            exit();
            break;
        case '/auth/google':
            $url = "https://accounts.google.com/o/oauth2/v2/auth?client_id={$google_client_id}&redirect_uri={$google_redirect_uri}&response_type=code&scope=profile email";
            header("Location:{$url}");
            break;
        case '/':
            isLogin();
            $login_token = $_SESSION["login_token"];
            $page = $_GET['page'] ?? 1;
            $postsTop = getPost(10, 1); // ห้ามยุ่งบรรทัดนี้
            $keyword = $_GET['search'] ?? "";
            $date_start = $_GET['start_date'] ?? "";
            $date_end = $_GET['end_date'] ?? "";
            $total_registers = getCountWaitRegister($login_token);
            $waitReg = getWaitRegister($login_token);
            $posts = getPostx(10, $page, $keyword, $date_start, $date_end, $login_token);
            require_once('../app/views/home.php');
            exit();

        case '/login':
            if (isset($_SESSION["login_token"])) {
                header("Location:/");
                exit();
            }
            require_once('../app/views/login.php');
            exit();
            break;
        case '/logout':
            session_unset();
            session_destroy();
            header("Location:/login");
            exit();
            break;
        case '/activity/register/show':
            isLogin();
            $login_token = $_SESSION["login_token"];
            $page = $_GET['page'] ?? 1;
            $total_registers = getCountWaitRegister($login_token);
            $waitReg = getWaitRegister($login_token);
            $myactivities = getRegisteredActivities($login_token, 10, $page);
            require_once('../app/views/register/show.php');
            exit();
            break;
        case '/register/cancel':
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
            break;
        case '/activity/edit':
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
            break;
        case '/activity/create':
            isLogin();
            $login_token = $_SESSION["login_token"];
            $total_registers = getCountWaitRegister($login_token);
            $waitReg = getWaitRegister($login_token);
            require_once('../app/views/activity/create.php');
            exit();
            break;
        case '/activity/delete':
            isLogin();
            $login_token = $_SESSION["login_token"];
            $total_registers = getCountWaitRegister($login_token);
            $waitReg = getWaitRegister($login_token);
            $pid = $_GET["pid"];
            deletePostByIdPostAndIdUser($pid, $login_token);
            header("location:/activity/create/show?status=success&message=ลบกิจกรรมสำเร็จ");
            exit();
            break;
        case '/activity/create/show':
            isLogin();
            $login_token = $_SESSION["login_token"];
            $total_registers = getCountWaitRegister($login_token);
            $waitReg = getWaitRegister($login_token);

            $keyword = $_GET['search'] ?? "";
            $date_start = $_GET['start_date'] ?? "";
            $date_end = $_GET['end_date'] ?? "";
            $page = $_GET['page'] ?? 1;
            $posts = getPostx(10, $page,$keyword,$date_start,$date_end);

            if (!empty($posts["data"])) {
                foreach ($posts["data"] as $key => $post) {
                    $posts["data"][$key]["p_date_start_th"] = formatThaiDate($post["p_date_start"]);
                    $posts["data"][$key]["p_date_end_th"] = formatThaiDate($post["p_date_end"]);
                }
            }
            
            $data = getPostUserCreate($login_token,10,$page);
            if($data["status"]!=200){
                $data["data"] = [];
            }

            require_once('../app/views/activity/show.php');
            exit();
            break;
        case '/user/setting':
            isLogin();
            $login_token = $_SESSION["login_token"];
            $total_registers = getCountWaitRegister($login_token);
            $waitReg = getWaitRegister($login_token);
            $getaccount = getAccountID($login_token);
            $account = $getaccount['data']->fetch_assoc();
            require_once('../app/views/user/setting.php');
            exit();
            break;
        case '/get/image':
            $img = $_GET['img'] ?? '';
            $file = "../image/$img";

            if (file_exists($file)) {
                header('Content-Type: image/png');
                header('Cache-Control: max-age=86400, public');
                header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
                header('Content-Length: ' . filesize($file));
                $fp = fopen($file, 'rb');
                fpassthru($fp);
                fclose($fp);
            } else {
                http_response_code(404);
                echo "ไม่พบรูปภาพ";
            }
        default:
            header("Location:/");
            break;
    }
} else if ($method == "POST") {
    switch ($path) {
        case '/activity/create':
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
                $uploadedFiles = []; // image,path
                createPost($pid, $aid, $title, $description, $max_count, $location, $start_date, $end_date, $p_give);

                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    if ($_FILES['images']['error'][$key] === 0) {
                        $name = date('Ymd') . $_SESSION["login_token"] . '_' . uniqid() . '.png';
                        $fileName = $_FILES['images']['name'][$key];
                        $fileSize = $_FILES['images']['size'][$key];
                        $fileTmp = $_FILES['images']['tmp_name'][$key];
                        $fileType = $_FILES['images']['type'][$key];
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
                                    $uploadedFiles[] = [
                                        'image' => $name,
                                        'path' => $destination
                                    ];
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
                header("Location:/");
                exit();
            }

            header("Location:/");
            exit();
            break;
        case '/activity/edit':
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
            $data = updatePost($p_id, $aid, $title, $description, $max_count, $location, $start_date, $end_date, $p_give);
            header("location:/activity/create/show?status=success&message=อัพเดทกิจกรรมสำเร็จ");
            exit();
            break;
        case '/update/user/data':
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
            $gender = $_POST["gender"] ?? "ไม่ระบเพศ";
            setName($fname, $lname, $id);
            setBirthday($birthday, $id);
            setGender($gender, $id);
            echo json_encode(["status"=>200,"message"=>"อัพเดทข้อมูลของท่าสำเร็จ"], JSON_UNESCAPED_UNICODE);
            exit();
            break;
        case '/save/image/submit':
            isLogin();
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $name = date('Ymd') . $_SESSION["login_token"] . '_' . uniqid() . '.png';
                $fileTmp = $_FILES['image']['tmp_name'];
                $destination = '../image/submit/' . $name;
                resizeImage($fileTmp, $destination, 300, 300);
                echo "อัปโหลดสำเร็จ!";
            } else {
                echo "อัปโหลดล้มเหลว!";
            }
            break;
        case '/api/get/post':
            if (!isset($_POST["id_post"]) || empty(isset($_POST["id_post"]))) {
                echo json_encode(["status" => 400, "message" => "id post is null!"], JSON_UNESCAPED_UNICODE);
                exit();
            }
            $login_token = $_SESSION["login_token"];
            $post = getPostDetailById($_POST["id_post"], $login_token);

            if ($post['status'] != 200) {
                echo json_encode($post, JSON_UNESCAPED_UNICODE);
                exit();
            }
            if (empty($post["data"][0]["images"])) {
                $post["data"][0]["images"] = [];
            } else {
                $images = explode(',', $post["data"][0]["images"]);
                $post["data"][0]["images"] = $images;
            }
            $post["data"] = $post["data"][0];
            echo json_encode($post, JSON_UNESCAPED_UNICODE);
            exit();
            break;
        case '/api/register/post':
            isLogin();
            if (!isset($_POST["id_post"]) || empty($_POST["id_post"])) {
                echo json_encode(["status" => 400, "message" => "id post is null!"], JSON_UNESCAPED_UNICODE);
                exit();
            }
            $id_post = $_POST["id_post"];
            $id = $_SESSION["login_token"];
            $result = registerUser($id_post, $id);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit();
            break;
        case '/api/get/register':
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
            break;
        case '/api/update/register':
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
            break;
        case '/api/get/userdetail':
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
            break;
        default:
            header("Location:/");
            break;
    }
} else {
    header("Location:/");
}
