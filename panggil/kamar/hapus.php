<?php
require_once('koneksi.php');

try {
    $sql = "DELETE FROM kamar WHERE id_kamar=" . $_GET['id_kamar'];

    $koneksi->query($sql);
} catch (Exception $error) {
    echo "<script>
                alert('Data masih digunakan dan tidak dapat dihapus');
                window.location.href = 'index.php?lihat=kamar/index';
            </script>";
}

echo "<script>
        window.location.href='index.php?lihat=kamar/index';
    </script>";
?>
