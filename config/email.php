<?php
use PHPMailer\PHPMailer\PHPMailer;

// Include librari phpmailer
include('../vendor/phpmailer/Exception.php');
include('../vendor/phpmailer/PHPMailer.php');
include('../vendor/phpmailer/SMTP.php');

function sendEmail($subjek, $email_penerima, $nama_penerima, $pesan) {
  $email_pengirim = 'email@example.com'; // Isikan dengan email pengirim
  $nama_pengirim = 'Lacoste Roleplay'; // Isikan dengan nama pengirim

  $mail = new PHPMailer;
  $mail->isSMTP();

  $mail->Host = 'mail.example.com';
  $mail->Username = $email_pengirim; // Email Pengirim
  $mail->Password = 'password123'; // Isikan dengan Password email pengirim
  $mail->Port = 465;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'ssl';

  $mail->setFrom($email_pengirim, $nama_pengirim);
  $mail->addAddress($email_penerima, $nama_penerima);
  $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

  $mail->Subject = $subjek;
  $mail->Body = $pesan;
  if ($mail->send()) {
    return true;
  } else {
    return false;
  }
}
