<?php
require_once('koneksi.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

<?php
try {
    if(isset($_GET['id_pembayaran'])){
        $sql = "DELETE FROM pembayaran WHERE id_pembayaran=" . $_GET['id_pembayaran'];

        if ($koneksi->query($sql) === TRUE) {
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Data berhasil dihapus",
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "index.php?lihat=pembayaran/index";
                });
                </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Terjadi kesalahan saat menghapus data",
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "index.php?lihat=pembayaran/index";
                });
                </script>';
        }
    } else {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Parameter tidak valid",
                showConfirmButton: true,
            }).then(function() {
                window.location.href = "index.php?lihat=pembayaran/index";
            });
            </script>';
    }
} catch (Exception $error) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Terjadi kesalahan saat menghapus data",
            showConfirmButton: true,
        }).then(function() {
            window.location.href = "index.php?lihat=pembayaran/index";
        });
        </script>';
}
?>

</body>

</html>
