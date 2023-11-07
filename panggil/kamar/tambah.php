<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Kamar</title>
    <!-- Tambahkan stylesheet Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <div class="relative rounded-md shadow-sm">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3"></span>
                    <input type="number" class="form-input pl-10 block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="harga" required>
                </div>
            </div>
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md" id="submit-button">
                <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
            </button>
        </form>
    </div>
</div>
<?php
if ($_POST) {
    try {
        // Menuliskan query untuk memeriksa apakah data sudah ada sebelumnya
        $checkQuery = "SELECT COUNT(*) as total FROM kamar WHERE id_kamar='" . $_POST['id_kamar'] . "'";
        $checkResult = $koneksi->query($checkQuery);
        $checkData = $checkResult->fetch_assoc();
        
        if ($checkData['total'] > 0) {
            // Jika data sudah ada, tampilkan pesan menggunakan SweetAlert
            echo "<script>
                Swal.fire({
                    title: 'Data tidak boleh sama',
                    text: 'Data dengan ID Kamar tersebut sudah ada',
                    icon: 'error',
                    confirmButtonColor: '#EF4444',
                    confirmButtonText: 'OK'
                });
            </script>";
        } else {
            // Jika data belum ada, eksekusi query INSERT
            $sql = "INSERT INTO kamar (id_kamar, nama_kamar, kelas, kapasitas, harga) VALUES ('" . $_POST['id_kamar'] . "','" . $_POST['nama_kamar'] . "','" . $_POST['kelas'] . "','" . $_POST['kapasitas'] . "','" . $_POST['harga'] . "')";

            // Cek jika query salah
            if (!$koneksi->query($sql)) {
                echo $koneksi->error;
                die();
            }

            // Tambahkan SweetAlert untuk notifikasi berhasil
            echo "<script>
                Swal.fire({
                    title: 'Data berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonColor: '#10B981',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href='index.php?lihat=kamar/index';
                });
            </script>";
        }
    }
    // Cek jika terjadi error
    catch (Exception $error) {
        echo $error;
        die();
    }
}
?>
</body>
</html>