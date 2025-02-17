<?php
require_once("../app/controllers/HomeController.php");
spl_autoload_register(function ($class_name) {
    if (file_exists("../app/controllers/$class_name.php")) {
        require_once "../app/controllers/$class_name.php";
    }
});

$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = trim($path, '/');


switch ($path) {
    case '':
        $data = new HomeController();
        $data->index();
        break;
    
    default:
        header("Location: /");
        break;
}
// $routes = [
//     '' => ['controller' => 'HomeController', 'method' => 'index'],
//     'home' => ['controller' => 'HomeController', 'method' => 'index'],
//     'about' => ['controller' => 'HomeController', 'method' => 'about'],
//     'products' => ['controller' => 'ProductController', 'method' => 'index'],
//     'contact' => ['controller' => 'ContactController', 'method' => 'index'],
//     'contact/submit' => ['controller' => 'ContactController', 'method' => 'submit'],
// ];

// if (preg_match('/^products\/(\d+)$/', $path, $matches)) {
//     $id = $matches[1];
//     $controller = new ProductController();
//     $controller->show($id);
// } else if (array_key_exists($path, $routes)) {
//     $controllerName = $routes[$path]['controller'];
//     $methodName = $routes[$path]['method'];

//     $controller = new $controllerName();
//     $controller->$methodName();
// } else {
//     header("Location: /home");
//     exit();
// }
