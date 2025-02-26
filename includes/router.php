<?php
require_once("models/accout.php");

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
        if(!isset($_SESSION["login"])||empty($_SESSION["login"])){
            session_destroy();
            header("Location:/logout");
            exit();
        }
    } else {
        header('Location:/logout');
        exit();
    }
};

if($method=="GET"){
    switch ($path) {
        case '/':
            isLogin();
            global $conn;
            $sid = $_SESSION['login'];
            $sql = 'SELECT fname,lname FROM user WHERE sid = ?';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $sid);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows <= 0) {
                header("Location:/logout");
                exit();
            }
            $data = $result->fetch_assoc();
            require_once('../app/views/home.php');
            exit();
            break;
        case '/login':
            if(isset($_SESSION["login"])){
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
        default:
            header("Location:/");
            break;
    }
}else{
    header("Location:/");
}