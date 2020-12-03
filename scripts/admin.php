<?php
session_start();
include_once "../db/db.php";
$conn = new Database;

$response = [];

// Accepted
if (isset($_POST["ids"])) {
  $code = rand(10000,99999);
  $ids = intval($_POST["ids"]);
  $admin = $_SESSION["admin"];
  $query = $conn->db->prepare("SELECT * FROM vouchers WHERE id = '$ids'");
  $query->execute();
  if ($query->rowCount() > 0) {
    $sql = $conn->db->prepare("UPDATE vouchers SET status = 1, code = $code, admin = '$admin' WHERE id = $ids");
    if($sql->execute()) {
      $response["status"] = 1;
      $response["message"] = "Request id $ids has been successfully accepted!";
    } else {
      $response["status"] = 0;
      $response["message"] = "Something wen't wrong!";
    }
  } else {
    $response["status"] = 0;
    $response["message"] = "Id was not found!";
  }
}

// denied
if (isset($_POST["id"])) {
  $id = intval($_POST["id"]);
  $admin = $_SESSION["admin"];

  $query = $conn->db->prepare("SELECT * FROM vouchers WHERE id = $id");
  $query->execute();
  if ($query->rowCount() > 0) {
    $sql = $conn->db->prepare("UPDATE vouchers SET status = 2, admin = '$admin' WHERE id = $id");
    if ($sql->execute()) {
      $response["status"] = 1;
      $response["message"] = "Request id $id has been successfully denied!";
    } else {
      $response["status"] = 0;
      $response["message"] = "Something wen't wrong!";
    }
  } else {
    $response["status"] = 0;
    $response["message"] = "Id was not found!";
  }
}

die(json_encode($response));