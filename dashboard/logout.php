<?php
session_start();
$_SESSION["user"] = '';
$_SESSION["email"] = '';
if (isset($_SESSION["admin"])) {
    $_SESSION["admin"] = '';
    unset($_SESSION["admin"]);
}
unset($_SESSION["user"]);
unset($_SESSION["email"]);
session_unset();
session_destroy();
header("Location: ../login");