<?php
require_once("models/accout.php");
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
        if(!isset($login_token)||empty($login_token)){
            session_destroy();
            header("Location:/logout");
            exit();
        }
        $getaccount = getAccountID($login_token);
        $account = $getaccount['data']->fetch_assoc();
        if(empty($account['birthday'])||empty($account['gender'])){
            header('location:/form');
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
        case '/form':
            require_once('../app/views/form.php');
            exit();
            break;
        case '/logout':
            session_unset(); 
            session_destroy();
            header("Location:/login");
            exit();
            break;
        case '/about':
            isLogin();
            global $conn;
            $sid = $_SESSION['login'];
            $sql = 'SELECT fname,lname,birthday,phone FROM user WHERE sid = ?';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows <= 0) {
                header("Location:/logout");
                exit();
            }
            $data = $result->fetch_assoc();
            $query = "  SELECT	registion.rid as rid,
                                registion.datatime as datetime,
                                subject.sub_name as sub_name,
                                teacher.name as t_name
                        FROM 	registion
                        JOIN	subject ON subject.sub_id = registion.sub_id
                        JOIN	teacher	ON subject.tid	= teacher.tid
                        WHERE registion.sid = ?
            ";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $sid);
            $stmt->execute();
            $registion = $stmt->get_result();
            require_once('../app/views/about.php');
            exit();
            break;
        case '/subject':
            isLogin();
            global $conn;
            $sql = 'SELECT 
                        subject.sub_id as sub_id,subject.sub_name as sub_name,
                        teacher.name as t_name, teacher.tid as tid
                    FROM 	subject
                    JOIN 	teacher ON subject.tid = teacher.tid
                    ';
            $result = $conn->query($sql);
            if ($result->num_rows <= 0) {
                header("Location:/logout");
                exit();
            }
            require_once('../app/views/subject.php');
            exit();
            break;
        case '/registion':
            global $conn;
            isLogin();
            if(isset($_GET["sub_id"])&&isset($_GET["tid"])){
                $rid = $_GET["sub_id"].$_SESSION["login"];
                $sql = "SELECT 	* 
                        FROM 	registion 
                        WHERE 	registion.rid = ?;";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s',$rid);
                $stmt->execute();
                $check = $stmt->get_result();
                if($check->num_rows > 0){
                    header("Location:/subject?warning=คุณลงทะเบียนวิชานี้ไปแล้ว");
                }else{
                    $sid = $_SESSION["login"];
                    $tid = $_GET["tid"];
                    $sub_id = $_GET["sub_id"];
                    $datetime = date('Y-m-d H:i:s');
    
                    $sql = "INSERT INTO registion (`id`, `rid`, `sid`, `tid`, `sub_id`, `datatime`) 
                            VALUES (NULL,?,?,?,?,?);";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('sssss', $rid, $sid, $tid, $sub_id, $datetime);
                    $stmt->execute();
                    header("Location:/about?success=ลงทะเบียนสำเร็จ");
                }  
            }else{
                header("Location:/subject");
            };
            break;
        case '/del':
                global $conn;
                isLogin();
                if(isset($_GET["rid"])){
                    $rid = $_GET["rid"];
                    $sql = "DELETE 	FROM 	registion 
                            WHERE 	registion.rid = ?
                            AND registion.sid = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ss',$rid,$_SESSION["login"]);
                    $stmt->execute(); 
                    header("Location:/about?del=ลบข้อมูลสำเร็จ");
                }else{
                    header("Location:/about");
                };
                break;
        case '/req':
            require_once('../app/views/req_activity.php');
            exit();
            break;
        case '/activity_create':
            require_once('../app/views/show_activity_create.php');
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
            $login = login($_POST["username"],$_POST["password"]);
            if($login["status"]!=200){
                header("Location:/login?message=".$login["message"]);
                exit();
            }else{
                header("Location:/");
                exit();
            }
            break;
        case '/update/profile':
            // $id = $_POST["id"] ?? "";
            // $birthday = $_POST["birthday"]?? "";
            // $gender= $_POST["gender"]?? "";
            // if (empty($id)){
            //     exit();
            // }
            // if (!empty($birthday)){
            //     setBirthday($birthday,$id);
            // }
            // if (!empty($gender)){
            //     setGender($gender,$id);
            // }
            // header("Location:/");
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