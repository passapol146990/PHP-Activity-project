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
        if(!isset($login_token)||empty($login_token)||!isset($login_image)||empty($login_image)||!isset($login_name)||empty($login_name)){
            session_destroy();
            header("Location:/logout");
            exit();
        }
        $getaccount = getAccountID($login_token);
        if($getaccount["data"]->num_rows==0){
            header('Location:/logout');
            exit();
        }
        $account = $getaccount['data']->fetch_assoc();
        if(empty($account['birthday'])||empty($account['gender'])){
            require_once('../app/views/user/update.php');
            exit();
        }
    } else {
        header('Location:/logout');
        exit();
    }
};
function resizeImage($source, $destination, $width, $height) {
    $img = imagecreatefromstring(file_get_contents($source));
    $newImg = imagescale($img, $width, $height);
    imagepng($newImg, $destination);
    imagedestroy($img);
    imagedestroy($newImg);
}

if($method=="GET"){
    switch ($path) {
        case '/auth/google/callback':
            $code = $_GET['code'] ?? null;
            if (!$code) {
                header("location:/");
                exit();
            }
            $client_id = getenv('Auth_Google_CLIENT_ID');
            $client_secret = getenv('Auth_Google_CLIENT_SECRET');
            $redirect_uri = getenv('Auth_Google_REDIRECT');
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
            $id = hash('sha256',$profile['id']);
            $verified_email = $profile['verified_email'];
            $fname = ($profile["given_name"])??"";
            $lname = ($profile["family_name"])??"";
            $gmail = ($profile["email"])??"";
            $image = ($profile["picture"])??"";
            if($verified_email!=1){
                header("location:/");
                exit();
            }
            login($id,$fname,$lname,$gmail,$image);
            header('location:/');
            exit();
            break;
        case '/auth/google':
            $url = "https://accounts.google.com/o/oauth2/v2/auth?client_id={$google_client_id}&redirect_uri={$google_redirect_uri}&response_type=code&scope=profile email";
            header("Location:{$url}");
            break;
        case '/x':
            $data = getRegister("x","x","x",1);
            print_r($data);
            break;
        case '/':
            isLogin();
            $page = $_GET['page'] ?? 1;
            $postsTop = getPost(10,1); //ห้ามยุ่งบรรทัดนี้
            $posts = "";
            if(isset($_GET['s'])||!empty($_GET['s'])){
                $seach = $_GET['s'];
                $posts = getPostBySearch(10,$page,$seach);
            }else{
                $posts = getPost(10,$page);
            }
            require_once('../app/views/home.php');
            exit();
            break;
        case '/login':
            if(isset($_SESSION["login_token"])){
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
            require_once('../app/views/register/show.php');
            exit();
            break;
        case '/setting':
            require_once('../app/views/setting.php');
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
            $data = getPosttoedit($p_id,$p_aid);
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
            require_once('../app/views/activity/create.php');
            exit();
            break;
        case '/activity/delete':
            isLogin();
            $aid = $_SESSION["login_token"];
            $pid = $_GET["pid"];
            deletePostByIdPostAndIdUser($pid,$aid);
            header("location:/activity/create/show?status=success&message=ลบกิจกรรมสำเร็จ");
            exit();
            break;
        case '/activity/create/show':
            isLogin();
            $id_user = $_SESSION["login_token"];
            $page = $_GET['page'] ?? 1;
            $data = getPostUserCreate($id_user,10,$page);
            if($data["status"]!=200){
                $data["data"] = [];
            }
            require_once('../app/views/activity/show.php');
            exit();
            break;
        case '/user/setting':
            isLogin();
            $login_token = $_SESSION["login_token"];
            $getaccount = getAccountID($login_token);
            $account = $getaccount['data']->fetch_assoc();
            require_once('../app/views/user/setting.php');
            exit();
            break;
        case '/get/image':
            $img = $_GET['img'] ?? '';
            $file = '../image/'.$img;
            if (file_exists($file)) {
                header('Content-Type: image/png');
                readfile($file);
            } else {
                http_response_code(404);
                echo "ไม่พบรูปภาพ";
            }
            break;
        default:
            header("Location:/");
            break;
    }
}else if($method=="POST"){
    switch ($path) {
        case '/login':
            if(isset($_SESSION["login"])){
                header("Location:/");
                exit();
            }
            if(!isset($_POST["username"])||empty($_POST["username"])){
                header("Location:/login?message=กรุณาใส่ username.");
                exit();
            }
            if(!isset($_POST["password"])||empty($_POST["password"])){
                header("Location:/login?message=กรุณาใส่ password.");
                exit();
            }
            // $login = login($_POST["username"],$_POST["password"]);
            if($login["status"]!=200){
                header("Location:/login?message=".$login["message"]);
                exit();
            }else{
                header("Location:/");
                exit();
            }
            break;
        case '/activity/create':
            isLogin();
            if(!isset($_POST["title"])||empty($_POST["title"])){
                header("Location:/activity/create?message=กรุณาใส่ชื่อกิจกรรม.");
                exit();
            }
            if(!isset($_POST["description"])||empty($_POST["description"])){
                header("Location:/activity/create?message=กรุณาใส่รายละเอียดกิจกรรม.");
                exit();
            }
            if(!isset($_POST["max_count"])||empty($_POST["max_count"])){
                header("Location:/activity/create?message=กรุณาใส่จำนวนคนที่รับ.");
                exit();
            }
            if(!isset($_POST["start_date"])||empty($_POST["start_date"])){
                header("Location:/activity/create?message=กรุณาใส่วันที่เริ่มกิจกรรม.");
                exit();
            }
            if(!isset($_POST["end_date"])||empty($_POST["end_date"])){
                header("Location:/activity/create?message=กรุณาใส่วันที่สิ้นสุดกิจกรรม.");
                exit();
            }
            if(!isset($_POST["location"])||empty($_POST["location"])){
                header("Location:/activity/create?message=กรุณาใส่สถานที่จัดกิจกรรม.");
                exit();
            }
            if(!isset($_POST["p_give"])||empty($_POST["p_give"])){
                header("Location:/activity/edit?message=กรุณาใส่สถานที่จัดกิจกรรม.");
                exit();
            }
            if(!isset($_FILES['images'])||empty($_POST["location"])){
                header("Location:/activity/create?message=กรุณาใส่รูปภาพ.");
                exit();
            }
            $aid = $_SESSION["login_token"];
            $title = $_POST["title"];
            $pid =  hash('sha256',$aid.uniqid().$title); 
            $description = $_POST["description"];
            $max_count = $_POST["max_count"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $location = $_POST["location"];
            $p_give = $_POST["p_give"] ?? "";
            $uploadedFiles = []; //image,path
            createPost($pid,$aid,$title,$description,$max_count,$location,$start_date,$end_date,$p_give);
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['images']['error'][$key] === 0) {
                    $name = date('Ymd').$_SESSION["login_token"].'_'.uniqid().'.png';
                    $fileName = $_FILES['images']['name'][$key];
                    $fileSize = $_FILES['images']['size'][$key];
                    $fileTmp = $_FILES['images']['tmp_name'][$key];
                    $fileType = $_FILES['images']['type'][$key];
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $allowedExtensions = ['jpg', 'png'];
                    if (in_array($fileExt, $allowedExtensions)) {
                        if ($fileSize < 5000000) {
                            $destination = '../image/post/'.$name;
                            if (move_uploaded_file($fileTmp, $destination)) {
                                $uploadedFiles[] = [
                                    'image' => $name,
                                    'path' => $destination
                                ];
                                createImage($name,$pid);
                            }
                        }
                    }
                }
            }
            header("Location:/");
            exit();
            break;
        case '/activity/edit':
            isLogin();
            if(!isset($_POST["title"])||empty($_POST["title"])){
                header("Location:/activity/edit?status=warnign&message=กรุณาใส่ชื่อกิจกรรม.");
                exit();
            }
            if(!isset($_POST["description"])||empty($_POST["description"])){
                header("Location:/activity/edit?status=warnign&message=กรุณาใส่รายละเอียดกิจกรรม.");
                exit();
            }
            if(!isset($_POST["max_count"])||empty($_POST["max_count"])){
                header("Location:/activity/edit?status=warnign&message=กรุณาใส่จำนวนคนที่รับ.");
                exit();
            }
            if(!isset($_POST["start_date"])||empty($_POST["start_date"])){
                header("Location:/activity/edit?status=warnign&message=กรุณาใส่วันที่เริ่มกิจกรรม.");
                exit();
            }
            if(!isset($_POST["end_date"])||empty($_POST["end_date"])){
                header("Location:/activity/edit?status=warnign&message=กรุณาใส่วันที่สิ้นสุดกิจกรรม.");
                exit();
            }
            if(!isset($_POST["location"])||empty($_POST["location"])){
                header("Location:/activity/edit?status=warnign&message=กรุณาใส่สถานที่จัดกิจกรรม.");
                exit();
            }
            if(!isset($_POST["p_give"])||empty($_POST["p_give"])){
                header("Location:/activity/edit?status=warnign&message=กรุณาใส่สถานที่จัดกิจกรรม.");
                exit();
            }
            $aid = $_SESSION["login_token"];
            $p_id = $_POST["p_id"]??"";
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
            if (isset($_SESSION['login_time'])) {
                $inactive = time() - $_SESSION['login_time'];
                if ($inactive > 600) {
                    header('Location:/logout');
                    exit();
                }
                $login_token = $_SESSION["login_token"];
                if(!isset($login_token)||empty($login_token)){
                    session_destroy();
                    header("Location:/logout");
                    exit();
                }
            } else {
                header('Location:/logout');
                exit();
            }
            $id = $_SESSION["login_token"];
            $fname = $_POST["fname"]?? "";
            $lname = $_POST["lname"]?? "";
            $birthday = $_POST["birthday"]?? "";
            $gender= $_POST["gender"]?? "";
            if(empty($fname)||empty($lname)||empty($birthday)||empty($gender)){
                header("Location:/form/user/data?message=กรุณากรอกข้อมูลให้ครบ");
                exit();
            }
            setName($fname,$lname,$id);
            setBirthday($birthday,$id);
            setGender($gender,$id);
            header("Location:/");
            break;
        case '/save/image/submit':
            isLogin();
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $name = date('Ymd').$_SESSION["login_token"].'_'.uniqid().'.png';
                $fileTmp = $_FILES['image']['tmp_name'];
                $destination = '../image/submit/'.$name;
                resizeImage($fileTmp, $destination, 300, 300);
                echo "อัปโหลดสำเร็จ!";
            } else {
                echo "อัปโหลดล้มเหลว!";
            }
            break;
        // case '/save/image/post':
        //     isLogin();
        //     if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        //         $name = date('Ymd').$_SESSION["login_token"].'_'.uniqid().'.png';
        //         $fileTmp = $_FILES['image']['tmp_name'];
        //         $destination = '../image/post/'.$name;
        //         resizeImage($fileTmp, $destination, 300, 300);
        //         echo "อัปโหลดสำเร็จ!";
        //     } else {
        //         echo "อัปโหลดล้มเหลว!";
        //     }
        //     break;
        case '/api/get/post':
            if(!isset($_POST["id_post"])||empty(isset($_POST["id_post"]))){
                echo json_encode(["status" => 400, "message" => "id post is null!"],JSON_UNESCAPED_UNICODE);
                exit();
            }
            $post = getPostDetailById($_POST["id_post"]);
            if($post['status']!=200){
                echo json_encode($post,JSON_UNESCAPED_UNICODE);
                exit();
            }
            if(empty($post["data"][0]["images"])){
                $post["data"][0]["images"] = [];
            }else{
                $images = explode(',', $post["data"][0]["images"]);
                $post["data"][0]["images"] = $images;
            }
            $post["data"] = $post["data"][0];
            echo json_encode($post,JSON_UNESCAPED_UNICODE);
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
            if(!isset($_POST["id_post"])||empty(isset($_POST["id_post"]))){
                echo json_encode(["status" => 400, "message" => "id post is null!"],JSON_UNESCAPED_UNICODE);
                exit();
            }
            $page = $_POST['page'] ?? 1;
            $id_post = $_POST["id_post"];
            $id_user = $_SESSION["login_token"];
            $data = getRegisterByIdPostAndIdUser($id_post,$id_user,100,$page);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit();
            break;
                break;
        case '/api/get/userdetail':
            isLogin();
            if(!isset($_POST["pid"])||empty(isset($_POST["pid"]))){
                echo json_encode(["status" => 400, "message" => "id post is null!"],JSON_UNESCAPED_UNICODE);
                exit();
            }
            if(!isset($_POST["uid"])||empty(isset($_POST["uid"]))){
                echo json_encode(["status" => 400, "message" => "id user is null!"],JSON_UNESCAPED_UNICODE);
                exit();
            }
            $pid = $_POST["pid"];
            $uid = $_POST["uid"];
            $aid = $_SESSION["login_token"];
            $data = getUserByIdPostAndIdUser($aid,$pid,$uid);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit();
            break;
                break;
        default:
            header("Location:/");
            break;
    }
}else{
    header("Location:/");
}