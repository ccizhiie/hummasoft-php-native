<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Kamar</title>
    <!-- Tambahkan stylesheet Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<?php
    // Menghilangkan pesan error yang mungkin muncul
    error_reporting(0);
    require_once('koneksi.php');
?>
<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-primary text-2xl font-bold">Tambah Data Kamar</h3>
        <hr class="border-t border-gray-300">
        <form action="" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">ID Kamar</label>
                <!-- Input untuk memasukkan ID Kamar -->
                <input type="text" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="id_kamar" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Kamar</label>
                <!-- Input untuk memasukkan Nama Kamar -->
                <input type="text" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="nama_kamar" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kelas Kamar</label>
                <!-- Input untuk memasukkan Kelas Kamar -->
                <input type="text" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="kelas" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kapasitas</label>
                <!-- Input untuk memasukkan Kapasitas -->
                <input type="number" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="kapasitas" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Harga</label>
                <!-- Input untuk memasukkan Harga -->
                <input type="number" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="harga" required>
            </div>
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">
                <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
            </button>
        </form>
    </div>
</div>
<?php
if ($_POST) {
    try {
        // Menuliskan query tambah
        $sql = "INSERT INTO kamar (id_kamar, nama_kamar, kelas, kapasitas, harga) VALUES ('" . $_POST['id_kamar'] . "','" . $_POST['nama_kamar'] . "','" . $_POST['kelas'] . "','" . $_POST['kapasitas'] . "','" . $_POST['harga'] . "')";

        // Cek jika query salah
        if (!$koneksi->query($sql)) {
            echo $koneksi->error;
            die();
        }
    }
    // Cek jika terjadi error
    catch (Exception $error) {
        echo $error;
        die();
    }

    echo "<script>
        window.location.href='index.php?lihat=kamar/index';
      </script>";
}
?>
</body>
</html>
