<?php
include "koneksi.php";

// Mendapatkan metode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Mendapatkan nilai parameter dari URL
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
$tabel = isset($_REQUEST['tabel']) ? $_REQUEST['tabel'] : null;
$apiKey = isset($_REQUEST['apikey']) ? $_REQUEST['apikey'] : null;

// Verifikasi API key
if ($apiKey === null) {
    echo json_encode(array('message' => 'Missing API key'));
    exit();
}

// Mencari API key di tabel admin
$sqlApiKey = "SELECT api_key FROM admin WHERE api_key = '$apiKey'";
$resultApiKey = $conn->query($sqlApiKey);

if ($resultApiKey->num_rows === 0) {
    echo json_encode(array('message' => 'Invalid API key'));
    exit(); // Menghentikan eksekusi script jika API key tidak valid
}

// Menangani permintaan sesuai metode
switch ($method) {
    case 'GET':
        // Menampilkan seluruh isi database dengan format JSON
        if ($id !== null && $tabel !== null){
            $sql = "SELECT * FROM $tabel WHERE id=$id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                echo json_encode($data);
            } else {
                echo json_encode(array('message' => 'Data not found'));
            }
        }else{
            if ($id === null && $tabel !== null) {
                $sql = "SELECT * FROM $tabel";
                $result = $conn->query($sql);
    
                if ($result->num_rows > 0) {
                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }
                    echo json_encode($data);
                } else {
                    echo json_encode(array('message' => 'Data not found'));
                }
            } else {
                echo json_encode(array('message' => 'Invalid request'));
            }
        }
        break;

    case 'POST':
        // Menambah data ke dalam tabel
        $nama_produk = isset($_POST['nama_produk']) ? $_POST['nama_produk'] : null;
        $harga_produk = isset($_POST['harga_produk']) ? $_POST['harga_produk'] : null;
        $url_gambar = isset($_POST['url_gambar']) ? $_POST['url_gambar'] : null;
        $deskripsi_produk = isset($_POST['deskripsi_produk']) ? $_POST['deskripsi_produk'] : null;
        $kategori_produk = isset($_POST['kategori_produk']) ? $_POST['kategori_produk'] : null;

        // Pastikan untuk memvalidasi dan membersihkan data sebelum memasukkan ke database
        // Contoh: $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);

        // Lakukan operasi INSERT sesuai dengan kebutuhan
        $sql = "INSERT INTO produk (nama_produk, harga_produk, url_gambar, deskripsi_produk, kategori_produk) 
                VALUES ('$nama_produk', '$harga_produk', '$url_gambar', '$deskripsi_produk', '$kategori_produk')";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(array('message' => 'Data added successfully'));
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo json_encode(array('message' => 'Error adding data: ' . $conn->error));
            }
            break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);

        // Mengedit data berdasarkan id dan tabel
        $nama_produk = isset($_PUT['nama_produk']);
        $harga_produk = isset($_PUT['harga_produk']);
        $url_gambar = isset($_PUT['url_gambar']);
        $deskripsi_produk = isset($_PUT['deskripsi_produk']);
        $kategori_produk = isset($_PUT['kategori_produk']);

        // Pastikan untuk memvalidasi dan membersihkan data sebelum mengupdate database
        // Contoh: $nama_produk = mysqli_real_escape_string($conn, $_PUT['nama_produk']);

        // Lakukan operasi UPDATE sesuai dengan kebutuhan
        $sql = "UPDATE produk 
                SET nama_produk='$nama_produk', harga_produk='$harga_produk', url_gambar='$url_gambar', 
                    deskripsi_produk='$deskripsi_produk', kategori_produk='$kategori_produk' 
                WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array('message' => 'Data updated successfully'));
            exit();
        } else {
            echo json_encode(array('message' => 'Error updating data: ' . $conn->error));
        }
        break;

    case 'DELETE':
        // Menghapus data berdasarkan id dan tabel
        if ($id !== null && $tabel !== null) {
            // Lakukan operasi DELETE sesuai dengan kebutuhan
            $sql = "DELETE FROM $tabel WHERE id='$id'";
            
            if ($conn->query($sql) === TRUE) {
                echo json_encode(array('message' => 'Data deleted successfully'));
                exit();
            } else {
                echo json_encode(array('message' => 'Error deleting data: ' . $conn->error));
            }
        } else {
            echo json_encode(array('message' => 'Invalid request'));
        }
        break;

    default:
        // Metode HTTP tidak didukung
        echo json_encode(array('message' => 'Unsupported request method'));
        break;
}

// Menutup koneksi database setelah selesai
$conn->close();
?>
