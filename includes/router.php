<?php
require_once("models/accout.php");
require_once("models/post.php");
require_once("models/image.php");
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($request, PHP_URL_PATH);

function isLogin(){
    if (isset($_SESSION['login_time'])) {
        $inactive = time() - $_SESSION['login_time'];
        if ($inactive > 600) {
            header('Location:/logout');
            exit();
        }
        $login_token = $_SESSION["login_token"];
        $login_image = $_SESSION["login_image"];
        if(!isset($login_token)||empty($login_token)||!isset($login_image)||empty($login_image)){
            session_destroy();
            header("Location:/logout");
            exit();
        }
        $getaccount = getAccountID($login_token);
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
    imagepng($newImg, $destination); // บันทึกเป็น PNG
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
            $fname = $profile["given_name"];
            $lname = $profile["family_name"];
            $gmail = $profile["email"];
            $image = $profile["picture"];
            $fname = "";
            $lname = "";
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
        case '/':
            isLogin();
            $page = $_GET['page'] ?? 1;
            $posts = getPost(10,$page);
            // foreach($posts["data"] as $key => $post){
            //     echo $post["p_name"];
            //     echo $post["image"];
            // }
            // $postsTop = getPost(10,1); 
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
        case '/user/form/data':
            if (isset($_SESSION['login_time'])) {
                $inactive = time() - $_SESSION['login_time'];
                if ($inactive > 600) {
                    header('Location:/logout');
                    exit();
                }
                $login_token = $_SESSION["login_token"];
                if(!isset($login_token)||empty($login_token)){
                    header("Location:/logout");
                    exit();
                }
            }else{
                header('Location:/logout');
                exit();
            }
            require_once('../app/views/user/update.php');
            exit();
            break;
        case '/user/setting':
            isLogin();
            require_once('../app/views/user/setting.php');
            exit();
            break;
        case '/logout':
            session_unset(); 
            session_destroy();
            header("Location:/login");
            exit();
            break;
        case '/req':
            require_once('../app/views/req_activity.php');
            exit();
            break;
        case '/activity/create':
            isLogin();
            require_once('../app/views/activity/create.php');
            exit();
            break;
        case '/activity/create/show':
            isLogin();
            require_once('../app/views/activity/show.php');
            exit();
            break;
        case '/upload/image':
            require_once('../app/views/upload_img.php');
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
        case '/save/image/post':
            isLogin();
            if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $name = date('Ymd').$_SESSION["login_token"].'_'.uniqid().'.png';
                $fileTmp = $_FILES['image']['tmp_name'];
                $destination = '../image/post/'.$name;
                resizeImage($fileTmp, $destination, 300, 300);
                echo "อัปโหลดสำเร็จ!";
            } else {
                echo "อัปโหลดล้มเหลว!";
            }
            break;
        default:
            header("Location:/");
            break;
    }
}else{
    header("Location:/");
}