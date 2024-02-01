<?php
include "koneksi.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $password = base64_encode($password);

    // Validasi login di sini
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Login berhasil
        $row = $result->fetch_assoc();
        $_SESSION["admin_id"] = $row["id"];
        $_SESSION["username"] = $row["username"];

        header("Location: ./dashboard.php?pesan=Login Berhasil");
         exit();
    } else {
        // Login gagal
        
        header("Location: ./login.php?pesan=Login Gagal"); // Redirect kembali ke halaman login
        exit();
    }
}

// Tutup koneksi database
$conn->close();
?>
