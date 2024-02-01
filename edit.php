<?php
include "session.php";
include "koneksi.php";

$sqlProduk = "SELECT id, nama_produk FROM produk";
$resultProduk = $conn->query($sqlProduk);
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ample Admin Lite Template by WrapPixel</title>
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <link href="css/style.min.css" rel="stylesheet">
    <link id="nordvpn-contentScript-extension-fonts" rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato">
</head>
<body>
    <div class="preloader" style="display: none;">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="mini-sidebar" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white" href="javascript:void(0)">
                                <i class="ti-menu ti-close"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle">
                                <span class="text-white font-medium">Admin</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php include './components/sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="container mt-5">
                <h3 class="mb-4">List Produk</h3>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Nama Produk</th>
                                <th class="border-top-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultProduk->num_rows > 0) {
                                $i = 1;
                                while ($rowProduk = $resultProduk->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $i . '</td>';
                                    echo '<td>' . $rowProduk['nama_produk'] . '</td>';
                                    echo '<td>';
                                    echo '<button class="btn btn-warning" onclick="showModal(' . $rowProduk['id'] . ', \'' . $rowProduk['nama_produk'] . '\')">Edit</button>';
                                    echo '</td>';
                                    echo '</tr>';
                                    $i++;
                                }
                            } else {
                                echo '<tr><td colspan="3">Tidak ada produk.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="editNamaProduk">Nama Produk</label>
                                    <input type="text" class="form-control" id="editNamaProduk">
                                </div>
                                <div class="form-group">
                                    <label for="editIdProduk">ID Produk</label>
                                    <input type="text" class="form-control" id="editIdProduk" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="editHargaProduk">Harga Produk</label>
                                    <input type="text" class="form-control" id="editHargaProduk">
                                </div>
                                <div class="form-group">
                                    <label for="editUrlGambar">URL Gambar</label>
                                    <input type="text" class="form-control" id="editUrlGambar">
                                </div>
                                <div class="form-group">
                                    <label for="editDeskripsiProduk">Deskripsi Produk</label>
                                    <textarea class="form-control" id="editDeskripsiProduk" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="editKategoriProduk">Kategori Produk</label>
                                    <select class="form-control" id="editKategoriProduk">
                                    <option value="apple">Apple</option>
                                    <option value="xiaomi">Xiaomi</option>
                                    <option value="oppo">Oppo</option>
                                    <option value="vivo">Vivo</option>
                                    <option value="huawei">Huawei</option>
                                    <option value="samsung">Samsung</option>
                                    <option value="advan">Advan</option>
                                    <option value="nokia">Nokia</option>
                                    </select>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="deleteAndInsertData()">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
            <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <script src="js/app-style-switcher.js"></script>
            <script src="js/waves.js"></script>
            <script src="js/sidebarmenu.js"></script>
            <script src="js/custom.js"></script>
            <script>
function showModal(id, namaProduk) {
    // Mengambil data produk dari server berdasarkan ID
    $.ajax({
        url: 'api.php',
        type: 'GET',
        data: {
            id: id,
            apikey: 'bWFrbG9nYW1pbmdzcXVhZGFuamppcmxhaGhoaGg=',
            tabel: 'produk'
        },
        success: function (response) {
            var data = JSON.parse(response);
            if (data.length > 0) {
                $('#editIdProduk').val(data[0].id);
                $('#editNamaProduk').val(data[0].nama_produk);
                $('#editHargaProduk').val(data[0].harga_produk);
                $('#editUrlGambar').val(data[0].url_gambar);
                $('#editDeskripsiProduk').val(data[0].deskripsi_produk);
                $('#editKategoriProduk').val(data[0].kategori_produk);
            } else {
                alert('Data produk tidak ditemukan.');
            }
        },
        error: function () {
            alert('Terjadi kesalahan saat mengambil data produk.');
        }
    });

    $('#editModal').modal('show');
}
function deleteAndInsertData(id) {
    // Mendapatkan data dari formulir modal
    var namaProduk = $('#editNamaProduk').val();
    var hargaProduk = $('#editHargaProduk').val();
    var urlGambar = $('#editUrlGambar').val();
    var deskripsiProduk = $('#editDeskripsiProduk').val();
    var kategoriProduk = $('#editKategoriProduk').val();
    var apikey = 'bWFrbG9nYW1pbmdzcXVhZGFuamppcmxhaGhoaGg=';
    var tabel = 'produk';

    // Menghapus data lama dengan metode DELETE
    var xhr = new XMLHttpRequest();
    xhr.open("DELETE", "api.php?id=" + id + "&tabel=" + tabel + "&apikey=" + apikey, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                alert(response.message);

                // Jika penghapusan berhasil, tambahkan data baru dengan metode POST
                $.ajax({
                    url: 'api.php',
                    type: 'POST',
                    data: {
                        nama_produk: namaProduk,
                        harga_produk: hargaProduk,
                        url_gambar: urlGambar,
                        deskripsi_produk: deskripsiProduk,
                        kategori_produk: kategoriProduk,
                        apikey: apikey,
                        tabel: tabel
                    },
                    success: function (response) {
                        var responseObj = JSON.parse(response);
                        alert(responseObj.message);
                        $('#editModal').modal('hide');
                        location.reload();
                    },
                    error: function () {
                        alert('Terjadi kesalahan saat memasukkan data baru.');
                    }
                });
            } else {
                alert('Terjadi kesalahan saat menghapus data lama.');
            }
        }
    };
    xhr.send();
}



            </script>
        </body>
        </html>
