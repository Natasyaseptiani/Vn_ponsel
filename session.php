<?php
session_start();

if (!isset($_SESSION["admin_id"]) || !isset($_SESSION["username"])) {
    header("Location: login.php"); 
    exit();
}
?>
