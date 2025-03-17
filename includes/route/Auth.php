<?php
require_once("../includes/models/accout.php");
class AUTH{
    private $google_client_id = "656159499613-m1ql830ogktmslu2pecormultjc8m9r0.apps.googleusercontent.com";
    private $google_client_secret = "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";
    private $google_redirect_uri = "http://localhost/auth/google/callback";
    // private $google_redirect_uri = "https://caiman-steady-flounder.ngrok-free.app/auth/google/callback";
    // private $google_redirect_uri = "https://activity.xn--v3cavs8a.xn--o3cw4h/auth/google/callback";
    function auth(){
        $url = "https://accounts.google.com/o/oauth2/v2/auth?client_id={$this->google_client_id}&redirect_uri={$this->google_redirect_uri}&response_type=code&scope=profile email";
        header("Location:{$url}");
        exit();
    }
    function callback(){
        $code = $_GET['code'] ?? null;
        if (!$code) {
            header("location:/");
            exit();
        }
        $token_url = "https://oauth2.googleapis.com/token";
        $token_data = [
            'client_id' => $this->google_client_id,
            'client_secret' => $this->google_client_secret,
            'code' => $code,
            'redirect_uri' => $this->google_redirect_uri,
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
    }
}
$Auth = new AUTH();
?>