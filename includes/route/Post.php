<?php
require_once("../includes/models/post.php");
require_once("../includes/models/register.php");
class POST{
    function get(){
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
    }
    function register(){
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
    }
}
$Post = new Post();
?>