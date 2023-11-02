<!DOCTYPE html>
<html>
<head>
    <!-- Menetapkan judul halaman -->
    <title>Edit Data Detail Obat</title>
    <!-- Mengimpor CSS Tailwind dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<?php
    // Mengimpor file koneksi database
    require_once('koneksi.php');

    // Memeriksa apakah ada permintaan POST (data dikirimkan saat form disubmit)
    if ($_POST) {
        // Membangun pernyataan SQL UPDATE berdasarkan data yang dikirimkan melalui form
        $sql = "UPDATE detail_obat SET id_inap='" . $_POST['id_inap'] . "', id_obat='" . $_POST['id_obat'] . "' WHERE id_detail=" . $_POST['id_detail'];

        // Menjalankan pernyataan SQL di atas
        if ($koneksi->query($sql) === TRUE) {
            // Jika berhasil, maka arahkan ke halaman lain
            echo "<script>
                window.location.href='index.php?lihat=detail_obat/index';
            </script>";
        } else {
            // Jika gagal, tampilkan pesan kesalahan
            echo "Gagal: " . $koneksi->error;
        }

        // Tutup koneksi ke database
        $koneksi->close();
    } else {
        // Jika tidak ada permintaan POST, maka ambil data yang akan diubah dari database
        $query = $koneksi->query("SELECT * FROM detail_obat WHERE id_detail=" . $_GET['id_detail']);

        // Periksa apakah data ditemukan
        if ($query->num_rows > 0) {
            $data = mysqli_fetch_object($query);
        } else {
            // Jika data tidak ditemukan, tampilkan pesan dan hentikan eksekusi
            echo "Data tidak tersedia";
            die();
        }
    }
?>
<div class="container mx-auto p-4">
    <div class="w-1/2 mx-auto bg-white rounded-lg shadow">
        <h3 class="text-primary text-center text-2xl font-bold p-4">Edit Data Detail Obat</h3>
        <hr class="border-t border-gray-300">
        <!-- Form untuk mengubah data -->
        <form action="" method="POST" class="p-4">
            <!-- Input tersembunyi untuk id_detail -->
            <input type="hidden" name="id_detail" value="<?= $data->id_detail ?>">
            <div class="mb-4">
                <label class="block font-bold">Id Inap:</label>
                <!-- Pilihan Id Inap -->
                <select class="form-select border border-gray-300 p-2 rounded-md" name="id_inap">
                    <?php
                    // Koneksi database
                    $con = mysqli_connect("localhost", "root", "", "rumah_sakit");
                    // Mengambil data Id Inap dari database
                    $result = mysqli_query($con, "SELECT * FROM inap ORDER BY id_inap");
                    echo "<option>-- Pilih ID Inap --</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Menandai opsi yang cocok dengan data yang sudah ada
                        $selected = ($row['id_inap'] == $data->id_inap) ? 'selected' : '';
                        echo "<option value='$row[id_inap]' $selected>$row[id_inap]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-bold">Nama Obat:</label>
                <!-- Pilihan Nama Obat -->
                <select class="form-select border border-gray-300 p-2 rounded-md" name="id_obat">
                    <?php
                    // Koneksi database
                    $con = mysqli_connect("localhost", "root", "", "rumah_sakit");
                    // Mengambil data Nama Obat dari database
                    $result = mysqli_query($con, "SELECT * FROM obat ORDER BY id_obat");
                    echo "<option>-- Pilih Nama Obat --</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Menandai opsi yang cocok dengan data yang sudah ada
                        $selected = ($row['id_obat'] == $data->id_obat) ? 'selected' : '';
                        echo "<option value='$row[id_obat]' $selected>$row[nama_obat]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">
                    <span class="glyphicon glyphicon-pencil"></span> Ubah
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
