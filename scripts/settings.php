<?php
session_start();
include_once "../db/db.php";
$conn = new Database;
$data = $conn->fetchPlayer($_SESSION["user"]);

$response = [];

// Change Password
if (isset($_POST["oldpass"]) && isset($_POST["newpass"]) && isset($_POST["cnewpass"])) {
  $rand = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz~$^%+=[]<>\_(:)&#*@/!-;'";
  $salt = substr(str_shuffle($rand),0,16);

  $saltDB = $data["salt"];
  $oldpass = strtoupper(hash("sha256", $_POST["oldpass"] . $saltDB));
  $newpass = strtoupper(hash("sha256", $_POST["newpass"] . $salt));
  $cnewpass = strtoupper(hash("sha256", $_POST["cnewpass"] . $salt));
  $username = $_SESSION["user"];

  $query = $conn->db->prepare("SELECT * FROM players WHERE username = '$username' AND password = '$oldpass'");
  $query->execute();
  if ($query->rowCount() > 0) {
    if ($newpass != $cnewpass) {
      $response["status"] = 0;
      $response["message"] = "Password doesn't match!";
    } else {
      $sql = $conn->db->prepare("UPDATE players SET password = '$newpass', salt = '$salt' WHERE username = '$username' AND password = '$oldpass'");
      if ($sql->execute()) {
        $response["status"] = 1;
        $response["message"] = "Password has been changed!";
      } else {
        $response["status"] = 0;
        $response["message"] = "Something wen't wrong!";
      }
    }
  } else {
    $response["status"] = 0;
    $response["message"] = "Wrong Password!";
  }
}

// Change Email
if (isset($_POST["oldemail"]) && isset($_POST["newemail"]) && isset($_POST["cnewemail"])) {
  $oldemail = $_POST["oldemail"];
  $newemail = $_POST["newemail"];
  $cnewemail = $_POST["cnewemail"];
  $username = $_SESSION["user"];

  $query = $conn->db->prepare("SELECT * FROM players WHERE username = '$username' AND email = '$oldemail'");
  $query->execute();
  if ($query->rowCount() > 0) {
    if ($newemail != $cnewemail) {
      $response["status"] = 0;
      $response["message"] = "Email doesn't match!";
    } else {
      $sql = $conn->db->prepare("UPDATE players SET email = '$newemail' WHERE username = '$username' AND email = '$oldemail'");
      $sql2 = $conn->db->prepare("UPDATE vouchers SET email = '$newemail' WHERE username = '$username'");
      if ($sql->execute() && $sql2->execute()) {
        $response["status"] = 1;
        $response["message"] = "Email has been changed!";
      } else {
        $response["status"] = 0;
        $response["message"] = "Something wen't wrong!";
      }
    }
  } else {
    $response["status"] = 0;
    $response["message"] = "Wrong email!";
  }
}

die(json_encode($response));