<?php
include_once "../db/db.php";
$conn = new Database;

$response = [];

if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["gender"]) && isset($_POST["age"]) && isset($_POST["pass"]) && isset($_POST["pass2"])) {

    $data = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz~$^%+=[]<>\_(:)&#*@/!-;'";
    $salt = substr(str_shuffle($data),0,16);

    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $username = $fname."_".$lname;
    $email = htmlspecialchars($_POST['email']);
    $token = md5(uniqid(rand(), true));
    $ip = $conn->getIP();
    $regdate = date("d/m/Y h:i:s");
    $x = 1744.3411;
    $y = -1862.8655;
    $z = 13.3983;
    $a = 270.0001;
    $money = 250;
    $bmoney = 200;
    $gender = $_POST["gender"];
    $age = date('d/m/Y', strtotime($_POST['age']));
    $pass = strtoupper(hash("sha256", $_POST['pass'] . $salt));
    $pass2 = strtoupper(hash("sha256", $_POST['pass2'] . $salt));
    $brek = rand(11111,99999);

    if ($conn->checkUsername($username)) {
        $response["status"] = 0;
        $response["message"] = 'This username has been already registered!';
    } elseif ($conn->checkEmail($email)) {
        $response["status"] = 0;
        $response["message"] = 'This email has been already registered!';
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/",$fname) OR !preg_match("/^[a-zA-Z ]*$/",$lname)) {
            $response["status"] = 0;
            $response["message"] = "Only alphabetics character are allowed!";
        } elseif ($pass != $pass2) {
            $response["status"] = 0;
            $response["message"] = "Password doesn't match!";
        } else {
            include_once "../vendor/send.php";
        }
    }
}

if (isset($_POST["e-mail"]) && isset($_POST["pname"])) {
    $email = $_POST["e-mail"];
    $user = $_POST["pname"];
    $token = base64_encode(random_bytes(32));
    $query = $conn->db->prepare("SELECT * FROM players WHERE email = '$email'");
    $query->execute();
    if ($query->rowCount() > 0) {
        include_once "../vendor/send-activate.php";
    } else {
        $sql = $conn->db->prepare("UPDATE players SET email = '$email' WHERE username = '$user'");
        if ($sql->execute()) {
            include_once "../vendor/send-activate.php";
        }
    }
}

die(json_encode($response));
// }
