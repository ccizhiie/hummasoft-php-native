<?php
require_once('koneksi.php');

try {
    $sql = "DELETE FROM pasien WHERE id_pasien=" . $_GET['id_pasien'];

    $koneksi->query($sql);

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: 'Data berhasil dihapus',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href='index.php?lihat=pasien/index';
            }
        });
    </script>";
} catch (Exception $error) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Data masih digunakan!',
        }).then(() => {
            window.location.href='index.php?lihat=pasien/index';
        });
    </script>";
    die();
}
?>
