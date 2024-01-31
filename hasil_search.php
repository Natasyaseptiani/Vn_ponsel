<?php
// Sertakan file koneksi.php
include "admin/koneksi.php";

// Tangani permintaan pencarian jika formulir dikirimkan
if (isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];

    // Query pencarian
    $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$searchTerm%'";

    // Eksekusi query
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Hasil Pencarian</title>
</head>

<body>
    <!-- navbar -->
    <?php include "components/navbar.php" ?>
    <!-- end navbar -->

    <section>
        <div class="main-menu">
            <div class="container">
                <h4 class="subtitle">Hasil Pencarian</h4>
                <div class="row">
                    <div class="products" id="wrapper">
                        <?php if (isset($result)) : ?>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    echo '<div class="box" onClick="myPage(\'' . $row['id'] . '\')">';
                                    echo '  <div class="images">';
                                    echo '    <img class="thumnbail" src="' . $row['url_gambar'] . '">';
                                    echo '  </div>';
                                    echo '  <div class="content">';
                                    echo '    <h5 class="nama">' . $row['nama_produk'] . '</h5>';
                                    echo '    <p>Mulai</p>';
                                    echo '<h3>Rp ' . number_format($row['harga_produk'], 0, ',', '.') . '</h3>';
                                    echo '  </div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<tr><td colspan="2">Produk tidak ditemukan</td></tr>';
                            }
                            ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- navbar -->
    <?php include "components/footer.php" ?>
    <!-- end navbar -->
    <script>
        function myPage(page) {
            window.location.href = '/page/produk.php?id=' + page;
        }
    </script>
</body>

</html>