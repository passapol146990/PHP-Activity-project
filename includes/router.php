<?php
require_once("middleware.php");

require_once("route/Page.php");
require_once("route/Auth.php");
require_once("route/Activity.php");
require_once("route/Register.php");
require_once("route/Register.php");
require_once("route/User.php");
require_once("route/Post.php");


$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($request, PHP_URL_PATH);

if ($method == "GET") {
    switch ($path) {
        case '/':
            $Page->home();
            exit();
        case '/login':
            $Page->login();
            break;
        case '/logout':
            $Page->logout();
            break;
        case '/auth/google':
            $Auth->auth();
            break;
        case '/auth/google/callback':
            $Auth->callback();
            break;
        case '/user/setting':
            $Page->setting();
            break;
        case '/activity/create':
            $Activity->PageCreate();
            break;
        case '/activity/edit':
            $Activity->PageUpdate();
            break;
        case '/activity/create/show':
            $Activity->PageShow();
            break;
        case '/activity/delete':
            $Activity->Delete();
            break;
        case '/activity/register/show':
            $Register->Show();
            break;
        case '/register/cancel':
            $Register->cancelRegister();
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
            break;
        default:
            header("Location:/");
            break;
    }
} else if ($method == "POST") {
    switch ($path) {
        case '/activity/create':
            $Activity->create();
            break;
        case '/activity/edit':
            $Activity->update();
            break;
        case '/update/user/data':
            $User->update();
            break;
        case '/image/submit':
            // isLogin();
            // if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
            //     $name = date('Ymd') . $_SESSION["login_token"] . '_' . uniqid() . '.png';
            //     $fileTmp = $_FILES['image']['tmp_name'];
            //     $destination = '../image/submit/' . $name;
            //     resizeImage($fileTmp, $destination, 300, 300);
            //     echo "อัปโหลดสำเร็จ!";
            // } else {
            //     echo "อัปโหลดล้มเหลว!";
            // }
            $Activity->userSubmitpic();
            break;
        case '/api/get/post':
            $Post->get();
            break;
        case '/api/register/post':
            $Post->register();
            break;
        case '/api/get/register':
            $Register->get();
            break;
        case '/api/update/register':
            $Register->update();
            break;
        case '/api/get/userdetail':
            $User->get();
            break;
        default:
            header("Location:/");
            break;
    }
} else {
    header("Location:/");
}
