<?php 
include_once "../config/db.php";
include_once "../config/email.php";
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
        $pesan = "
            <p>To: <br>Username: <b>$username</b><br><br>
                Please click link in the below to reset your password:<br><br>
                <a href='https://ucp.lacosteroleplay.com/forgot?page=pass&c=".urlencode($kode)."'>
                    https://ucp.lacosteroleplay.com/forgot?page=pass&c=".urlencode($kode)."
                </a><br><br>
                Best Regards,<br><br><br><i>LC:RP Management</i><br><br>
                <i style='text-align:center'>Copyright © Lacoste Roleplay 2020.</i>
            </p>
        ";
        if (sendEmail('LC:RP Reset Password', $email, $username, $pesan)) {
            $sql = $conn->db->prepare("UPDATE players SET kode = '$kode' WHERE username = '$username' AND email = '$email'");
            $sql->execute();
            $response["status"] = 1;
            $response["message"] = 'Request reset password has been send! Please check your email to reset your password.';
        } else {
            $response["status"] = 0;
            $response["message"] = 'Something went wrong, email reset password not send! Please try again.';
        }
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
        $pesan = "
            <p>To: <br>Email: <b>".$mailer."</b><br><br>
                Your account username is: <b>".$nama_penerima."</b><br><br>
                Best Regards,<br><br><br><i>LC:RP Management</i><br><br>
                <i style='text-align:center'>Copyright © Lacoste Roleplay 2020.</i>
            </p>
        ";
        if (sendEmail('LC:RP Forgot Username', $mailer, $data['username'], $pesan)) {
            $response["status"] = 1;
            $response["message"] = 'Request forgot username has been send! Please check your email.';
        } else {
            $response["status"] = 0;
            $response["message"] = 'Something went wrong, email forgot username not send! Please try again.';
        }
    } else {
        $response["status"] = 0;
        $response["message"] = "This email was not found!";
    }
}

die(json_encode($response));