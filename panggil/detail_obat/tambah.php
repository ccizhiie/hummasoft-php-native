<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Detail Obat</title>
    <!-- Mengimpor CSS Tailwind dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow">
            <div class="p-4">
                <h3 class="text-primary text-2xl font-bold">Tambah Data Detail Obat</h3>
                <hr class="border-t border-gray-300">
                <form action="" method="POST" class="mt-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="id_inap">Id Inap</label>
                        <!-- Drop-down untuk memilih Id Inap -->
                        <select class="form-select block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="id_inap">
                            <?php
                            // Koneksi ke database
                            $con = mysqli_connect("localhost", "root", "", "rumah_sakit");
                            // Mengambil data Id Inap dari database dan menampilkan dalam drop-down
                            $result = mysqli_query($con, "SELECT * FROM inap ORDER BY id_inap");
                            echo "<option disabled selected>--Pilih Id Inap--</option>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=$row[id_inap]>$row[id_inap]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="id_obat">Nama Obat</label>
                        <!-- Drop-down untuk memilih Nama Obat -->
                        <select class="form-select block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="id_obat">
                            <?php
                            // Koneksi ke database
                            $con = mysqli_connect("localhost", "root", "", "rumah_sakit");
                            // Mengambil data Nama Obat dari database dan menampilkan dalam drop-down
                            $result = mysqli_query($con, "SELECT * FROM obat ORDER BY id_obat");
                            echo "<option disabled selected>--Pilih Nama Obat--</option>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=$row[id_obat]>$row[nama_obat]</option>";
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
    </div>

    <?php
    // Memanggil file koneksi database
    require_once('koneksi.php');

    if ($_POST) {
        try {
            // Menuliskan query untuk menambahkan data
            $sql = "INSERT INTO detail_obat (id_detail, id_inap, id_obat) VALUES ('" . $_POST['id_detail'] . "','" . $_POST['id_inap'] . "','" . $_POST['id_obat'] . "')";

            // Mengeksekusi query dan memeriksa kesalahan
            if (!$koneksi->query($sql)) {
                echo $koneksi->error;
                die();
            }
        }
        // Menangani kesalahan
        catch (Exception $error) {
            echo $error;
            die();
        }

        // Mengarahkan ke halaman lain setelah berhasil menambahkan data
        echo "<script>
                window.location.href='index.php?lihat=detail_obat/index';
              </script>";
    }
    ?>
</body>
</html>
