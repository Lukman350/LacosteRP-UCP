<?php
session_start();
include_once "../db/db.php";
$conn = new Database;

$response = [];
$username = $_POST['username'];
$query = $conn->db->prepare("SELECT * FROM players WHERE username = ? OR email = ?");
$query->execute(array($username, $username));

if ($query->rowCount() > 0) {
    $data = $query->fetch(PDO::FETCH_ASSOC);
    $salt = $data['salt'];
    $pass = strtoupper(hash("sha256", $_POST['pass'] . $salt));
    $passDB = $data['password'];
    $aktif = $data['aktif'];
    $user = $data['username'];
    $mail = $data['email'];
    $admin = $data['adminname'];

    if ($aktif == 0) {
        $response["status"] = 0;
        $response["message"] = 'This account is not activated, please check email to activate your account!';
    } else {
        if ($pass == $passDB) {
            $_SESSION["user"] = $user;
            $_SESSION["email"] = $mail;
            if ($admin != "None") {
                $_SESSION["admin"] = $admin;
            }
            
            $response["status"] = 1;
            $response["message"] = 'Click OK button to continue.';
        } else {
            $response["status"] = 0;
            $response["message"] = 'Wrong password!';
        }
    }
} else {
    $response["status"] = 0;
    $response["message"] = 'This username or email is not registered!';
}

die(json_encode($response));