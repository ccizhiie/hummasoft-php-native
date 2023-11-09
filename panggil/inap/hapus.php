<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<?php
    // Memanggil file koneksi database
    require_once('koneksi.php');

    try {
        $id_inap = $_GET['id_inap'];

        // Pengecekan apakah data masih digunakan sebelum dihapus
        $checkQuery = "SELECT * FROM oba WHERE id_inap = $id_inap";
        $result = $koneksi->query($checkQuery);

        if ($result->num_rows > 0) {
            // Menampilkan SweetAlert jika data masih digunakan
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data masih digunakan dan tidak dapat dihapus'
                    }).then(function() {
                        window.location.href = 'index.php?lihat=inap/index';
                    });
                </script>";
            die();
        }

        // Membuat query SQL untuk menghapus data Rawat Inap berdasarkan id_inap yang diterima dari parameter GET
        $deleteQuery = "DELETE FROM inap WHERE id_inap = $id_inap";

        // Mengeksekusi query penghapusan data
        $koneksi->query($deleteQuery);

        // Menampilkan SweetAlert setelah berhasil menghapus data
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Data berhasil dihapus'
                }).then(function() {
                    window.location.href = 'index.php?lihat=inap/index';
                });
            </script>";
    } catch (Exception $error) {
        // Menampilkan SweetAlert ketika terjadi kesalahan
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data Masih digunakan'
                }).then(function() {
                    window.location.href = 'index.php?lihat=inap/index';
                });
            </script>";
        die();
    }
?>
</body>
</html>