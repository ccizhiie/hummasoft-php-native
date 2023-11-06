<!DOCTYPE html>
<html>
<head>
    <title>Data Kamar</title>
    <!-- Menambahkan Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<?php
    /* Skrip ini tidak menggunakan OOP
       Memanggil file koneksi hanya satu kali */
    require_once('koneksi.php');

    // Query untuk mengambil data dari tabel 'kamar'
    $query  = "SELECT * FROM kamar";
    $link   = "index.php?lihat=kamar/";
?>

<div class="row">
    <div class="col-lg-12">
        <h3 class="text-primary">Data Kamar</h3>
        <hr class="border-t-2 border-gray-300 my-4"/>

        <!-- Tombol Tambah -->
        <a href="<?= $link.'tambah' ?>" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md inline-block">
            <span class="glyphicon glyphicon-plus"></span> Tambah
        </a>

        <!-- Menampilkan Tabel -->
        <div class="overflow-x-auto mt-4">
            <table class="table-auto w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-blue-200">
                        <th class="py-2 px-4">No</th>
                        <th class="py-2 px-4">Id Kamar</th>
                        <th class="py-2 px-4">Nama Kamar</th>
                        <th class="py-2 px-4">Kelas Kamar</th>
                        <th class="py-2 px-4">Kapasitas</th>
                        <th class="py-2 px-4">Harga</th>
                        
                        <th class="py-2 px-4" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($data = mysqli_query($koneksi, $query)) {
                        $no = 1;
                        while ($tampil = mysqli_fetch_object($data)) {
                            ?>
                            <tr>
                                <td class="py-2 px-4"><?= $no ?></td>
                                <td class="py-2 px-4"><?= $tampil->id_kamar?></td>
                                <td class="py-2 px-4"><?= $tampil->nama_kamar?></td>
                                <td class="py-2 px-4"><?= $tampil->kelas ?></td>
                                <td class="py-2 px-4"><?= $tampil->kapasitas ?></td>
                                <td class="py-2 px-4"><?= $tampil->harga ?></td>
                                <td class="py-2 px-4 flex justify-center">
                                <td class="py-2 px-4 flex justify-center">
    <!-- URL untuk mengarahkan ke halaman "edit.php" dengan parameter id_kamar -->
    <a href="<?= $link.'edit&id_kamar='.$tampil->id_kamar ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded-md inline-block mr-2">
        Edit
    </a>
    <!-- URL untuk mengarahkan ke halaman "hapus.php" dengan parameter id_kamar -->
    <a href="<?= $link.'hapus&id_kamar='.$tampil->id_kamar ?>" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded-md inline-block" onclick="return confirm('Apakah yakin data akan dihapus?')">
        Delete
    </a>
</td>

                                    </form>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }//Tutup while
                    }//Tutup if
                    ?>
                </tbody>
            </table>
        </div><!-- .table-responsive -->
    </div>
</div>

</body>
</html>
