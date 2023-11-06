<?php
require_once('koneksi.php');

try {
    $id_inap = $_GET['id_inap'];

    // Pengecekan apakah data masih digunakan sebelum dihapus
    $checkQuery = "SELECT * FROM obat WHERE id_inap = $id_inap";
    $result = $koneksi->query($checkQuery);

    if ($result->num_rows > 0) {
        // Menampilkan SweetAlert jika data masih digunakan
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Data masih digunakan',
                text: 'Data ini masih digunakan dan tidak dapat dihapus.',
            }).then((result) => {
                window.location.href = 'index.php?lihat=inap/index';
            });
        </script>";
        die();
    }

    // Membuat query SQL untuk menghapus data Rawat Inap berdasarkan id_inap yang diterima dari parameter GET
    $deleteQuery = "DELETE FROM inap WHERE id_inap = $id_inap";

    // Mengeksekusi query penghapusan data
    $koneksi->query($deleteQuery);

    // Menggunakan SweetAlert untuk memberikan konfirmasi bahwa data berhasil dihapus
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Data berhasil dihapus',
            text: 'Data Rawat Inap berhasil dihapus.'
        }).then((result) => {
            window.location.href = 'index.php?lihat=inap/index';
        });
    </script>";
} catch (Exception $error) {
    // Menangani kesalahan jika terjadi error
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Terjadi kesalahan',
            text: 'Terjadi kesalahan saat menghapus data: {$error->getMessage()}'
        }).then((result) => {
            window.location.href = 'index.php?lihat=inap/index';
        });
    </script>";
    die();
}
?>
