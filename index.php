<?php
include "session.php";

// Cek apakah session admin_id dan username sudah ada
if (isset($_SESSION["admin_id"]) && isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
