<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- Tambahkan link CSS Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
require_once('koneksi.php');

$data = (object)[
    'id_pasien' => '',
    'nama_pasien' => '',
    'jk' => '',
    'no_telp' => '',
    'alamat' => '',
];

if ($_POST) {
    try {
        $sql = "UPDATE pasien SET nama_pasien='" . $_POST['nama_pasien'] . "', jk='" . $_POST['jk'] . "', no_telp='" . $_POST['no_telp'] . "', alamat='" . $_POST['alamat'] . "' WHERE id_pasien=" . $_POST['id_pasien'];

        if ($koneksi->query($sql) === TRUE) {
            // Data berhasil diubah, tampilkan SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Data berhasil diubah',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href='index.php?lihat=pasien/index';
                    }
                });
            </script>";
        } else {
            echo "Gagal: " . $koneksi->error;
        }

        $koneksi->close();
    } catch (Exception $error) {
        echo $error;
        die();
    }
} else {
    if (isset($_GET['id_pasien'])) {
        $id_pasien = $_GET['id_pasien'];
        $query = $koneksi->query("SELECT * FROM pasien WHERE id_pasien=" . $id_pasien);

        if ($query->num_rows > 0) {
            $data = mysqli_fetch_object($query);
        } else {
            echo "Data tidak tersedia";
            die();
        }
    }
}
?>
    
<div class="max-w-md mx-auto my-8 bg-white p-6 rounded-md shadow-md">
    <h3 class="text-primary text-2xl font-semibold mb-6">Edit Data Pasien</h3>
    <hr class="border-t border-gray-500 mb-6">
    <form action="" method="POST">
        <input type="hidden" name="id_pasien" value="<?= $data->id_pasien ?>">
        <div class="mb-4">
            <label for="nama_pasien" class="text-sm font-medium text-gray-700">Nama Pasien</label>
            <input type="text" value="<?= $data->nama_pasien ?>" class="mt-1 px-4 py-2 border rounded-md w-full" name="nama_pasien" required>
        </div>
        <div class="mb-4">
            <label class="text-sm font-medium text-gray-700">Jenis Kelamin</label><br>
            <input name="jk" type="radio" value="Laki-laki" <?= $data->jk == 'Laki-laki' ? 'checked' : '' ?>> Laki-laki
            <input name="jk" type="radio" value="Perempuan" <?= $data->jk == 'Perempuan' ? 'checked' : '' ?>> Perempuan
        </div>
        <div class="mb-4">
            <label for="no_telp" class="text-sm font-medium text-gray-700">No Telp</label>
            <input type="text" value="<?= $data->no_telp ?>" class="mt-1 px-4 py-2 border rounded-md w-full" name="no_telp" required>
        </div>
        <div class="mb-4">
            <label for "alamat" class="text-sm font-medium text-gray-700">Alamat</label>
            <textarea class="mt-1 px-4 py-2 border rounded-md w-full" name="alamat" required><?= $data->alamat; ?></textarea>
        </div>

        <button type="submit" class="bg-green-500 hover-bg-green-600 text-white font-semibold py-2 px-4 rounded">
            Ubah
        </button>
    </form>
</div>

</body>
</html>
