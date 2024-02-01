<?php
include "session.php";
include "koneksi.php";

// Ambil data produk dari tabel
$sqlProduk = "SELECT id, nama_produk FROM produk";
$resultProduk = $conn->query($sqlProduk);

// Ambil api_key dari tabel admin
$query = "SELECT api_key FROM admin";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $api_key = $row["api_key"];
} else {
    // Jika tidak ada api_key, Anda perlu menangani kasus ini sesuai kebutuhan
    die("Error: Tidak dapat mengambil api_key");
}

// Tutup koneksi database
$conn->close();

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <?php include "./components/head.php"?>
  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader" style="display: none;">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin6">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)">
              <i class="ti-menu ti-close"></i>
            </a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav d-none d-md-block d-lg-none">
              <li class="nav-item">
                <a class="nav-toggler nav-link waves-effect waves-light text-white" href="javascript:void(0)">
                  <i class="ti-menu ti-close"></i>
                </a>
              </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">
              <!-- ============================================================== -->
              <!-- Search -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              <li>
                <a class="profile-pic" href="#">
                  <img src="plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle">
                  <span class="text-white font-medium">Admin</span>
                </a>
              </li>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- sidebar -->
      <?php
        include './components/sidebar.php';
      ?>
      <!-- end sidebar -->
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <!-- Row -->
          <div class="row">
            <!-- Column -->
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-12 col-xlg-9 col-md-12">
              <div class="card">
                <div class="card-body">
                  <form class="form-horizontal form-material" method="delete" action="api.php">
                    <div class="form-group mb-4">
                      <label class="col-sm-12">Pilih produk yang ingin dihapus</label>
                      <div class="col-sm-12 border-bottom">
                        <select id="produkSelect" class="form-select shadow-none p-0 border-0 form-control-line" required> <?php
            if ($resultProduk->num_rows > 0) {
                while ($rowProduk = $resultProduk->fetch_assoc()) {
                    echo '
																								<option value="' . $rowProduk['id'] . '">' . $rowProduk['nama_produk'] . '</option>';
                }
            } else {
                echo '
																								<option value="" disabled>No products available</option>';
            }
            ?> </select>
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <input type="hidden" id="apikey" value="
																							<?=$api_key?>">
                      <input type="hidden" id="tabel" value="produk">
                      <div class="col-sm-12">
                        <button type="button" class="btn btn-danger" onclick="deleteProduct()">Hapus Produk</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Column -->
          </div>
          <!-- Row -->
          <!-- ============================================================== -->
          <!-- End PAge Content -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Right sidebar -->
          <!-- ============================================================== -->
          <!-- .right-sidebar -->
          <!-- ============================================================== -->
          <!-- End Right sidebar -->
          <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <script>
      function deleteProduct() {
        var id = document.getElementById("produkSelect").value;
        var apikey = document.getElementById("apikey").value;
        var tabel = document.getElementById("tabel").value;
        if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
          // Gunakan curl atau metode pengiriman HTTP lainnya untuk mengirim permintaan DELETE
          var xhr = new XMLHttpRequest();
          xhr.open("DELETE", "api.php?id=" + id + "&tabel=" + tabel + "&apikey=" + apikey, true);
          xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
              var response = JSON.parse(xhr.responseText);
              alert(response.message);

            }else{
                alert('Terjadi kesalahan, ulangi kembali?');
            }
          };
          xhr.send();
        }
        location.reload();
      }
    </script>
  </body>
  <nordvpn-contentscript-extension-mount-3.6.0></nordvpn-contentscript-extension-mount-3.6.0>
</html>