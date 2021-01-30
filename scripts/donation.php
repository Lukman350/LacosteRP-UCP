<?php
session_start();
include_once "../db/db.php";
$conn = new Database;

$response = [];

$sender = $_POST["name"];
$type = $_POST["type"];
$time = (is_numeric($_POST["time"]) ? $_POST["time"] : '');
$duration = (is_numeric($_POST["time"]) ? $_POST["time"] : '');
$money = $_POST["money"];
$payment = $_POST["payment"];
$proof = $_POST["proof"];
$note = $_POST["note"];
$email = $_SESSION["email"];
$username = $_SESSION["user"];
$gold = $_POST["gold"];

$query = $conn->db->prepare("INSERT INTO vouchers (vip,vip_time,gold,duration,sender,nominal,payment,bukti,note,email,username) VALUES ('$type','$time','$gold','$duration','$sender','$money','$payment','$proof','$note','$email','$username')");
if ($query->execute()) {
  $response["status"] = 1;
  $response["message"] = "Request giftcode successfully send! Please wait an Admin to accept your request.";
} else {
  $response["status"] = 0;
  $response["message"] = "Request was not send!";
}

die(json_encode($response));
