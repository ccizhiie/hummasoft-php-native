<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Rawat Inap</title>
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
        <h3 class="text-primary text-2xl font-bold">Tambah Data Rawat Inap</h3>
        <hr class="border-t border-gray-300">
        <form action="" method="POST">
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
                <input type="date" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="tgl_masuk" required>
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

<?php
if ($_POST) {
    try {
        $date1 = $_POST['tgl_masuk'];
        $date2 = $_POST['tgl_keluar'];
        $lama = ((abs(strtotime($date2) - strtotime($date1))) / (60 * 60 * 24));

        // Menuliskan query tambah
        $sql = "INSERT INTO inap (id_inap, tgl_masuk, tgl_keluar, lama, id_pasien, id_kamar) VALUES ('" . $_POST['id_inap'] . "','" . $_POST['tgl_masuk'] . "','" . $_POST['tgl_keluar'] . "','" . $lama . "','" . $_POST['id_pasien'] . "','" . $_POST['id_kamar'] . ')';

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
			window.location.href='index.php?lihat=inap/index';
		  </script>";
}
?>
</body>
</html>
