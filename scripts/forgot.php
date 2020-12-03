<?php 
include_once "../db/db.php";
$conn = new Database;

$response = [];

// Forgot Password
if (isset($_POST["username"]) && isset($_POST["email"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];

    $data = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
    $kode = substr(str_shuffle($data),0,10);

    $query = $conn->db->prepare("SELECT * FROM players WHERE username = '$username' AND email = '$email'");
    $query->execute();
    if ($query->rowCount() > 0) {
        include_once "../vendor/send-pass.php";
    } else {
        $response["status"] = 0;
        $response["message"] = 'This username and email was not found!';
    }
}

// Reset Password
if (isset($_POST["newpass"]) && isset($_POST["pwconfirm"]) && isset($_POST["code"])) {
    $rand = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz~$^%+=[<]>\(_:&)*@?/'-;";
    $salt = substr(str_shuffle($rand),0,16);

    $pass1 = strtoupper(hash("sha256", $_POST["newpass"] . $salt));
    $pass2 = strtoupper(hash("sha256", $_POST["pwconfirm"] . $salt));
    $code = $_POST["code"];

    $query = $conn->db->prepare("SELECT * FROM players WHERE kode = '$code'");
    $query->execute();
    if ($query->rowCount() > 0) {
        if ($pass1 != $pass2) {
            $response["status"] = 0;
            $response["message"] = "Password doesn't match!";
        } else {
            $sql = $conn->db->prepare("UPDATE players SET password = '$pass1', salt = '$salt', kode = '' WHERE kode = '$code'");
            $sql->execute();
            $response["status"] = 1;
            $response["message"] = 'Your password has been successfully changed! Click OK button to login.';
        }
    } else {
        $response["status"] = 0;
        $response["message"] = "Invalid code!";
    }
}

// Forgot Username
if (isset($_POST["mail"])) {
    $mailer = $_POST["mail"];

    $query = $conn->db->prepare("SELECT * FROM players WHERE email = '$mailer'");
    $query->execute();
    if ($query->rowCount() > 0) {
        $data = $query->fetch(PDO::FETCH_ASSOC);
        include_once "../vendor/send-user.php";
    } else {
        $response["status"] = 0;
        $response["message"] = "This email was not found!";
    }
}

die(json_encode($response));