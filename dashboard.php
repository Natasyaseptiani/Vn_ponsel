<?php
include "session.php";
include "koneksi.php";

$mainDomain = $_SERVER['HTTP_HOST'];

$api_key = "bWFrbG9nYW1pbmdzcXVhZGFuamppcmxhaGhoaGg=";

?>

<?php
function getDataFromUrl($url) {
    $json = file_get_contents($url);
    return json_decode($json, true);
}

$jsonUrl = "http://$mainDomain/admin/api.php?apikey=bWFrbG9nYW1pbmdzcXVhZGFuamppcmxhaGhoaGg=&tabel=admin";

$data = getDataFromUrl($jsonUrl);

if ($data === null) {
    die("Gagal mendapatkan data.");
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php include "./components/head.php"?>
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

      <?php include './components/sidebar.php';?>

      <div class="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-xlg-9 col-md-12">
              <div class="card">
                <div class="card-body">
                  <form class="form-horizontal form-material" method="post" action="./api.php?apikey=<?=$api_key?>">
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Nama Produk</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" placeholder="ex: Xiaomi Poco M3 Pro 5G" class="form-control p-0 border-0" name="nama_produk" id="nama_produk" required>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="example-email" class="col-md-12 p-0">Harga Produk</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="number" placeholder="ex: 5400000 (tanpa titik)" class="form-control p-0 border-0" name="harga_produk" id="harga_produk" required>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">URL Gambar Produk (https://imgbb.com/)</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" placeholder="ex: https://site.com/gambar1.png" class="form-control p-0 border-0" name="url_gambar" id="url_gambar" required>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Deskripsi Produk</label>
                        <div class="col-md-12 border-bottom p-0">
                            <textarea rows="5" class="form-control p-0 border-0" name="deskripsi_produk" id="deskripsi_produk" required></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-sm-12">Kategori Produk</label>
                        <div class="col-sm-12 border-bottom">
                            <select class="form-select shadow-none p-0 border-0 form-control-line" name="kategori_produk" required>
                                <option value="apple">Apple</option>
                                <option value="xiaomi">Xiaomi</option>
                                <option value="oppo">Oppo</option>
                                <option value="vivo">Vivo</option>
                                <option value="huawei">Huawei</option>
                                <option value="samsung">Samsung</option>
                                <option value="advan">Advan</option>
                                <option value="nokia">Nokia</option>
                                <option value="lenovo">Lenovo</option>
                                <option value="asus">Asus</option>
                                <option value="acer">Acer</option>
                                <option value="advan">Advan</option>
                                <option value="razer">Razer</option>
                                <option value="msi">MSI</option>
                                <option value="alienware">Alienware</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="apikey" value="<?=$api_key?>">
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success" id="submit">Tambah Produk</button>
                        </div>
                    </div>
                </form>
                </div>
              </div>
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
        fetch('get_api_key.php').then(response => response.json()).then(data => {
          document.getElementById('api_key_input').value = data.api_key;
        }).catch(error => console.error('Error:', error));

        document.getElementById('submit').addEventListener('click', function() {
          var namaProduk = document.getElementById('nama_produk').value.trim();
          var hargaProduk = document.getElementById('harga_produk').value.trim();
          var urlGambar = document.getElementById('url_gambar').value.trim();
          var deskripsiProduk = document.getElementById('deskripsi_produk').value.trim();
          var kategoriProduk = document.getElementById('kategori_produk').value.trim();

          if (namaProduk === '' || hargaProduk === '' || urlGambar === '' || deskripsiProduk === '' || kategoriProduk === '') {
            alert('Semua kolom harus diisi!');
            return false; 
          }
        });
      </script>
    </body>
  </html>
