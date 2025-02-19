<?php
require_once("models/accout.php");

class Router {
    private $routes = [];
    private $server;
    private $middlewares = [];

    public function __construct($server) {
        $this->server = $server;
    }

    public function use($middleware) {
        $this->middlewares[] = $middleware;
    }

    public function get($path, $callback) {
        $this->addRoute('GET', $path, $callback);
    }

    public function post($path, $callback) {
        $this->addRoute('POST', $path, $callback);
    }

    public function put($path, $callback) {
        $this->addRoute('PUT', $path, $callback);
    }

    public function delete($path, $callback) {
        $this->addRoute('DELETE', $path, $callback);
    }

    private function addRoute($method, $path, $callback) {
        $this->routes[$method][$this->formatPath($path)] = $callback;
    }

    public function dispatch() {
        $method = $this->server['REQUEST_METHOD'];
        $uri = parse_url($this->server['REQUEST_URI'], PHP_URL_PATH);
        $queryParams = $_GET;
        $body = json_decode(file_get_contents("php://input"), true) ?? [];

        foreach ($this->routes[$method] as $route => $callback) {
            $params = $this->matchRoute($route, $uri);
            if ($params !== false) {
                foreach ($this->middlewares as $middleware) {
                    if (call_user_func($middleware, $queryParams, $body, ...$params) === false) {
                        return;
                    }
                }

                echo call_user_func($callback, $queryParams, $body, ...$params);
                return;
            }
        }

        http_response_code(404);
        echo json_encode(["error" => "Route not found"]);
    }

    private function formatPath($path) {
        return '#^' . preg_replace('/\\/:([^\\/]+)/', '/([^/]+)', $path) . '$#';
    }

    private function matchRoute($route, $uri) {
        if (preg_match($route, $uri, $matches)) {
            array_shift($matches);
            return $matches;
        }
        return false;
    }
}

$router = new Router($_SERVER);

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
    
}
// GET
$router->get('/', function() {
    isLogin();
    global $conn;
    $sid = $_SESSION['login'];
    $sql = 'SELECT fname,lname FROM user WHERE sid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $sid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows <= 0) {
        return header("Location:/logout");
        exit();
    }
    $data = $result->fetch_assoc();
    return require_once('../app/views/home.php');
    exit();
});
$router->get('/about',function() {
    isLogin();
    global $conn;
    $sid = $_SESSION['login'];
    $sql = 'SELECT fname,lname,birthday,phone FROM user WHERE sid = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $sid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows <= 0) {
        return header("Location:/logout");
        exit();
    }
    $data = $result->fetch_assoc();
    $query = "SELECT 
                registion.rid AS rid,
                registion.datatime AS r_date,  
                subject.sub_name AS subject_name,           
                teacher.name AS teacher_name        
            FROM 
                registion
            JOIN subject ON registion.sub_id = subject.sub_id
            JOIN teacher ON registion.tid = teacher.tid
            WHERE 
                registion.sid = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $sid);
    $stmt->execute();
    $registion = $result->fetch_assoc();
    return require_once('../app/views/about.php');
    exit();
});
// INSERT INTO `registion` (`id`, `rid`, `sid`, `tid`, `sub_id`, `datatime`) VALUES (NULL, 'r1', '$2y$10$AFjfJyOIiax7Pptf4UZiZ.mMyHC.y/B1Gb.NsiL7G21NH9Ldga2/G', 't01', 'AA01', NULL);
$router->get('/subject',function() {
    isLogin();
    global $conn;
    $sql = 'SELECT 
                subject.sub_id as sub_id,subject.sub_name as sub_name,
                teacher.name as t_name
            FROM 	subject
            JOIN 	teacher ON subject.tid = teacher.tid
            ';
    $result = $conn->query($sql);
    if ($result->num_rows <= 0) {
        return header("Location:/logout");
        exit();
    }
    return require_once('../app/views/subject.php');
    exit();
});
$router->get('/login', function() {
    if(isset($_SESSION["login"])){
        return header("Location:/");
        exit();
    }
    return require_once('../app/views/login.php');
    exit();
});
$router->get('/logout', function() {
    session_unset(); 
    session_destroy();
    return header("Location:/login");
    exit();
});

// POST
$router->post('/login', function() {
    if(isset($_SESSION["login"])){
        return header("Location:/");
        exit();
    }
    if(!isset($_POST["username"])||empty($_POST["username"])){
        return header("Location:/login?message=กรุณาใส่ username.");
        exit();
    }
    if(!isset($_POST["password"])||empty($_POST["password"])){
        return header("Location:/login?message=กรุณาใส่ password.");
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
});

$router->get('/users/:id', function($queryParams, $body, $id) {
    return json_encode([
        "id" => $id,
        "search" => $queryParams['search'] ?? null
    ]);
    exit();
});

$router->post('/edit/:id', function($queryParams, $body, $id) {
    $token = $queryParams['token'] ?? null;
    $password = $body['password'] ?? null;
    $oldpassword = $body['oldpassword'] ?? null;

    if (!$token || !$password || !$oldpassword) {
        http_response_code(400);
        return json_encode(["error" => "Missing required fields"]);
        exit();
    }

    return json_encode([
        "message" => "Updated successfully",
        "id" => $id,
        "token" => $token,
        "newPassword" => $password,
        "oldPassword" => $oldpassword
    ]);
    exit();
});

$router->get('/protected', function($queryParams, $body) {
    return json_encode(["message" => "Welcome to the protected route!"]);
    exit();
});

$router->dispatch();
