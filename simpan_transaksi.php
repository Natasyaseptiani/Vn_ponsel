<?php
// Sertakan file koneksi.php
include('koneksi.php');

// Ambil data dari permintaan AJAX
$nama = $_POST['nama'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$nomorHp = $_POST['nomorHp'];
$namaBarang = $_POST['namaBarang'];
$catatan = $_POST['catatan'];

// Query SQL untuk menyimpan data ke dalam tabel history_transaksi
$query = "INSERT INTO history_transaksi (nama_pelanggan, email_pelanggan, alamat_pengiriman, nomor_hp, nama_barang, catatan) VALUES ('$nama', '$email', '$alamat', '$nomorHp', '$namaBarang', '$catatan')";

if ($conn->query($query) === TRUE) {
    echo "Data transaksi berhasil disimpan.";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

// Tutup koneksi ke database
$conn->close();
