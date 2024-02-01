<?php
// Sertakan file koneksi.php
include "koneksi.php";

// Tangani permintaan POST dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $nama = $_POST['nama'];
    $nama_barang = $_POST['nama_barang'];
    $keluhan = $_POST['keluhan'];
    $nomorHp = $_POST['nomorHp'];
    $tipe = $_POST['tipe'];
    $sts_service = $_POST['sts_service'];

    // Query untuk menyimpan data ke dalam tabel history_service
    $query = "INSERT INTO history_service (nama, nama_barang, keluhan, nomorHp, tipe, sts_service) 
              VALUES ('$nama', '$nama_barang', '$keluhan', '$nomorHp', '$tipe', '$sts_service')";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
} else {
    // Tangani jika bukan permintaan POST
    echo "Metode permintaan tidak valid.";
}
