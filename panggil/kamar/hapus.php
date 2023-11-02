<?php
require_once('koneksi.php');

try {
    // Menyusun pernyataan SQL DELETE berdasarkan 'id_kamar' yang diterima melalui parameter GET
    $sql = "DELETE FROM kamar WHERE id_kamar=" . $_GET['id_kamar'];

    // Menjalankan pernyataan SQL DELETE
    $koneksi->query($sql);
} catch (Exception  ) {
    echo "<script>
    window.location.href='index.php?lihat=kamar/index';
</script>";
    // Menangani pengecualian jika terjadi kesalahan
   
    die(); // Menghentikan eksekusi skrip
}

// Mengarahkan pengguna kembali ke halaman "index.php?lihat=kamar/index" setelah data Kamar dihapus

?>
