<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Rawat Inap</title>
    <!-- Tambahkan stylesheet Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Tambahkan library SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
require_once('koneksi.php');
if (isset($_GET['id_inap'])) {
    $id_inap = $_GET['id_inap'];
    
    if (isset($_POST['edit'])) {
        $tgl_masuk = $_POST['tgl_masuk'];
        $tgl_keluar = $_POST['tgl_keluar'];
        $id_kamar = $_POST['id_kamar'];
        $id_pasien = $_POST['id_pasien']; // Menambahkan pemilihan nama pasien
        
        $sql = "UPDATE inap SET tgl_masuk = '$tgl_masuk', tgl_keluar = '$tgl_keluar', id_kamar = $id_kamar, id_pasien = $id_pasien WHERE id_inap = $id_inap";
        
        if ($koneksi->query($sql) === TRUE) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil diubah',
                    text: 'Data Rawat Inap berhasil diubah.',
                }).then((result) => {
                    window.location.href = 'index.php?lihat=inap/index';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengubah data',
                    text: 'Gagal mengubah data Rawat Inap: " . $koneksi->error . "',
                }).then((result) => {
                    window.location.href = 'index.php?lihat=inap/index';
                });
            </script>";
        }
    } else {
        // Tampilkan form edit data
        $query = $koneksi->query("SELECT * FROM inap WHERE id_inap = $id_inap");
        if ($query->num_rows > 0) {
            $data = mysqli_fetch_object($query);

            // Query untuk mendapatkan daftar nama pasien
            $con = mysqli_connect("localhost", "root", "", "rumah_sakit");
            $result_pasien = mysqli_query($con, "SELECT * FROM pasien ORDER BY id_pasien");
            
            echo "<div class='container mx-auto p-4'>
                <div class='bg-white rounded-lg shadow p-4'>
                    <h3 class='text-primary text-2xl font-bold'>Edit Data Rawat Inap</h3>
                    <hr class='border-t border-gray-300'>
                    <form action='' method='POST' class='mt-4'>
                        <input type='hidden' name='id_inap' value='$data->id_inap'>
                        <div class='mb-4'>
                            <label class='block text-gray-700 font-bold mb-2' for='id_pasien'>Nama Pasien</label>
                            <select class='form-select block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200' name='id_pasien' value='$data->id_pasien'>";
                            echo "<option>--Pilih nama pasien--</option>";
                            while ($row_pasien = mysqli_fetch_assoc($result_pasien)) {
                                // Tandai pilihan yang sesuai dengan data saat ini
                                $selected_pasien = ($row_pasien['id_pasien'] == $data->id_pasien) ? 'selected' : '';
                                echo "<option value='$row_pasien[id_pasien]' $selected_pasien>$row_pasien[nama_pasien]</option>";
                            }
                            echo "</select>
                        </div>
                        <div class='mb-4'>
                            <label class='block text-gray-700 font-bold mb-2' for='tgl_masuk'>Tanggal Masuk</label>
                            <input type='date' class='form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200' name='tgl_masuk' id='tgl_masuk' value='$data->tgl_masuk' required>
                        </div>
                        <div class='mb-4'>
                            <label class='block text-gray-700 font-bold mb-2' for='tgl_keluar'>Tanggal Keluar</label>
                            <input type='date' class='form-input block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200' name='tgl_keluar' value='$data->tgl_keluar'>
                        </div>
                        <div class='mb-4'>
                            <label class='block text-gray-700 font-bold mb-2' for='id_kamar'>Id Kamar</label>
                            <select class='form-select block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-200' name='id_kamar' value='$data->id_kamar'>";
                            // Query untuk mendapatkan daftar kamar
                            $result_kamar = mysqli_query($con, "SELECT * FROM kamar ORDER BY id_kamar");
                            echo "<option>--Pilih nama kamar--</option>";
                            while ($row_kamar = mysqli_fetch_assoc($result_kamar)) {
                                // Tandai pilihan yang sesuai dengan data saat ini
                                $selected_kamar = ($row_kamar['id_kamar'] == $data->id_kamar) ? 'selected' : '';
                                echo "<option value='$row_kamar[id_kamar]' $selected_kamar>$row_kamar[id_kamar]</option>";
                            }
                            echo "</select>
                        </div>
                        <button type='submit' name='edit' class='bg-blue-500 text-white py-2 px-4 rounded-md'>
                            <span class='glyphicon glyphicon-pencil'></span> Ubah
                        </button>
                    </form>
                </div>
            </div>";
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
    }
}
?>
</body>
</html>
