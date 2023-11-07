<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Rawat Inap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<?php
require_once('koneksi.php');

if (isset($_GET['id_inap'])) {
    $id_inap = $_GET['id_inap'];

    // Cek apakah data masih digunakan
    $checkQuery = "SELECT COUNT(*) as count FROM inap WHERE id_inap = $id_inap";
    $result = $koneksi->query($checkQuery);
    $row = $result->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
        // Data masih digunakan, tampilkan pesan kesalahan
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Data masih digunakan!',
                text: 'Data ini masih digunakan dan tidak dapat diedit dan dihapus.',
            }).then((result) => {
                window.location.href = 'index.php?lihat=inap/index';
            });
        </script>";
    } else {
        // Data tidak digunakan, maka bisa dihapus
        $sql = "DELETE FROM inap WHERE id_inap = $id_inap";
        
        if ($koneksi->query($sql) === TRUE) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil dihapus',
                    text: 'Data Rawat Inap berhasil dihapus.',
                }).then((result) => {
                    window.location.href = 'index.php?lihat=inap/index';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menghapus data',
                    text: 'Gagal menghapus data Rawat Inap: " . $koneksi->error . "',
                }).then((result) => {
                    window.location.href = 'index.php?lihat=inap/index';
                });
            </script>";
        }
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ID Rawat Inap tidak valid',
            text: 'ID Rawat Inap tidak ditemukan.',
        }).then((result) => {
            window.location.href = 'index.php?lihat=inap/index';
        });
    </script>";
}
?>

                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="tgl_masuk">Tanggal Masuk</label>
                    <input type="date" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="tgl_masuk" id="tgl_masuk" required>
            
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="tgl_keluar">Tanggal Keluar</label>
                    <input type="date" class="form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200" name="tgl_keluar">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="id_kamar">Id Kamar</label>
                    <select class="form-select block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200"
                        name="id_kamar" value="<?= $data->id_kamar ?>">
                        <?php
                        $con = mysqli_connect("localhost", "root", "", "rumah_sakit");
                        $result = mysqli_query($con, "SELECT * FROM kamar ORDER BY id_kamar");
                        echo "<option>--Pilih nama kamar--</option>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=$row[id_kamar]>$row[id_kamar]</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">
                    <!-- Tombol untuk mengirimkan form -->
                    <span class="glyphicon glyphicon-pencil"></span> Ubah
                </button>
            </form>
        </div>
    </div>
</body>
</html>
