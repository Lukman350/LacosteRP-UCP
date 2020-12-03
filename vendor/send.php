<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include librari phpmailer
include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');

$email_pengirim = 'admin@lacosteroleplay.com'; // Isikan dengan email pengirim
$nama_pengirim = 'Lacoste Roleplay'; // Isikan dengan nama pengirim
$email_penerima = $email; // Ambil email penerima dari inputan form
$nama_penerima = $username;
$subjek = 'LC:RP Account Activation'; // Ambil subjek dari inputan form
$pesan = "
    <p>To: <br>Username: <b>$username</b><br><br>
        Please click link in the below to activate your LCRP Account:<br><br>
        <a href='https://ucp.lacosteroleplay.com/register?page=activation&t=$token'>
            https://ucp.lacosteroleplay.com/register?page=activation&t=$token
        </a><br><br>
        Best Regards,<br><br><i>LC:RP Management</i><br><br>
        <i style='text-align:center'>Copyright © Lacoste Roleplay 2020.</i>
    </p>
"; // Ambil pesan dari inputan form
// $attachment = $_FILES['attachment']['name']; // Ambil nama file yang di upload

$mail = new PHPMailer;
$mail->isSMTP();

$mail->Host = 'smtp.hostinger.co.id';
$mail->Username = $email_pengirim; // Email Pengirim
$mail->Password = 'Lcrp2307'; // Isikan dengan Password email pengirim
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
// $mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging

$mail->setFrom('admin@lacosteroleplay.com', $nama_pengirim);
$mail->addAddress($email_penerima, $nama_penerima);
$mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

$mail->Subject = $subjek;
$mail->Body = $pesan;
$sendMail = $mail->send();
if ($sendMail) {
    if ($gender == 2) {
        $skin = 93;
    } else {
        $skin = 2;
    }
    $sql = "INSERT INTO players (username,ip,password,salt,email,token,reg_date,gender,age,skin,posx,posy,posz,posa,brek,money,bmoney) VALUES ('$username','$ip','$pass','$salt','$email','$token','$regdate',$gender,'$age',$skin,$x,$y,$z,$a,'$brek',250,200)";
    $query = $conn->db->prepare($sql);
    if ($query->execute()) {
        $response["status"] = 1;
        $response["message"] = 'Your account has been successfuly registered! Please check your email to activate your account.';   
    }
} else {
    $response["status"] = 0;
    $response["message"] = 'Something went wrong, email activation not send! Please try again.';
}