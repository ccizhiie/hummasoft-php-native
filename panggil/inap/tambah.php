<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Rawat Inap</title>
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
    <div class="bg-blue rounded-lg shadow p-4">
        <h3 class="text-primary text-2xl font-bold">Tambah Data Rawat Inap</h3>
        <hr class="border-t border-gray-300">
        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Pasien</label>
                <!-- Dropdown untuk memilih Nama Pasien -->
                <select class="form-select block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="id_pasien">
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "rumah_sakit");
                    $result = mysqli_query($con, "SELECT * FROM pasien ORDER BY id_pasien");
                    echo "<option disabled selected>--Pilih nama pasien--</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=$row[id_pasien]>$row[nama_pasien]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Masuk</label>
                <!-- Input untuk memasukkan Tanggal Masuk -->
                <input type="date" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="tgl_masuk" id="tgl_masuk" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Keluar</label>
                <!-- Input untuk memasukkan Tanggal Keluar -->
                <input type="date" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="tgl_keluar">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Kamar</label>
                <!-- Dropdown untuk memilih Nama Kamar -->
                <select class="form-select block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="id_kamar">
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "rumah_sakit");
                    $result = mysqli_query($con, "SELECT * FROM kamar ORDER BY id_kamar");
                    echo "<option disabled selected>--Pilih nama kamar--</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=$row[id_kamar]>$row[nama_kamar]</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">
                <span class="glyphicon glyphicon-floppy-disk"></span> Simpan
            </button>
        </form>
    </div>
</div>

<script>
function validateForm() {
    var tglMasuk = document.getElementById('tgl_masuk').value;
    if (tglMasuk === '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Tanggal masuk harus diisi!'
        });
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}
</script>

<?php
if ($_POST) {
    try {
        // ...
        // Sisanya dari kode PHP Anda
    } catch (Exception $error) {
        echo $error;
        die();
    }
}
?>
</body>
</html>
