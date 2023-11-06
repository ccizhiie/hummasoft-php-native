    <?php
    // Memanggil file koneksi database
    require_once('koneksi.php');

    try {
        $id_inap = $_GET['id_inap'];

        // Pengecekan apakah data masih digunakan sebelum dihapus
        $checkQuery = "SELECT * FROM oba WHERE id_inap = $id_inap";
        $result = $koneksi->query($checkQuery);

        if ($result->num_rows > 0) {
            // Menampilkan alert jika data masih digunakan
            echo "<script>
                    alert('Data masih digunakan dan tidak dapat dihapus');
                    window.location.href = 'index.php?lihat=inap/index';
                </script>";
            die();
        }

        // Membuat query SQL untuk menghapus data Rawat Inap berdasarkan id_inap yang diterima dari parameter GET
        $deleteQuery = "DELETE FROM inap WHERE id_inap = $id_inap";

        // Mengeksekusi query penghapusan data
        $koneksi->query($deleteQuery);

        // Mengarahkan pengguna ke halaman lain setelah berhasil menghapus data
        echo "<script>
                alert('Data berhasil dihapus');
                window.location.href = 'index.php?lihat=inap/index';
            </script>";
    } catch (Exception $error) {
        // Menangani kesalahan jika terjadi error
        echo "<script>
                alert('Terjadi kesalahan saat menghapus data');
                window.location.href = 'index.php?lihat=inap/index';
            </script>";
        die();
    }
    ?>z