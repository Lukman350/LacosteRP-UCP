<?php
include_once "../config/db.php";
include_once "../config/email.php";
$conn = new Database;

$response = [];

if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["gender"]) && isset($_POST["age"]) && isset($_POST["pass"]) && isset($_POST["pass2"])) {

    $data = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz~$^%+=[]<>\_(:)&#*@/!-;'";
    $salt = substr(str_shuffle($data),0,16);

    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $username = $fname."_".$lname;
    $email = htmlspecialchars($_POST['email']);
    $token = base64_encode(random_bytes(32));
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
            $pesan = "
                <p>To: <br>Username: <b>$username</b><br><br>
                    Please click link in the below to activate your LCRP Account:<br><br>
                    <a href='https://example.com/register?page=activation&t=".urlencode($token)."'>
                        https://example.com/register?page=activation&t=".urlencode($token)."
                    </a><br><br>
                    Best Regards,<br><br><i>LC:RP Management</i><br><br>
                    <i style='text-align:center'>Copyright © Lacoste Roleplay 2020.</i>
                </p>
            ";
            if (sendEmail("LC:RP Registration", $email, $username, $pesan)) {
                if ($gender == 2) {
                    $skin = 93;
                } else {
                    $skin = 2;
                }
                $sql = "INSERT INTO `players` (`username`,`ip`,`password`,`salt`,`email`,`token`,`reg_date`,`gender`,`age`,`skin`,`posx`,`posy`,`posz`,`posa`,`brek`,`money`,`bmoney`) VALUES ('$username','$ip','$pass','$salt','$email','$token','$regdate',$gender,'$age',$skin,$x,$y,$z,$a,'$brek',250,200)";
                $query = $conn->db->prepare($sql);
                if ($query->execute()) {
                    $response["status"] = 1;
                    $response["message"] = 'Your account has been successfuly registered! Please check your email to activate your account.';   
                }
            } else {
                $response["status"] = 0;
                $response["message"] = 'Something went wrong, email activation not send! Please try again.';
            }
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
        $pesan = "
            <p>To: <br>Username: <b>$user</b><br><br>
                Please click link in the below to activate your LCRP Account:<br><br>
                <a href='https://ucp.lacosteroleplay.com/register?page=activation&t=".urlencode($token)."'>
                    https://ucp.lacosteroleplay.com/register?page=activation&t=".urlencode($token)."
                </a><br><br>
                Best Regards,<br><br><i>LC:RP Management</i><br><br>
                <i style='text-align:center'>Copyright © Lacoste Roleplay 2020.</i>
            </p>
        ";
        if (sendEmail("LC:RP Account Activation", $email, $user, $pesan)) {
            $sql = "UPDATE players SET token = '$token', email = '$email' WHERE username = '$user'";
            $query = $conn->db->prepare($sql);
            if ($query->execute()) {
                $response["status"] = 1;
                $response["message"] = 'Your account has been successfuly registered! Please check your email to activate your account.';
            }
        } else {
            $response["status"] = 0;
            $response["message"] = 'Something went wrong, email activation not send! Please try again.';
        }
    } else {
        $sql = $conn->db->prepare("UPDATE players SET email = '$email' WHERE username = '$user'");
        if ($sql->execute()) {
            $pesan = "
                <p>To: <br>Username: <b>$user</b><br><br>
                    Please click link in the below to activate your LCRP Account:<br><br>
                    <a href='https://ucp.lacosteroleplay.com/register?page=activation&t=".urlencode($token)."'>
                        https://ucp.lacosteroleplay.com/register?page=activation&t=".urlencode($token)."
                    </a><br><br>
                    Best Regards,<br><br><i>LC:RP Management</i><br><br>
                    <i style='text-align:center'>Copyright © Lacoste Roleplay 2020.</i>
                </p>
            ";
            if (sendEmail("LC:RP Account Activation", $email, $user, $pesan)) {
                $sql = "UPDATE players SET token = '$token', email = '$email' WHERE username = '$user'";
                $query = $conn->db->prepare($sql);
                if ($query->execute()) {
                    $response["status"] = 1;
                    $response["message"] = 'Your account has been successfuly registered! Please check your email to activate your account.';
                }
            } else {
                $response["status"] = 0;
                $response["message"] = 'Something went wrong, email activation not send! Please try again.';
            }
        }
    }
}

die(json_encode($response));
